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
    const LINE_COLOR          = 'blockify_pro_steps_line_color';
    const USE_GLOBAL_OPTIONS  = 'blockify_pro_steps_use_global_options';

    const DEFAULTS = [
        self::NUMBER_COLOR       => '#e6e6e6',
        self::BACKGROUND_COLOR   => '#efefef',
        self::COLOR_FOR_GRADIENT => 'rgba(0, 0, 0, 0)',
        self::LINE_COLOR         => '#cccccc',
        self::USE_GLOBAL_OPTIONS => 0,
    ];

    const UPDATE_METHODS = [
        self::NUMBER_COLOR       => 'sanitize_hex_color',
        self::BACKGROUND_COLOR   => 'sanitize_any_color',
        self::COLOR_FOR_GRADIENT => 'sanitize_any_color',
        self::LINE_COLOR         => 'sanitize_hex_color',
    ];

    const GLOBAL_KEYS = [
        self::NUMBER_COLOR,
        self::BACKGROUND_COLOR,
        self::COLOR_FOR_GRADIENT,
        self::LINE_COLOR,
    ];

    public static function getFieldWithDefaults($field_name) {
        $use_global = get_field(self::USE_GLOBAL_OPTIONS);

        if ($use_global) {
            return blockify_get_field_global_first($field_name, self::DEFAULTS);
        }

        return blockify_get_field($field_name, self::DEFAULTS);
    }
}
