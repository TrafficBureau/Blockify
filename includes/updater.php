<?php

/**
 * Check GitHub for a new version and tell WP if one exists.
 */
add_filter('pre_set_site_transient_update_plugins', function ($transient) {
    if (empty($transient->checked)) {
        return $transient;
    }

    global $blockify_version;

    $plugin_slug = 'blockify/blockify.php';
    $current_version = $blockify_version;
    $token = defined('GITHUB_TOKEN_BLOCKIFY') ? GITHUB_TOKEN_BLOCKIFY : '';

    if (empty($token)) {
        return $transient;
    }

    $remote_file_url = 'https://api.github.com/repos/TrafficBureau/Blockify/contents/blockify.php?ref=main';

    $args = array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/vnd.github.v3.raw',
        ),
    );

    $response = wp_remote_get($remote_file_url, $args);

    if (is_wp_error($response)) {
        return $transient;
    }

    $remote_body = wp_remote_retrieve_body($response);

    if (preg_match('/^\s*\*\s*Version:\s*(.*)$/mi', $remote_body, $matches)) {
        $remote_version = trim($matches[1]);
    } else {
        return $transient;
    }

    if (version_compare($current_version, $remote_version, '<')) {
        $zip_url = 'https://api.github.com/repos/TrafficBureau/Blockify/zipball/main';

        $obj = new stdClass();
        $obj->slug = 'traffic-bureau-blockify';
        $obj->id = $plugin_slug;
        $obj->plugin = $plugin_slug;
        $obj->new_version = $remote_version;
        $obj->package = $zip_url;
        $obj->icons = [];

        $transient->response[$plugin_slug] = $obj;
    }

    return $transient;
}, 9999);

add_filter('http_request_args', function ($args, $url) {
    $token = defined('GITHUB_TOKEN_BLOCKIFY') ? GITHUB_TOKEN_BLOCKIFY : '';

    if ( strpos($url, 'api.github.com/repos/TrafficBureau/Blockify') !== false ) {
        $args['headers']['Authorization'] = 'Bearer ' . $token;
        $args['headers']['Accept'] = 'application/vnd.github.v3.raw';
    }
    return $args;
}, 10, 2);

add_filter('upgrader_source_selection', function($source, $remote_source, $upgrader, $hook_extra)
{
    if (isset($hook_extra['plugin']) && 'blockify/blockify.php' === $hook_extra['plugin'])
    {
        $path_parts = pathinfo( $source );
        $newsource = trailingslashit( $path_parts['dirname'] ) . 'blockify/';
        rename( $source, $newsource );
        return $newsource;
    }

    return $source;
}, 10, 4);


