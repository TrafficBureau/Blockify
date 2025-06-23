<?php

namespace TrafficBureau\Blockify\Hero;

if (!defined('ABSPATH')) {
    exit;
}

final class Options {
    const TITLE               = 'hero_title';    // without "blockify_" for backward compatibility
    const SUBTITLE            = 'hero_subtitle'; // the same
    const HERO_IMAGE          = 'hero_image';    // the same
    const HERO_IMAGE_ID       = 'blockify_hero_image_id';
    const HERO_IMAGE_TOP      = 'blockify_hero_image_top';
    const HERO_IMAGE_RIGHT    = 'blockify_hero_image_right';
    const TITLE_COLOR         = 'blockify_hero_title_color';
    const SUBTITLE_COLOR      = 'blockify_hero_subtitle_color';
    const BACKGROUND_COLOR    = 'hero_color'; // must be "blockify_hero_background_color" but for backward compatibility left as "hero_color"
    const IS_ENABLED_GRADIENT = 'blockify_hero_is_enabled_gradient';
    const COLOR_FOR_GRADIENT  = 'blockify_hero_color_for_gradient';
    const USE_GLOBAL_OPTIONS  = 'blockify_hero_use_global_options';

    const DEFAULTS = [
        self::SUBTITLE            => '',
        self::HERO_IMAGE_ID       => '',
        self::HERO_IMAGE_TOP      => -150,
        self::HERO_IMAGE_RIGHT    => -50,
        self::TITLE_COLOR         => '#000',
        self::SUBTITLE_COLOR      => '#000',
        self::BACKGROUND_COLOR    => '#ededed',
        self::IS_ENABLED_GRADIENT => 1,
        self::COLOR_FOR_GRADIENT  => '#ededed',
        self::USE_GLOBAL_OPTIONS  => 0,
    ];

    const UPDATE_METHODS = [
        self::SUBTITLE           => 'sanitize_text_field',
        self::HERO_IMAGE_ID      => 'intval',
        self::HERO_IMAGE_TOP     => 'intval',
        self::HERO_IMAGE_RIGHT   => 'intval',
        self::TITLE_COLOR        => 'sanitize_hex_color',
        self::SUBTITLE_COLOR     => 'sanitize_hex_color',
        self::BACKGROUND_COLOR   => 'sanitize_hex_color',
        self::COLOR_FOR_GRADIENT => 'sanitize_hex_color',
    ];

    const CHECKBOX_KEYS = [
        self::IS_ENABLED_GRADIENT,
    ];

    const GLOBAL_KEYS = [
        self::SUBTITLE,
        self::HERO_IMAGE_ID,
        self::HERO_IMAGE_TOP,
        self::HERO_IMAGE_RIGHT,
        self::TITLE_COLOR,
        self::SUBTITLE_COLOR,
        self::BACKGROUND_COLOR,
        self::COLOR_FOR_GRADIENT,
        self::IS_ENABLED_GRADIENT,
    ];

    public static function getFieldWithDefaults($field_name) {
        global $blockify_current_block;

        $use_global = get_field(self::USE_GLOBAL_OPTIONS);

        if ($use_global === null && isset($blockify_current_block['data'][self::USE_GLOBAL_OPTIONS])) {
            $use_global = $blockify_current_block['data'][self::USE_GLOBAL_OPTIONS];
        }

        if ($use_global) {
            return blockify_get_field_global_first($field_name, self::DEFAULTS);
        }

        return blockify_get_field($field_name, self::DEFAULTS);
    }
}
