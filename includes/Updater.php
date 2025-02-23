<?php

if (!defined('ABSPATH')) {
    exit;
}

class Updater
{
    private string $current_version;
    private string $slug;
    private string $market_slug;
    private string $plugin_file;
    private string $repository;
    private string $token;

    /**
     * @param array{
     *     current_version: string,
     *     slug: string,
     *     market_slug: string,
     *     plugin_file: string,
     *     repository: string,
     *     token: string
     * } $args
     */
    public function __construct(array $args) {
        $this->current_version = $args['current_version'];
        $this->slug            = $args['slug'];
        $this->market_slug     = $args['market_slug'];
        $this->plugin_file     = $args['plugin_file'];
        $this->repository      = $args['repository'];
        $this->token           = $args['token'];

        add_filter('pre_set_site_transient_update_plugins', [$this, 'checkForUpdate'], 9999);
        add_filter('http_request_args', [$this, 'addAuthorizationHeader'], 10, 2);
        add_filter('upgrader_source_selection', [$this, 'renamePluginFolder'], 10, 4);
    }

    public function checkForUpdate($transient)
    {
        if (empty($transient->checked) || empty($this->token)) {
            return $transient;
        }

        $remote_file_url = 'https://api.github.com/repos/' . $this->repository . '/contents/' . $this->slug . '.php?ref=main';

        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $this->token,
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

        if (version_compare($this->current_version, $remote_version, '<')) {
            $zip_url = 'https://api.github.com/repos/' . $this->repository . '/zipball/main';

            $obj              = new stdClass();
            $obj->slug        = $this->market_slug;
            $obj->id          = $this->plugin_file;
            $obj->plugin      = $this->plugin_file;
            $obj->new_version = $remote_version;
            $obj->package     = $zip_url;
            $obj->icons       = [];

            $transient->response[$this->plugin_file] = $obj;
        }

        return $transient;
    }

    public function addAuthorizationHeader($args, $url): array
    {
        if (!empty($this->token) && strpos($url, 'api.github.com/repos/' . $this->repository) !== false)
        {
            $args['headers']['Authorization'] = 'Bearer ' . $this->token;
            $args['headers']['Accept'] = 'application/vnd.github.v3.raw';
        }
        return $args;
    }

    public function renamePluginFolder($source, $remote_source, $upgrader, $hook_extra): string
    {
        if (isset($hook_extra['plugin']) && $this->plugin_file === $hook_extra['plugin'])
        {
            $path_parts = pathinfo($source);
            $new_source = trailingslashit($path_parts['dirname']) . $this->slug . '/';
            rename($source, $new_source);
            return $new_source;
        }
        return $source;
    }
}
