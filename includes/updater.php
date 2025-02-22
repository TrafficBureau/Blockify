<?php

/**
 * Check GitHub for a new version and tell WP if one exists.
 */
add_filter('pre_set_site_transient_update_plugins', function($transient) {
    if (empty($transient->checked)) {
        return $transient;
    }

    global $blockify_version;

    $plugin_slug     = 'blockify/blockify.php';
    $current_version = $blockify_version;
    $token           = defined('GITHUB_TOKEN_BLOCKIFY') ? GITHUB_TOKEN_BLOCKIFY : '';

    if (empty($token)) {
        return $transient;
    }

    $remote_file_url = 'https://api.github.com/repos/TrafficBureau/Blockify/contents/blockify.php?ref=main';

    $args = array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/vnd.github.v3.raw',
        ),
    );

    $response = wp_remote_get($remote_file_url, $args);

    if ( is_wp_error($response) ) {
        return $transient;
    }

    $remote_body = wp_remote_retrieve_body($response);

    if (preg_match('/^ \* Version: (.*)$/mi', $remote_body, $matches)) {
        $remote_version = trim($matches[1]);
    } else {
        return $transient;
    }

    if (version_compare($current_version, $remote_version, '<')) {
        $zip_url = 'https://api.github.com/repos/TrafficBureau/Blockify/zipball/main';

        $obj = new stdClass();
        $obj->id          = $plugin_slug;
        $obj->slug        = 'traffic-bureau-blockify';
        $obj->plugin      = $plugin_slug;
        $obj->new_version = $remote_version;
        $obj->package     = $zip_url;
        $obj->icons       = [];

        $transient->response[$plugin_slug] = $obj;
    }

    return $transient;
});

add_filter('upgrader_package_options', function($options) {
    if (isset($options['package']) && false !== strpos($options['package'], 'api.github.com/repos/TrafficBureau/Blockify/zipball')) {
        $token = defined('GITHUB_TOKEN_BLOCKIFY') ? GITHUB_TOKEN_BLOCKIFY : '';

        if (!empty($token)) {
            $options['hook_extra']['download_args'] = array(
                'headers' => array(
                    'Authorization' => 'Bearer ' . $token,
                )
            );
        }
    }

    return $options;
});

add_filter('upgrader_source_selection', function($source, $remote_source, $upgrader, $hook_extra) {
    global $wp_filesystem;

    if (isset($hook_extra['plugin']) && 'blockify/blockify.php' === $hook_extra['plugin']) {
        $desired_folder_name = 'blockify';
        $folder_name = basename($source);

        if ($folder_name === 'Blockify-main') {
            $new_source = trailingslashit(dirname($source)) . $desired_folder_name;
            $wp_filesystem->move($source, $new_source);
            return $new_source;
        }
    }

    return $source;
}, 10, 4);
