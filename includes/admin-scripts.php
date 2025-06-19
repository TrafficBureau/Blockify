<?php

if (!defined('ABSPATH')) {
    exit;
}

// Delay execution to ensure ACF scripts are registered first.
add_action('admin_enqueue_scripts', function ($hook) {
    if (!is_admin()) {
        return;
    }

    wp_enqueue_media();

    if (in_array($hook, ['term.php', 'edit-tags.php'], true)) {
        // Load block editor assets so ACF can register its blocks.
        do_action('enqueue_block_editor_assets');

        wp_enqueue_style('wp-edit-blocks');

        $deps = ['jquery', 'wp-blocks', 'wp-element', 'wp-components', 'wp-block-editor'];

        // Ensure ACF blocks are registered when opening the modal editor.
        if (wp_script_is('acf-blocks', 'registered')) {
            wp_enqueue_script('acf-blocks');
            $deps[] = 'acf-blocks';
        }

        wp_enqueue_script(
            'blockify-taxonomy-buttons',
            blockify_get_file_url('taxonomy-block-buttons.js', 'scripts'),
            $deps,
            blockify_get_file_version('taxonomy-block-buttons.js', 'scripts'),
            true
        );
    }
}, 20);
