<?php

use TrafficBureau\Blockify\Relinking\Options;

if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', 'register_relinking_block_acf_fields');

function register_relinking_block_acf_fields()
{
    $use_global_key        = create_acf_key(Options::USE_GLOBAL_OPTIONS . '_relinking');
    $background_color_key  = create_acf_key(Options::BACKGROUND_COLOR . '_relinking');
    $text_color_key        = create_acf_key(Options::TEXT_COLOR . '_relinking');
    $title_color_key       = create_acf_key(Options::TITLE_COLOR . '_relinking');
    $button_bg_color_key   = create_acf_key(Options::BUTTON_BG_COLOR . '_relinking');
    $icon_color_key        = create_acf_key(Options::ICON_COLOR . '_relinking');
    $columns_key           = create_acf_key('relinking_columns');
    $items_type_key        = create_acf_key('relinking_items_type');

    acf_add_local_field_group(array(
        'key' => 'group_relinking_block',
        'title' => 'Relinking Block Fields',
        'fields' => array(
            array(
                'key' => $use_global_key,
                'name' => Options::USE_GLOBAL_OPTIONS,
                'label' => 'Use global options first',
                'type' => 'true_false',
                'ui' => 1,
                'ui_on_text' => 'Yes',
                'ui_off_text' => 'No',
                'default_value' => 1,
            ),
            array(
                'key' => $columns_key,
                'name' => 'relinking_columns',
                'label' => 'Blocks per row',
                'type' => 'select',
                'choices' => array(
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                    7 => '7',
                    8 => '8',
                ),
                'default_value' => 3,
                'ui' => 1,
            ),
            array(
                'key' => $items_type_key,
                'name' => 'relinking_items_type',
                'label' => 'Items type',
                'type' => 'select',
                'choices' => array(
                    'icon' => 'Block with icon and caption',
                    'image' => 'Block with image and button',
                ),
                'default_value' => 'icon',
                'ui' => 1,
            ),
            array(
                'key' => create_acf_key('relinking_items'),
                'name' => 'relinking_items',
                'label' => 'Relinking items',
                'type' => 'repeater',
                'required' => 1,
                'min' => 1,
                'layout' => 'row',
                'button_label' => 'Add item',
                'sub_fields' => array(
                    array(
                        'key' => create_acf_key('relinking_item_title'),
                        'name' => 'relinking_item_title',
                        'label' => 'Title',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    array(
                        'key' => create_acf_key('relinking_item_svg'),
                        'name' => 'relinking_item_svg',
                        'label' => 'Icon SVG',
                        'type' => 'textarea',
                        'rows' => 5,
                        'instructions' => 'Paste SVG markup here.',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => $items_type_key,
                                    'operator' => '==',
                                    'value' => 'icon',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => create_acf_key('relinking_item_alt'),
                        'name' => 'relinking_item_alt',
                        'label' => 'Icon alt text',
                        'type' => 'text',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => $items_type_key,
                                    'operator' => '==',
                                    'value' => 'icon',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => create_acf_key('relinking_item_description'),
                        'name' => 'relinking_item_description',
                        'label' => 'Description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                    array(
                        'key' => create_acf_key('relinking_item_url'),
                        'name' => 'relinking_item_url',
                        'label' => 'Link URL',
                        'type' => 'url',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => $items_type_key,
                                    'operator' => '==',
                                    'value' => 'icon',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => create_acf_key('relinking_item_image'),
                        'name' => 'relinking_item_image',
                        'label' => 'Image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => $items_type_key,
                                    'operator' => '==',
                                    'value' => 'image',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => create_acf_key('relinking_item_show_description'),
                        'name' => 'relinking_item_show_description',
                        'label' => 'Show description',
                        'type' => 'true_false',
                        'ui' => 1,
                        'ui_on_text' => 'Yes',
                        'ui_off_text' => 'No',
                        'default_value' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => $items_type_key,
                                    'operator' => '==',
                                    'value' => 'image',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => create_acf_key('relinking_item_button_text'),
                        'name' => 'relinking_item_button_text',
                        'label' => 'Button text',
                        'type' => 'text',
                        'default_value' => 'Learn more',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => $items_type_key,
                                    'operator' => '==',
                                    'value' => 'image',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => create_acf_key('relinking_item_button_url'),
                        'name' => 'relinking_item_button_url',
                        'label' => 'Button URL',
                        'type' => 'url',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => $items_type_key,
                                    'operator' => '==',
                                    'value' => 'image',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'key' => $background_color_key,
                'name' => Options::BACKGROUND_COLOR,
                'label' => 'Background color',
                'type' => 'color_picker',
                'enable_opacity' => true,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => $use_global_key,
                            'operator' => '!=',
                            'value' => 1,
                        ),
                    ),
                ),
            ),
            array(
                'key' => $text_color_key,
                'name' => Options::TEXT_COLOR,
                'label' => 'Text color',
                'type' => 'color_picker',
                'enable_opacity' => false,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => $use_global_key,
                            'operator' => '!=',
                            'value' => 1,
                        ),
                    ),
                ),
            ),
            array(
                'key' => $title_color_key,
                'name' => Options::TITLE_COLOR,
                'label' => 'Title color',
                'type' => 'color_picker',
                'enable_opacity' => false,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => $use_global_key,
                            'operator' => '!=',
                            'value' => 1,
                        ),
                    ),
                ),
            ),
            array(
                'key' => $button_bg_color_key,
                'name' => Options::BUTTON_BG_COLOR,
                'label' => 'Button color',
                'type' => 'color_picker',
                'enable_opacity' => false,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => $use_global_key,
                            'operator' => '!=',
                            'value' => 1,
                        ),
                    ),
                ),
            ),
            array(
                'key' => $icon_color_key,
                'name' => Options::ICON_COLOR,
                'label' => 'Icon color',
                'type' => 'color_picker',
                'enable_opacity' => false,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => $use_global_key,
                            'operator' => '!=',
                            'value' => 1,
                        ),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/relinking-blockify',
                ),
            ),
        ),
    ));
}
