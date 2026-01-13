<?php

namespace TrafficBureau\Blockify\Relinking;

if (!defined('ABSPATH')) {
    exit;
}

final class Options {
    const BACKGROUND_COLOR    = 'blockify_relinking_background_color';
    const TEXT_COLOR          = 'blockify_relinking_text_color';
    const TITLE_COLOR         = 'blockify_relinking_title_color';
    const BUTTON_BG_COLOR     = 'blockify_relinking_button_bg_color';
    const ICON_COLOR          = 'blockify_relinking_icon_color';
    const USE_GLOBAL_OPTIONS  = 'blockify_relinking_use_global_options';

    const DEFAULTS = [
        self::BACKGROUND_COLOR    => '#ffffff',
        self::TEXT_COLOR          => '#111111',
        self::TITLE_COLOR         => '#111111',
        self::BUTTON_BG_COLOR     => '#656e72',
        self::ICON_COLOR          => '#17a85a',
        self::USE_GLOBAL_OPTIONS  => 1,
    ];

    const UPDATE_METHODS = [
        self::BACKGROUND_COLOR    => 'sanitize_any_color',
        self::TEXT_COLOR          => 'sanitize_hex_color',
        self::TITLE_COLOR         => 'sanitize_hex_color',
        self::BUTTON_BG_COLOR     => 'sanitize_hex_color',
        self::ICON_COLOR          => 'sanitize_hex_color',
    ];

    const GLOBAL_KEYS = [
        self::BACKGROUND_COLOR,
        self::TEXT_COLOR,
        self::TITLE_COLOR,
        self::BUTTON_BG_COLOR,
        self::ICON_COLOR,
    ];

    public static function getFieldWithDefaults($field_name) {
        $use_global = get_field(self::USE_GLOBAL_OPTIONS);

        if ($use_global) {
            return blockify_get_field_global_first($field_name, self::DEFAULTS);
        }

        return blockify_get_field($field_name, self::DEFAULTS);
    }
}
