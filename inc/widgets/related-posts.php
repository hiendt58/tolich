<?php

/*
Plugin Name: Bài viết liên quan
Description: Hiển thị post mới nhất và các bài trong cùng chuyên mục
Version: 1.0
Author: Hien Doan
*/

// Register widget

add_action('widgets_init', 'related_posts');

function related_posts()
{

    register_widget('Related_Posts');

}

class Related_Posts extends WP_Widget
{

    public function __construct()
    {

        parent::__construct(

            'related_posts',
            __('Bài viết liên quan', 'tolich'),
            array(
                'classname' => 'related_posts widget_recent_entries',
                'description' => __('Hiển thị bài viết mới nhất và các bài viết cùng chuyên mục', 'tolich')
            )

        );

    }

    // Build the widget settings form

    function form($instance)
    {

        $defaults = array('title' => '', 'category1' => '', 'category1' => '', 'category1' => '');
        $instance = wp_parse_args(( array )$instance, $defaults);
        $title = $instance['title'];
        $category1 = $instance['category1'];
        $category2 = $instance['category2'];
        $category3 = $instance['category3'];

        ?>

        <p>
            <label for="recent_posts_title"><?php _e('Tiêu đề'); ?>:</label>
            <input type="text" class="widefat" id="recent_posts_title"
                   name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>"/>
        </p>

        <p>
            <label for="recent_posts_category1"><?php _e('Chuyên mục 1'); ?>:</label>

            <?php

            wp_dropdown_categories(array(

                'orderby' => 'title',
                'hide_empty' => false,
                'name' => $this->get_field_name('category1'),
                'id' => 'recent_posts_category1',
                'class' => 'widefat',
                'selected' => $category1

            ));

            ?>

        </p>

        <p>
            <label for="recent_posts_category2"><?php _e('Chuyên mục 2'); ?>:</label>

            <?php

            wp_dropdown_categories(array(

                'orderby' => 'title',
                'hide_empty' => false,
                'name' => $this->get_field_name('category2'),
                'id' => 'recent_posts_category2',
                'class' => 'widefat',
                'selected' => $category2

            ));

            ?>

        </p>
        <p>
            <label for="recent_posts_category3"><?php _e('Chuyên mục 3'); ?>:</label>

            <?php

            wp_dropdown_categories(array(

                'orderby' => 'title',
                'hide_empty' => false,
                'name' => $this->get_field_name('category3'),
                'id' => 'recent_posts_category3',
                'class' => 'widefat',
                'selected' => $category3

            ));

            ?>

        </p>


        <?php

    }

    // Save widget settings

    function update($new_instance, $old_instance)
    {

        $instance = $old_instance;
        $instance['title'] = wp_strip_all_tags($new_instance['title']);
        $instance['category1'] = wp_strip_all_tags($new_instance['category1']);
        $instance['category2'] = wp_strip_all_tags($new_instance['category2']);
        $instance['category3'] = wp_strip_all_tags($new_instance['category3']);

        return $instance;

    }

    // Display widget

    function widget($args, $instance)
    {

        extract($args);

        echo $before_widget;

        $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
        $category1 = $instance['category1'];
        $category2 = $instance['category2'];
        $category3 = $instance['category3'];
        $arr = array($category1, $category2, $category3);

        if (!empty($title))
            echo '<div class="title"><h3 class="widget-title">'. $title .'</h3></div>';
        echo '<div class="row row-eq-height">';
        foreach ($arr as $cat) {
            echo '<div class="col-sm-4 col-xs-12">';
            echo '<div class="category">';
            echo '<h4 class="post-title">' . get_cat_name($cat) . '</h4>';
            $latest_post = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'cat' => $cat,

            ));
            echo '<div class="category-posts">';
            if ($latest_post->have_posts()) {

                $latest_post->the_post();
                echo '<div class="latest-post">';
                echo '<a href="' . get_permalink() . '">';
                tolich_thumbnail("thumbnail");
                echo '<p class="item-name">' . get_the_title() . '</p>';
                echo '</a>';
                echo '</div>';

            } else {

                _e('No posts yet.', 'tolich');

            }

            $cat_recent_posts = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => '3',
                'cat' => $cat,
                'offset' => 1,
                'orderby' => 'date',
            ));
            if ($cat_recent_posts->have_posts()) {
                while ($cat_recent_posts->have_posts()) {
                    $cat_recent_posts->the_post();
                    echo '<div class="related-post">';
                    echo '<a href="' . get_permalink() . '" class="post-name">';
                    echo get_the_title();
                    echo '</a>';
                    echo '</div>';
                }
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
            wp_reset_postdata();
        }
        echo '</div>';

        echo $after_widget;
    }

}

?>