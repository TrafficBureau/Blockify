<?php

if (!defined('ABSPATH')) {
    exit;
}

add_filter('term_description', function ($description) {
    if (function_exists('has_blocks') && function_exists('do_blocks') && has_blocks($description)) {
        $description = do_blocks($description);
    }

    return $description;
}, 9);

add_filter('get_term', function ($term) {
    if (!is_admin() && isset($term->description) && function_exists('has_blocks') && has_blocks($term->description)) {
        $term->description = do_blocks($term->description);
    }

    return $term;
});

add_filter('get_terms', function ($terms) {
    if (!is_admin() && is_array($terms)) {
        foreach ($terms as $term) {
            if (isset($term->description) && function_exists('has_blocks') && has_blocks($term->description)) {
                $term->description = do_blocks($term->description);
            }
        }
    }

    return $terms;
});

require_once blockify_get_dir('/includes/svg-allowed-tags.php');

add_filter('wp_kses_allowed_html', function($tags, $context) {
    if ($context !== 'post') {
        return $tags;
    }

    return array_merge($tags, blockify_get_svg_allowed_tags());
}, 10, 2);
