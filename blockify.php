<?php

/**
 * Plugin Name: Blockify
 * Description: A plugin adding custom blocks to the Gutenberg editor. Dependencies: Advanced Custom Fields.
 * Version: 0.0.4
 * Author: Traffic Bureau
 * License: GPLv2 or later
 * Text Domain: blockify
 * Plugin URI: https://github.com/TrafficBureau/Blockify
 * Update URI: https://github.com/TrafficBureau/Blockify
 */

if (!defined('ABSPATH')) {
    exit;
}

/*  --- Constants  ---  */

global $blockify_version, $blockify_plugin_dir, $blockify_plugin_url;

$blockify_version    = get_plugin_data(__FILE__)['Version'];
$blockify_plugin_dir = untrailingslashit(plugin_dir_path(__FILE__));
$blockify_plugin_url = untrailingslashit(plugin_dir_url(__FILE__));

/*  --- Includes  ---  */

require_once $blockify_plugin_dir . '/includes/helpers.php';
require_once $blockify_plugin_dir . '/includes/styles.php';
require_once $blockify_plugin_dir . '/includes/register-blocks.php';
require_once $blockify_plugin_dir . '/includes/register-fields.php';

/*  --- Updater (must be in the end)  ---  */

require_once $blockify_plugin_dir . '/includes/updater.php';
