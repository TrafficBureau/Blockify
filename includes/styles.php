<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'blockify-custom-style',
        blockify_get_file_url('index.css', 'styles'),
        array(),
        blockify_get_file_version('index.css', 'styles'),
    );

    wp_enqueue_style(
        'blockify-roboto-font',
        '//fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap'
    );

    wp_enqueue_style(
        'blockify-montserrat-font',
        '//fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap'
    );
});
