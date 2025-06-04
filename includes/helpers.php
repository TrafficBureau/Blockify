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
        global $blockify_is_dev, $blockify_plugin_dir, $blockify_version;

        if (is_null($type)) {
            return $blockify_is_dev
                ? filemtime($blockify_plugin_dir . $file_path)
                : $blockify_version;
        }

        if (!in_array($type, ['scripts', 'styles'])) {
            die('Invalid file type');
        }

        return $blockify_is_dev
            ? filemtime($blockify_plugin_dir . '/assets/' . $type . '/' . $file_path)
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

if (!function_exists('blockify_get_dir')) {
    /**
     * @param string $file_path
     * @return string
     */
    function blockify_get_dir(string $file_path): string
    {
        global $blockify_plugin_dir;
        return $blockify_plugin_dir . $file_path;
    }
}

if (!function_exists('blockify_include')) {
    /**
     * @param string $file
     * @param array $vars
     * @return void
     */
    function blockify_include(string $file, array $vars = []): void
    {
        extract($vars);
        include blockify_get_dir($file);
    }
}

if (!function_exists('blockify_check_post_request')) {
    /**
     * @param string $nonce
     * @param string[] $params
     * @return bool
     */
    function blockify_check_post_request(string $nonce): bool
    {
        if (!isset($nonce)) {
            die('Nonce data is not set');
        }

        if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
            return false;
        }

        if (!wp_verify_nonce($_POST[$nonce], $nonce)) {
            return false;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return false;
        }

        return true;
    }
}

if (!function_exists('blockify_get_field')) {
    /**
     * Отримує значення поля з пріоритетом: локальне > глобальне > дефолтне
     *
     * @param string $option_name Назва константи класу Options, наприклад Options::SUBTITLE
     * @param array $defaults     Масив дефолтних значень (Options::DEFAULTS)
     *
     * @return mixed
     */
    function blockify_get_field(string $option_name, array $defaults)
    {
        $local = get_field($option_name); // Get the value from the local ACF field first

        if (!empty($local) || $local === '0') {
            return $local;
        }

        $global = get_option($option_name);

        if (!empty($global) || $global === '0') {
            return $global;
        }

        return $defaults[$option_name] ?? null;
    }
}

if (!function_exists('expand_short_hex')) {
    function expand_short_hex($color) {
        if (preg_match('/^#([a-f0-9]{3})$/i', $color, $matches)) {
            return '#' . $matches[1][0] . $matches[1][0] . $matches[1][1] . $matches[1][1] . $matches[1][2] . $matches[1][2];
        }
        return $color;
    }
}

if (!function_exists('create_acf_key')) {
    /**
     * Створює унікальний ключ для ACF поля
     *
     * @param string $name Назва поля
     * @return string Унікальний ключ
     */
    function create_acf_key(string $name): string
    {
        return 'field_' . sanitize_title_with_dashes($name, '', 'save');
    }
}

if (!function_exists('sanitize_any_color')) {
    /**
     * Синтаксична перевірка кольору, дозволяє hex (#xxxxxx) або rgba()
     *
     * @param string $value Значення кольору
     * @return string Повертає значення кольору, якщо воно коректне, інакше порожній рядок
     */
    function sanitize_any_color(string $value): string {
        $value = trim($value);

        if (preg_match('/^#[0-9a-fA-F]{6,8}$/', $value)) {
            return $value;
        }

        if (preg_match('/^rgba?\([^)]+\)$/', $value)) {
            return $value;
        }

        return '';
    }
}
