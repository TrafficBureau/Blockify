<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_enqueue_scripts', function() {
    if (is_admin()) {
        wp_enqueue_media();
    }
});
