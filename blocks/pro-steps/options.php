<?php

namespace TrafficBureau\Blockify\ProSteps;

if (!defined('ABSPATH')) {
    exit;
}

final class Options {
    const STEPS               = 'pro_steps';                  // without "blockify_" for backward compatibility
    const NUMBER_COLOR        = 'pro_steps_color';            // the same
    const BACKGROUND_COLOR    = 'pro_steps_background_color'; // the same
    const COLOR_FOR_GRADIENT  = 'blockify_pro_steps_color_for_gradient';

    const DEFAULTS = [
        self::NUMBER_COLOR       => '#e6e6e6',
        self::BACKGROUND_COLOR   => '#efefef',
        self::COLOR_FOR_GRADIENT => 'rgba(0, 0, 0, 0)',
    ];

    const UPDATE_METHODS = [
        self::NUMBER_COLOR       => 'sanitize_hex_color',
        self::BACKGROUND_COLOR   => 'sanitize_hex_color',
        self::COLOR_FOR_GRADIENT => 'sanitize_hex_color',
    ];

    const GLOBAL_KEYS = [
        self::NUMBER_COLOR,
        self::BACKGROUND_COLOR,
        self::COLOR_FOR_GRADIENT,
    ];

    public static function getFieldWithDefaults($field_name) {
        return blockify_get_field($field_name, self::DEFAULTS);
    }
}
