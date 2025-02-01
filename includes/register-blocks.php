<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', 'register_acf_blocks');

function register_acf_blocks()
{
    global $blockify_plugin_dir;

    register_block_type($blockify_plugin_dir . '/blocks/iframe-lazy');
    register_block_type($blockify_plugin_dir . '/blocks/pro-steps');
    register_block_type($blockify_plugin_dir . '/blocks/hero');
}

add_filter('block_categories_all', 'add_block_category');

function add_block_category($categories)
{
    $custom_category = array(
        'slug'  => 'blockify',
        'title' => 'Blockify',
    );

    array_splice($categories, 0, 0, array($custom_category));

    return $categories;
}
