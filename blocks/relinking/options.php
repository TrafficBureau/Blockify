<?php

namespace TrafficBureau\Blockify\Relinking;

if (!defined('ABSPATH')) {
    exit;
}

final class Options {
    const BACKGROUND_COLOR    = 'blockify_relinking_background_color';
    const BACKGROUND_IMAGE_ID = 'blockify_relinking_background_image_id';
    const TEXT_COLOR          = 'blockify_relinking_text_color';
    const LINK_COLOR          = 'blockify_relinking_link_color';
    const ICON_COLOR          = 'blockify_relinking_icon_color';
    const USE_GLOBAL_OPTIONS  = 'blockify_relinking_use_global_options';

    const DEFAULTS = [
        self::BACKGROUND_COLOR    => '#ffffff',
        self::BACKGROUND_IMAGE_ID => '',
        self::TEXT_COLOR          => '#111111',
        self::LINK_COLOR          => '#111111',
        self::ICON_COLOR          => '#17a85a',
        self::USE_GLOBAL_OPTIONS  => 1,
    ];

    const UPDATE_METHODS = [
        self::BACKGROUND_COLOR    => 'sanitize_any_color',
        self::BACKGROUND_IMAGE_ID => 'intval',
        self::TEXT_COLOR          => 'sanitize_hex_color',
        self::LINK_COLOR          => 'sanitize_hex_color',
        self::ICON_COLOR          => 'sanitize_hex_color',
    ];

    const GLOBAL_KEYS = [
        self::BACKGROUND_COLOR,
        self::BACKGROUND_IMAGE_ID,
        self::TEXT_COLOR,
        self::LINK_COLOR,
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
