<?php

namespace TrafficBureau\Blockify\Hero;

if (!defined('ABSPATH')) {
    exit;
}

final class Options {
    const TITLE               = 'blockify_hero_title';
    const SUBTITLE            = 'blockify_hero_subtitle';
    const HERO_IMAGE          = 'blockify_hero_image';
    const HERO_IMAGE_ID       = 'blockify_hero_image_id';
    const HERO_IMAGE_TOP      = 'blockify_hero_image_top';
    const HERO_IMAGE_RIGHT    = 'blockify_hero_image_right';
    const TITLE_COLOR         = 'blockify_hero_title_color';
    const SUBTITLE_COLOR      = 'blockify_hero_subtitle_color';
    const BACKGROUND_COLOR    = 'blockify_hero_background_color';
    const IS_ENABLED_GRADIENT = 'blockify_hero_is_enabled_gradient';
    const COLOR_FOR_GRADIENT  = 'blockify_hero_color_for_gradient';

    const DEFAULTS = [
        self::SUBTITLE         => '',
        self::HERO_IMAGE_ID    => '',
        self::HERO_IMAGE_TOP   => -50,
        self::HERO_IMAGE_RIGHT => -150,
        self::TITLE_COLOR      => '#000',
        self::SUBTITLE_COLOR   => '#000',
        self::BACKGROUND_COLOR => '#ededed',
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

    const CUSTOM_KEYS = [
        self::SUBTITLE,
        self::HERO_IMAGE_ID,
        self::HERO_IMAGE_TOP,
        self::HERO_IMAGE_RIGHT,
        self::TITLE_COLOR,
        self::SUBTITLE_COLOR,
        self::BACKGROUND_COLOR,
        self::IS_ENABLED_GRADIENT,
        self::COLOR_FOR_GRADIENT,
    ];
}
