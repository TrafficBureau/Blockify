<?php

use TrafficBureau\Blockify\ProSteps\Options;

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_enqueue_scripts', 'blockify_enqueue_styles');

function blockify_enqueue_styles() {
    wp_enqueue_style(
        'blockify-custom-style',
        blockify_get_file_url( 'index.css', 'styles' ),
        [],
        blockify_get_file_version( 'index.css', 'styles' )
    );

    wp_enqueue_style(
        'blockify-google-fonts',
        'https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&family=Montserrat:wght@100..900&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'pro-steps-style',
        plugin_dir_url( __DIR__ ) . 'blocks/pro-steps/pro-steps.css',
        [],
        '1.0'
    );

    $css = ':root { --pro-steps-number-color: ' . Options::getFieldWithDefaults(Options::NUMBER_COLOR) .
           '; --pro-steps-background-color: ' . Options::getFieldWithDefaults(Options::BACKGROUND_COLOR) .
           '; --pro-color-for-gradient: ' . Options::getFieldWithDefaults(Options::COLOR_FOR_GRADIENT) . '; }';

    wp_add_inline_style('pro-steps-style', $css);
}
