<?php

/*
Plugin Name: Clone Product Category
Description: Chọn chuyên mục sản phẩm để hiển thị trong trang
Version: 1.0
Author: Hien Doan
*/

// Register widget

add_action('widgets_init', 'clone_product_category');

function Clone_Product_Category()
{

    register_widget('Clone_Product_Category');

}

class Clone_Product_Category extends WP_Widget
{

    public function __construct()
    {

        parent::__construct(

            'Clone_Product_Category',
            __('Clone Product Category', 'tolich'),
            array(
                'classname' => 'clone_product_category',
                'description' => __('Chọn chuyên mục sản phẩm để hiển thị trong trang', 'tolich')
            )

        );

    }

    // Build the widget settings form

    function form($instance)
    {
        $defaults = array('category' => '');
        $instance = wp_parse_args(( array )$instance, $defaults);
        $category = $instance['category'];
        ?>
        <p>
            <label for="recent_posts_title"><?php _e('Chọn các category được hiển thị'); ?></label>
        </p>

        <p>
            <label for="products_category"><?php _e('Chuyên mục'); ?>:</label>
            <?php
            wp_dropdown_categories(array(
                'orderby' => 'title',
                'hide_empty' => false,
                'name' => $this->get_field_name('category'),
                'id' => 'products_category',
                'class' => 'widefat',
                'selected' => $category
            ));
            ?>
        </p>
        <?php

    }

    // Save widget settings

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['category'] = wp_strip_all_tags($new_instance['category']);
        return $instance;

    }

    // Display widget

    function widget($args, $instance)
    {
        extract($args);
        echo $before_widget;
        $category = $instance['category'];
        echo '<div class="category">';
        $cat_slug = get_category($category)->slug;
        $cat_recent_posts = new WP_Query(array(
            'post_type' => 'products',
            'posts_per_page' => '-1',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_categories',
                    'field' => 'slug',
                    'terms' => $cat_slug,
                ),
            ),
        ));
        if ($cat_recent_posts->have_posts()) {
            echo "<div class='products'>";
            while ($cat_recent_posts->have_posts()) {
                $cat_recent_posts->the_post();
                echo '<div class="product">';
                echo '<a href="' . get_permalink() . '" class="product-name">';
                tolich_thumbnail("thumbnail");
                echo get_the_title();
                echo '</a>';
                echo '</div>';
            }
            echo "</div>";
        }
        wp_reset_postdata();
        echo $after_widget;
    }
}

?>