<?php

/*
Plugin Name: Các chuyên mục sản phẩm
Description: Hiển thị tất cả các chuyên mục của sản phẩm
Version: 1.0
Author: Hien Doan
*/

// Register widget

add_action('widgets_init', 'product_categories');

function Product_Categories()
{

    register_widget('Product_Categories');

}

class Product_Categories extends WP_Widget
{

    public function __construct()
    {

        parent::__construct(

            'product_categories',
            __('Các chuyên mục sản phẩm', 'tolich'),
            array(
                'classname' => 'product_categories widget_recent_entries',
                'description' => __('Hiển thị tất cả các chuyên mục sản phẩm', 'tolich')
            )

        );

    }

// Build the widget settings form

    function form($instance)
    {

        $defaults = array('title' => '', 'number' => '3');
        $instance = wp_parse_args(( array )$instance, $defaults);
        $title = $instance['title'];


        ?>

        <p>
            <label for="product_cats_title"><?php _e('Tiêu đề: '); ?>:</label>
            <input type="text" class="widefat" id="product_cats_title"
                   name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>"/>
        </p>
        <?php

    }

// Save widget settings

    function update($new_instance, $old_instance)
    {

        $instance = $old_instance;
        $instance['title'] = wp_strip_all_tags($new_instance['title']);

        return $instance;

    }

// Display widget

    function widget($args, $instance)
    {

        extract($args);

        echo $before_widget;
        $title = $instance['title'];
        $arr = array($title);

        if (!empty($title))
            echo '<h3 class="widget-title">' . $title . '</h3>';

        $taxonomy = 'product_categories';
        $terms = get_terms($taxonomy); // Get all terms of a taxonomy

        if ($terms && !is_wp_error($terms)) :
            ?>
            <ul>
                <?php foreach ($terms as $term) { ?>
                    <li class="cat-item">
                        <a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a>
                    </li>
                <?php } ?>
            </ul>
        <?php endif;

        echo $after_widget;
    }

}

?>