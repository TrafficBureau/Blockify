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
                'key' => 'field_hero_title',
                'label' => 'Title',
                'name' => Options::TITLE,
                'type' => 'text',
                'required' => 1,
            ),
            array(
                'key' => 'field_hero_subtitle',
                'label' => 'Subtitle',
                'name' => Options::SUBTITLE,
                'type' => 'text',
                'required' => 0,
            ),
            array(
                'key' => 'field_hero_image',
                'label' => 'Hero',
                'name' => Options::HERO_IMAGE,
                'type' => 'image',
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'instructions' => 'Image size: 650x774. Not required.',
            ),
            array(
                'key' => 'field_hero_title_color',
                'label' => 'Title color',
                'name' => Options::TITLE_COLOR,
                'type' => 'color_picker',
                'enable_opacity' => false,
            ),
            array(
                'key' => 'field_hero_subtitle_color',
                'label' => 'Subtitle color',
                'name' => Options::SUBTITLE_COLOR,
                'type' => 'color_picker',
                'enable_opacity' => false,
            ),
            array(
                'key' => 'field_hero_color',
                'label' => 'Background color',
                'name' => Options::BACKGROUND_COLOR,
                'type' => 'color_picker',
                'enable_opacity' => false,
            ),
            array(
                'key' => 'field_hero_color_gradient',
                'label' => 'Second background color for gradient',
                'name' => Options::COLOR_FOR_GRADIENT,
                'type' => 'color_picker',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_hero_color_is_enabled_gradient',
                            'operator' => '==',
                            'value' => 1,
                        ),
                    ),
                ),
                'enable_opacity' => false,
            ),
            array(
                'key' => 'field_hero_color_is_enabled_gradient',
                'label' => 'Gradient background',
                'name' => Options::IS_ENABLED_GRADIENT,
                'type' => 'true_false',
                'required' => 0,
                'ui' => 1,
                'ui_on_text' => 'On',
                'ui_off_text' => 'Off',
                'default_value' => 0,
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
