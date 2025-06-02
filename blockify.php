<?php

/**
 * Plugin Name: Blockify
 * Description: A plugin adding custom blocks to the Gutenberg editor. Dependencies: Advanced Custom Fields.
 * Version: 0.0.10
 * Author: Traffic Bureau
 * License: GPLv2 or later
 * Text Domain: blockify
 * Plugin URI: https://github.com/TrafficBureau/Blockify
 * Update URI: https://github.com/TrafficBureau/Blockify
 * Requires PHP: 7.4
 */

if (!defined('ABSPATH')) {
    exit;
}

/*  --- Constants  ---  */

global $blockify_version, $blockify_plugin_dir, $blockify_plugin_url;

$blockify_version      = '0.0.10';
$blockify_plugin_dir   = untrailingslashit(plugin_dir_path(__FILE__));
$blockify_plugin_url   = untrailingslashit(plugin_dir_url(__FILE__));
$blockify_github_token = defined('GITHUB_TOKEN_BLOCKIFY') ? GITHUB_TOKEN_BLOCKIFY : '';

/*  --- Constants  ---  */

require_once $blockify_plugin_dir . '/constants/index.php';

/*  --- Includes  ---  */

require_once $blockify_plugin_dir . '/includes/helpers.php';
require_once $blockify_plugin_dir . '/includes/hooks.php';
require_once $blockify_plugin_dir . '/includes/styles.php';
require_once $blockify_plugin_dir . '/includes/register-blocks.php';
require_once $blockify_plugin_dir . '/includes/register-fields.php';

/*  ---  Admin  ---  */

require_once $blockify_plugin_dir . '/admin/index.php';

/*  --- Updater (must be in the end)  ---  */

require_once $blockify_plugin_dir . '/includes/Updater.php';

new Updater([
    'current_version' => $blockify_version,
    'slug'            => 'blockify',
    'market_slug'     => 'traffic-bureau-blockify',
    'plugin_file'     => 'blockify/blockify.php',
    'repository'      => 'TrafficBureau/Blockify',
    'token'           => $blockify_github_token,
]);
