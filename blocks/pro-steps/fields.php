<?php

use TrafficBureau\Blockify\ProSteps\Options;

if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', 'register_pro_steps_acf_fields');

function register_pro_steps_acf_fields()
{
    acf_add_local_field_group(array(
        'key' => 'group_pro_steps',
        'title' => 'Pro Steps Fields',
        'fields' => array(
            array(
                'key' => create_acf_key(Options::USE_GLOBAL_OPTIONS),
                'name' => Options::USE_GLOBAL_OPTIONS,
                'label' => 'Use global options first',
                'type' => 'true_false',
                'ui' => 1,
                'ui_on_text' => 'Yes',
                'ui_off_text' => 'No',
                'default_value' => 1,
            ),
            array(
                'key' => create_acf_key(Options::NUMBER_COLOR),
                'name' => Options::NUMBER_COLOR,
                'label' => 'Number color',
                'type' => 'color_picker',
                'enable_opacity' => false,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => create_acf_key(Options::USE_GLOBAL_OPTIONS),
                            'operator' => '!=',
                            'value' => 1,
                        ),
                    ),
                ),
            ),
            array(
                'key' => create_acf_key(Options::BACKGROUND_COLOR),
                'name' => Options::BACKGROUND_COLOR,
                'label' => 'Background color',
                'type' => 'color_picker',
                'enable_opacity' => true,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => create_acf_key(Options::USE_GLOBAL_OPTIONS),
                            'operator' => '!=',
                            'value' => 1,
                        ),
                    ),
                ),
            ),
            array(
                'key' => create_acf_key(Options::COLOR_FOR_GRADIENT),
                'name' => Options::COLOR_FOR_GRADIENT,
                'label' => 'Second background color for gradient',
                'type' => 'color_picker',
                'enable_opacity' => true,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => create_acf_key(Options::USE_GLOBAL_OPTIONS),
                            'operator' => '!=',
                            'value' => 1,
                        ),
                    ),
                ),
            ),
            array(
                'key' => create_acf_key(Options::LINE_COLOR),
                'name' => Options::LINE_COLOR,
                'label' => 'Line color',
                'type' => 'color_picker',
                'enable_opacity' => false,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => create_acf_key(Options::USE_GLOBAL_OPTIONS),
                            'operator' => '!=',
                            'value' => 1,
                        ),
                    ),
                ),
            ),
            array(
                'key' => create_acf_key(Options::STEPS),
                'name' => Options::STEPS,
                'label' => 'Steps',
                'type' => 'repeater',
                'required' => 1,
                'min' => 1,
                'max' => 0, // 0 - без обмежень
                'layout' => 'row',
                'button_label' => 'Add card',
                'instructions' => 'Minimum 1 step.',
                'sub_fields' => array(
                    [
                        'key' => 'field_pro_steps_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'required' => 1,
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                    ],
                    array(
                        'key' => 'field_pro_steps_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_pro_steps_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'textarea',
                        'required' => 1,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/pro-steps-blockify',
                ),
            ),
        ),
    ));
}
