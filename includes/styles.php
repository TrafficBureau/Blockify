<?php

use TrafficBureau\Blockify\Relinking\Options as RelinkingOptions;
use TrafficBureau\Blockify\ProSteps\Options;

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_enqueue_scripts', 'blockify_enqueue_styles');

function blockify_enqueue_styles() {
    $has_pro_steps = blockify_has_block_content('acf/pro-steps-blockify');
    $has_relinking = blockify_has_block_content('acf/relinking-blockify');
    $has_any_block = $has_pro_steps || $has_relinking;

    if (!$has_any_block) {
        return;
    }

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

    if ($has_pro_steps) {
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

    if ($has_relinking) {
        wp_enqueue_style(
            'blockify-relinking-block-style',
            plugin_dir_url( __DIR__ ) . 'blocks/relinking-block/relinking-block.css',
            [],
            '1.0'
        );

        $relinking_bg_image_id = get_option(RelinkingOptions::BACKGROUND_IMAGE_ID);
        $relinking_bg_image    = $relinking_bg_image_id ? wp_get_attachment_image_url($relinking_bg_image_id, 'full') : '';

        $relinking_css = ':root { --blockify-relinking-bg-color: ' . get_option(RelinkingOptions::BACKGROUND_COLOR, RelinkingOptions::DEFAULTS[RelinkingOptions::BACKGROUND_COLOR]) .
            '; --blockify-relinking-text-color: ' . get_option(RelinkingOptions::TEXT_COLOR, RelinkingOptions::DEFAULTS[RelinkingOptions::TEXT_COLOR]) .
            '; --blockify-relinking-link-color: ' . get_option(RelinkingOptions::LINK_COLOR, RelinkingOptions::DEFAULTS[RelinkingOptions::LINK_COLOR]) .
            '; --blockify-relinking-icon-color: ' . get_option(RelinkingOptions::ICON_COLOR, RelinkingOptions::DEFAULTS[RelinkingOptions::ICON_COLOR]) .
            '; --blockify-relinking-bg-image: ' . ($relinking_bg_image ? "url('" . esc_url($relinking_bg_image) . "')" : 'none') . '; }';

        wp_add_inline_style('blockify-relinking-block-style', $relinking_css);
    }
}

function blockify_has_block_content(string $block_name): bool {
    if (!function_exists('has_block')) {
        return false;
    }

    if (is_singular()) {
        $post = get_post();
        return $post ? has_block($block_name, $post->post_content) : false;
    }

    if (is_category() || is_tag() || is_tax()) {
        $term = get_queried_object();
        if ($term && !empty($term->description)) {
            return has_block($block_name, $term->description);
        }
    }

    return false;
}
