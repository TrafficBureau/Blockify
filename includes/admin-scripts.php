<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_enqueue_scripts', function($hook) {
    if (!is_admin()) {
        return;
    }

    wp_enqueue_media();

    if (in_array($hook, ['term.php', 'edit-tags.php'], true)) {
        wp_enqueue_script(
            'blockify-taxonomy-buttons',
            blockify_get_file_url('taxonomy-block-buttons.js', 'scripts'),
            ['jquery'],
            blockify_get_file_version('taxonomy-block-buttons.js', 'scripts'),
            true
        );
    }
});
