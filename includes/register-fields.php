<?php

if (!defined('ABSPATH')) {
    exit;
}

function register_fields($block) {
    $options = blockify_get_dir('/blocks/' . $block . '/options.php');

    if (file_exists($options)) {
        require_once $options;
    }

    require_once blockify_get_dir('/blocks/' . $block . '/fields.php');
}

register_fields('hero');
register_fields('pro-steps');
