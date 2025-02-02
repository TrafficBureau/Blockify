<?php

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
                'name' => 'hero_title',
                'type' => 'text',
                'required' => 1,
            ),
            array(
                'key' => 'field_hero_subtitle',
                'label' => 'Subtitle',
                'name' => 'hero_subtitle',
                'type' => 'text',
                'required' => 1,
            ),
            array(
                'key' => 'field_hero_image',
                'label' => 'Hero',
                'name' => 'hero_image',
                'type' => 'image',
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'instructions' => 'Image size: 650x774. Not required.',
            ),
            array(
                'key' => 'field_hero_color',
                'label' => 'Background color',
                'name' => 'hero_color',
                'type' => 'color_picker',
                'required' => 1,
                'default_value' => '#ededed',
                'enable_opacity' => false,
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
                        'required' => 1,
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
