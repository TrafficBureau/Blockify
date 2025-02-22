<?php

if (!defined('ABSPATH')) {
    exit;
}

function register_fields($block) {
    global $blockify_plugin_dir;
    require_once $blockify_plugin_dir . '/blocks/' . $block . '/fields.php';
}

register_fields('hero');
register_fields('pro-steps');
