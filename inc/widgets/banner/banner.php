<?php

/*
Widget Name: Banner
Description: Chọn ảnh để hiển thị ở banner sidebar
*/

class Banner_Widget extends SiteOrigin_Widget
{
    function __construct()
    {
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'banner-widget',

            // The name of the widget for display purposes.
            __('Banner', 'tolich'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Chọn ảnh hiển thị ở banner sidebar', 'tolich'),
                'panels_groups' => array('tolich')
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'banner' => array(
                    'type' => 'repeater',
                    'label' => __('Chọn ảnh hiển thị trong banner.', 'tolich'),
                    'item_name' => __('Ảnh', 'tolich'),
                    'fields' => array(
                        'image' => array(
                            'type' => 'media',
                            'label' => __('Chọn ảnh', 'tolich')
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
        return 'banner-tpl';
    }

    function get_style_name($instance)
    {
        return '';
    }


}

siteorigin_widget_register('banner-widget', __FILE__, 'Banner_Widget');