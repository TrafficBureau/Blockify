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
