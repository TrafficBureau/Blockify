<?php

use TrafficBureau\Blockify\Hero\Options;

if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', 'register_hero_acf_fields');

function register_hero_acf_fields()
{
    acf_add_local_field_group(array(
        'key' => 'group_hero',
        'title' => 'Hero Fields',
        'fields' => array(
            array(
                'key' => create_acf_key(Options::TITLE),
                'name' => Options::TITLE,
                'label' => 'Title',
                'type' => 'text',
                'required' => 1,
            ),
            array(
                'key' => create_acf_key(Options::USE_GLOBAL_OPTIONS),
                'name' => Options::USE_GLOBAL_OPTIONS,
                'label' => 'Use global options',
                'type' => 'true_false',
                'ui' => 1,
                'ui_on_text' => 'On',
                'ui_off_text' => 'Off',
                'default_value' => 1,
            ),
            array(
                'key' => create_acf_key(Options::SUBTITLE),
                'name' => Options::SUBTITLE,
                'label' => 'Subtitle',
                'type' => 'text',
                'required' => 0,
            ),
            array(
                'key' => create_acf_key(Options::HERO_IMAGE),
                'name' => Options::HERO_IMAGE,
                'label' => 'Hero',
                'type' => 'image',
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'instructions' => 'Image size: 650x774. Not required.',
            ),
            array(
                'key' => create_acf_key(Options::HERO_IMAGE_TOP),
                'name' => Options::HERO_IMAGE_TOP,
                'label' => 'Hero image top (px)',
                'type' => 'number',
                'wrapper' => array(
                    'width' => 25,
                ),
            ),
            array(
                'key' => create_acf_key(Options::HERO_IMAGE_RIGHT),
                'name' => Options::HERO_IMAGE_RIGHT,
                'label' => 'Hero image right (px)',
                'type' => 'number',
                'wrapper' => array(
                    'width' => 25,
                ),
            ),
            array(
                'key' => create_acf_key(Options::TITLE_COLOR),
                'name' => Options::TITLE_COLOR,
                'label' => 'Title color',
                'type' => 'color_picker',
                'enable_opacity' => false,
            ),
            array(
                'key' => create_acf_key(Options::SUBTITLE_COLOR),
                'name' => Options::SUBTITLE_COLOR,
                'label' => 'Subtitle color',
                'type' => 'color_picker',
                'enable_opacity' => false,
            ),
            array(
                'key' => create_acf_key(Options::BACKGROUND_COLOR),
                'name' => Options::BACKGROUND_COLOR,
                'label' => 'Background color',
                'type' => 'color_picker',
                'enable_opacity' => false,
            ),
            array(
                'key' => create_acf_key(Options::COLOR_FOR_GRADIENT),
                'name' => Options::COLOR_FOR_GRADIENT,
                'label' => 'Second background color for gradient',
                'type' => 'color_picker',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => create_acf_key(Options::IS_ENABLED_GRADIENT),
                            'operator' => '==',
                            'value' => 1,
                        ),
                    ),
                ),
                'enable_opacity' => false,
            ),
            array(
                'key' => create_acf_key(Options::IS_ENABLED_GRADIENT),
                'name' => Options::IS_ENABLED_GRADIENT,
                'label' => 'Gradient background',
                'type' => 'true_false',
                'required' => 0,
                'ui' => 1,
                'ui_on_text' => 'On',
                'ui_off_text' => 'Off',
                'default_value' => 1,
            ),
            array(
                'key' => 'field_hero_cards',
                'label' => 'Cards',
                'name' => 'hero_cards',
                'type' => 'repeater',
                'required' => 1,
                'min' => 2,
                'max' => 0, // 0 - без обмежень
                'layout' => 'row',
                'button_label' => 'Add card',
                'instructions' => 'Minimum 2 cards.',
                'sub_fields' => array(
                    array(
                        'key' => 'field_hero_cards_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'required' => 0,
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                    ),
                    array(
                        'key' => 'field_hero_cards_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_hero_cards_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'wysiwyg',
                        'required' => 1,
                        'delay' => 0,
                        'media_upload' => 0,
                        'tabs' => 'all', // 'all', 'visual', 'text'
                        'toolbar' => 'basic',
                        'default_value' => '',
                        'placeholder' => '',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/hero',
                ),
            ),
        ),
    ));
}
