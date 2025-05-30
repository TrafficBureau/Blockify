<?php

use TrafficBureau\Blockify\Admin\Nonce;
use TrafficBureau\Blockify\Hero\Options as HeroOptions;

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_menu', function()
{
    add_menu_page(
        'Blockify',
        'Blockify',
        'manage_options',
        'blockify',
        'blockify_admin_page_content',
        plugins_url( 'blockify/assets/images/hearts.svg' ),
        59, // Same as ACES plugin
    );
});

function blockify_admin_page_content()
{
    if (!current_user_can('manage_options')) {
        return;
    }

    if (blockify_check_post_request(Nonce::HERO_SETTINGS)) {
        update_blockify_hero_options();
    }

    $file_path = blockify_get_dir('/admin/templates/index.php');

    if (file_exists($file_path)) {
        include $file_path;
    } else {
        echo '<p>Файл сторінки не знайдено</p>';
    }
}

function update_blockify_hero_options() {
    foreach (HeroOptions::GLOBAL_KEYS as $key) {
        $method = HeroOptions::UPDATE_METHODS[$key] ?? 'sanitize_text_field';

        if (in_array($key, HeroOptions::CHECKBOX_KEYS, true)) {
            $value = isset($_POST[$key]) ? 1 : 0;
        } else {
            $value = isset($_POST[$key]) ? call_user_func($method, $_POST[$key]) : HeroOptions::DEFAULTS[$key];
        }

        update_option($key, $value);
    }

    echo '<div class="updated"><p>Налаштування збережено</p></div>';
}
