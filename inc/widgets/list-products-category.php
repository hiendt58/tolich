<?php

/*
Plugin Name: Danh sách sản phẩm
Description: Hiển thị post mới nhất và các bài trong cùng chuyên mục
Version: 1.0
Author: Hien Doan
*/

// Register widget

add_action('widgets_init', 'list_product_category');

function List_Product_Category()
{

    register_widget('List_Product_Category');

}

class List_Product_Category extends WP_Widget
{

    public function __construct()
    {

        parent::__construct(

            'list_product_category',
            __('Danh sách sản phẩm', 'tolich'),
            array(
                'classname' => 'list_product_category widget_recent_entries',
                'description' => __('Hiển thị các sản phẩm theo từng chuyên mục', 'tolich')
            )

        );

    }

    // Build the widget settings form

    function form($instance)
    {

        $defaults = array('category1' => '', 'category1' => '', 'category1' => '');
        $instance = wp_parse_args(( array )$instance, $defaults);
        $category1 = $instance['category1'];
        $category2 = $instance['category2'];
        $category3 = $instance['category3'];
        $category4 = $instance['category4'];

        ?>

        <p>
            <label for="recent_posts_title"><?php _e('Chọn các category được hiển thị'); ?></label>

        </p>

        <p>
            <label for="products_category1"><?php _e('Chuyên mục 1'); ?>:</label>

            <?php

            wp_dropdown_categories(array(
                'orderby' => 'title',
                'hide_empty' => false,
                'name' => $this->get_field_name('category1'),
                'id' => 'products_category1',
                'class' => 'widefat',
                'selected' => $category1

            ));

            ?>

        </p>

        <p>
            <label for="products_category2"><?php _e('Chuyên mục 2'); ?>:</label>

            <?php

            wp_dropdown_categories(array(

                'orderby' => 'title',
                'hide_empty' => false,
                'name' => $this->get_field_name('category2'),
                'id' => 'products_category2',
                'class' => 'widefat',
                'selected' => $category2

            ));

            ?>

        </p>
        <p>
            <label for="products_category3"><?php _e('Chuyên mục 3'); ?>:</label>

            <?php

            wp_dropdown_categories(array(

                'orderby' => 'title',
                'hide_empty' => false,
                'name' => $this->get_field_name('category3'),
                'id' => 'products_category3',
                'class' => 'widefat',
                'selected' => $category3

            ));

            ?>

        </p>

        <p>
            <label for="products_category4"><?php _e('Chuyên mục 4'); ?>:</label>

            <?php

            wp_dropdown_categories(array(

                'orderby' => 'title',
                'hide_empty' => false,
                'name' => $this->get_field_name('category4'),
                'id' => 'products_category4',
                'class' => 'widefat',
                'selected' => $category4

            ));

            ?>

        </p>


        <?php

    }

    // Save widget settings

    function update($new_instance, $old_instance)
    {

        $instance = $old_instance;
        $instance['category1'] = wp_strip_all_tags($new_instance['category1']);
        $instance['category2'] = wp_strip_all_tags($new_instance['category2']);
        $instance['category3'] = wp_strip_all_tags($new_instance['category3']);
        $instance['category4'] = wp_strip_all_tags($new_instance['category4']);

        return $instance;

    }

    // Display widget

    function widget($args, $instance)
    {

        extract($args);

        echo $before_widget;
        $category1 = $instance['category1'];
        $category2 = $instance['category2'];
        $category3 = $instance['category3'];
        $category4 = $instance['category4'];
        $arr = array($category1, $category2, $category3, $category4);

        foreach ($arr as $cat) {
            echo '<div class="category">';
            echo '<div class="category-title">'.$before_title . get_cat_name($cat) . $after_title . '</div>';
            $cat_slug = get_category($cat)->slug;
            $cat_recent_posts = new WP_Query(array(
                'post_type' => 'products',
                'posts_per_page' => '4',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_categories',
                        'field'    => 'slug',
                        'terms'    => $cat_slug,
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
            echo '</div>';
            wp_reset_postdata();
        }
        wp_reset_postdata();
        echo $after_widget;
    }

}

?>