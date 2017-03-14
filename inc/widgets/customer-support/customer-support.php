<?php

/*
Widget Name: Hỗ trợ khách hàng
Description: Hiển thị toàn bộ danh sách nhân viên hỗ trợ khách hàng
*/

class Customer_Support_Widget extends SiteOrigin_Widget
{
    function __construct()
    {
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'customer-support-widget',

            // The name of the widget for display purposes.
            __('Hỗ trợ khách hàng', 'tolich'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Hiển thị toàn bộ danh sách thông tin nhân viên hỗ trợ khách hàng', 'tolich'),
                'panels_groups' => array('tolich')
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'heading' => array(
                    'type' => 'text',
                    'label' => __('Tiêu đề', 'tolich')
                ),
                'hotline' => array(
                    'type' => 'text',
                    'label' => __('Hotline', 'tolich'),
                ),
                'list_infor' => array(
                    'type' => 'repeater',
                    'label' => __('Thông tin hỗ trợ khách hàng', 'tolich'),
                    'item_name' => __('Các bộ phận và nhân viên', 'tolich'),

                    'fields' => array(
                        'department' => array(
                            'type' => 'text',
                            'label' => __('Phòng ban/ Bộ phận', 'tolich')
                        ),
                        'employee' => array(
                            'type' => 'repeater',
                            'label' => __('Thông tin nhân viên', 'tolich'),
                            'item_name' => __('Nhân viên', 'tolich'),

                            'fields' => array(
                                'em_name' => array(
                                    'type' => 'text',
                                    'label' => __('Tên nhân viên', 'tolich')
                                ),
                                'em_phone' => array(
                                    'type' => 'text',
                                    'label' => __('Số điện thoại', 'tolich')
                                ),
                                'em_skype' => array(
                                    'type' => 'text',
                                    'label' => __('Skype', 'tolich')
                                )
                            )

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
        return 'customer-support-tpl';
    }

    function get_style_name($instance)
    {
        return '';
    }


}

siteorigin_widget_register('customer-support-widget', __FILE__, 'Customer_Support_Widget');