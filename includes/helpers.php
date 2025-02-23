<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('blockify_get_file_version')) {
    /**
     * @param string $file_path
     * @param 'scripts'|'styles'|null $type (optional)
     * @return string
     */
    function blockify_get_file_version(string $file_path, string $type = null): string
    {
        global $blockify_is_dev, $blockify_plugin_url, $blockify_version;

        if (is_null($type)) {
            return $blockify_is_dev
                ? filemtime($blockify_plugin_url . $file_path)
                : $blockify_version;
        }

        if (!in_array($type, ['scripts', 'styles'])) {
            die('Invalid file type');
        }

        return $blockify_is_dev
            ? filemtime($blockify_plugin_url . '/assets/' . $type . '/' . $file_path)
            : $blockify_version;
    }
}

if (!function_exists('blockify_get_file_url')) {
    /**
     * @param string $file_path
     * @param 'scripts'|'styles'|null $type (optional)
     * @return string
     */
    function blockify_get_file_url(string $file_path, string $type = null): string
    {
        global $blockify_plugin_url;

        if (is_null($type)) {
            return $blockify_plugin_url . $file_path;
        }

        if (!in_array($type, ['scripts', 'styles'])) {
            die('Invalid file type');
        }

        return $blockify_plugin_url . '/assets/' . $type . '/' . $file_path;
    }
}
