<?php

namespace TrafficBureau\Blockify\ProSteps;

if (!defined('ABSPATH')) {
    exit;
}

final class Options {
    const STEPS               = 'blockify_pro_steps';
    const NUMBER_COLOR        = 'blockify_pro_steps_number_color';
    const BACKGROUND_COLOR    = 'blockify_pro_steps_background_color';
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
