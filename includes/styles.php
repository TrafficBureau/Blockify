<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_enqueue_scripts', 'blockify_enqueue_styles');

function blockify_enqueue_styles()
{
    wp_enqueue_style(
        'blockify-custom-style',
        blockify_get_file_url('index.css', 'styles'),
        array(),
        blockify_get_file_version('index.css', 'styles'),
    );
}
