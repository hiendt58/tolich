<?php

/*
Widget Name: Logo Carousel
Description: Tạo slider logo ở phần footer
*/

class Logo_Carousel_Widget extends SiteOrigin_Widget
{
    function __construct()
    {
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'logo-carousel-widget',

            // The name of the widget for display purposes.
            __('Logo Carousel', 'tolich'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Tạo slider logo ở phần footer', 'tolich'),
                'panels_groups' => array('tolich')
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'heading' => array(
                    'type' => 'text',
                    'label' => __('Tiêu đề slide:')
                ),
                'list_logo' => array(
                    'type' => 'repeater',
                    'label' => __('Danh sách logo hiển thị trong slider'),
                    'item_name' => __('Logo', 'tolich'),
                    'fields' => array(
                        'image' => array(
                            'type' => 'media',
                            'label' => __('Chọn logo', 'tolich')
                        )
                    )
                )
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance)
    {
        return 'logo-carousel-tpl';
    }

    function get_style_name($instance)
    {
        return '';
    }


}

siteorigin_widget_register('logo-carousel-widget', __FILE__, 'Logo_Carousel_Widget');