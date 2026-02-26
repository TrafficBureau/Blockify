<?php

if (!defined('ABSPATH')) {
    exit;
}

add_filter('term_description', function ($description) {
    return blockify_maybe_render_term_description_blocks($description);
}, 9);

function blockify_maybe_render_term_description_blocks($description) {
    static $is_processing = false;
    $max_description_length = 262144; // 256 KB

    if (
        $is_processing
        || !is_string($description)
        || $description === ''
        || strlen($description) > $max_description_length
        || !function_exists('has_blocks')
        || !function_exists('do_blocks')
        || !has_blocks($description)
    ) {
        return $description;
    }

    $is_processing = true;

    try {
        return do_blocks($description);
    } finally {
        $is_processing = false;
    }
}

require_once blockify_get_dir('/includes/svg-allowed-tags.php');

add_filter('wp_kses_allowed_html', function($tags, $context) {
    if ($context !== 'post') {
        return $tags;
    }

    return array_merge($tags, blockify_get_svg_allowed_tags());
}, 10, 2);
