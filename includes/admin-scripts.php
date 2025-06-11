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
            'blockify-taxonomy-editor',
            blockify_get_file_url('taxonomy-block-editor.js', 'scripts'),
            ['wp-block-editor', 'wp-element', 'wp-blocks'],
            blockify_get_file_version('taxonomy-block-editor.js', 'scripts'),
            true
        );
    }
});
