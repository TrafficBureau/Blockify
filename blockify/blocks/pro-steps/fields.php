<?php

add_action('acf/init', 'register_pro_steps_acf_fields');

function register_pro_steps_acf_fields()
{
    acf_add_local_field_group(array(
        'key' => 'group_pro_steps',
        'title' => 'Pro Steps Fields',
        'fields' => array(
            array(
                'key' => 'field_pro_steps_color',
                'label' => 'Number color',
                'name' => 'pro_steps_color',
                'type' => 'color_picker',
                'required' => 1,
                'default_value' => '#e6e6e6',
                'enable_opacity' => false,
            ),
            array(
                'key' => 'field_pro_steps_background_color',
                'label' => 'Background color',
                'name' => 'pro_steps_background_color',
                'type' => 'color_picker',
                'required' => 1,
                'default_value' => '#efefef',
                'enable_opacity' => false,
            ),
            array(
                'key' => 'field_pro_steps',
                'label' => 'Steps',
                'name' => 'pro_steps',
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
