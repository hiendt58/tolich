<?php

/**
 * @ Define important variables for the theme
 * @ THEME_URL = get_stylesheet_directory() - get the path to the theme root folder
 * @ CORE = directory/ theme core (if necessary)
 **/
define('THEME_URL', get_stylesheet_directory());
define('CORE', THEME_URL . '/core');

// Register Bootstrap Navigation Walker
include 'wp_bootstrap_navwalker.php';

/**
 * @ Define functions that supported by theme
 **/
if (!function_exists('tolich_theme_setup')) {
    function tolich_theme_setup()
    {
        /*
         * Define a translatable theme
         */
        $language_folder = THEME_URL . '/languages';
        load_theme_textdomain('tolich', $language_folder);

        /*
         * Automatic add RSS Feed links into <head>
         */
        add_theme_support('automatic-feed-links');

        /*
         * Add thumbnail
         */
        add_theme_support('post-thumbnails');

        /*
         * Add function to automatically add <title> tag
         */
        add_theme_support('title-tag');

        #custom logo support
        add_theme_support('custom-logo', array('height' => 45, 'width' => 'auto', 'flex-height' => true, 'flex-width' => true));

        /*
         * Add menu for theme
         */
        register_nav_menu('primary-menu', __('Menu chính', 'tolich'));

        /*
         * Create sidebar for theme
         */
        $sidebar = array(
            'name' => __('Sidebar chính', 'tolich'),
            'id' => 'main-sidebar',
            'description' => 'Sidebar chính cho theme Tolich',
            'class' => 'main-sidebar',
            'before_title' => '<h3 class="widget-title">',
            'after_sidebar' => '</h3>'
        );
        register_sidebar($sidebar);

        $footer_sidebar = array(
            'name' => __('Footer Sidebar', 'tolich'),
            'id' => 'footer-sidebar',
            'description' => 'Chỉnh sửa thông tin hiển thị trong footer',
            'class' => 'footer-sidebar',
            'before_title' => '<h3 class="widget-title">',
            'after_sidebar' => '</h3>'
        );
        register_sidebar($footer_sidebar);

        $toolbar = array(
            'name' => __('Toolbar', 'tolich'),
            'id' => 'toolbar',
            'description' => 'Chỉnh sửa thông tin hiển thị trong trên toolbar',
            'class' => 'toolbar',
            'before_title' => '<h3 class="widget-title">',
            'after_sidebar' => '</h3>'
        );
        register_sidebar($toolbar);

        $carousel_sidebar = array(
            'name' => __('Carousel Sidebar', 'tolich'),
            'id' => 'carousel-sidebar',
            'description' => 'Sidebar hiển thị carousel ở cuối trang cho theme Tolich',
            'class' => 'carousel-sidebar',
            'before_title' => '<h3 class="widget-title">',
            'after_sidebar' => '</h3>'
        );
        register_sidebar($carousel_sidebar);

        $list_category = array(
            'name' => __('List Category', 'tolich'),
            'id' => 'list-category',
            'description' => 'Thêm widget vào cuối trang blog và archive',
            'class' => 'list-category',
            'before_title' => '<h3 class="widget-title">',
            'after_sidebar' => '</h3>'
        );
        register_sidebar($list_category);
        /*
         * Đăng ký một post type mới
         */
        register_post_type('products',
            array(
                'labels' => array(
                    'name' => __('Sản phẩm', 'tolich'),
                    'singular_name' => __('Sản phẩm', 'tolich'),
                    'all_items' => __('Tất cả sản phẩm'),
                    'add_new' => __('Thêm sản phẩm'),
                    'update_item' => __('Cập nhật'),
                    'search_items' => __('Tìm kiếm'),
                    'not_found' => __('Không tìm thấy.'),
                    'not_found_in_trash' => __('Không tìm thấy trong thùng rác.'),
                ),
                'public' => true,
                'has_archive' => true,
//                'taxonomies' => array('category'),
                'rewrite' => array('slug' => 'san-pham'),
                'supports' => array('title', 'thumbnail', 'comments', 'editor')
            ));

        $args = array(
            'hierarchical' => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
            'labels' => "Chuyên mục",
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'product-category'),
        );

        register_taxonomy('product_categories', 'products', $args);
    }

    add_action('init', 'tolich_theme_setup');

}

//get

/**
 * @ Define the function to show the logo
 * @ tolich_logo()
 **/
if (!function_exists('tolich_logo')) {
    function tolich_logo()
    { ?>
        <a class="navbar-brand custom-logo" href="<?php bloginfo('url') ?>">
            <?php
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            if (has_custom_logo()) {
                echo '<img src="' . esc_url($logo[0]) . '" >';
            } else {
                echo '<h1>' . esc_attr(get_bloginfo('name')) . '</h1>';
            }
            ?></a>
    <?php }
}
/*
 * Add the title to the breadcrumbs
 */
function my_theme_archive_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }

    return $title;
}

add_filter('get_the_archive_title', 'my_theme_archive_title');

/**
 * @ Define the function to reference the menu
 * @ tolich_menu( $slug )
 **/
if (!function_exists('tolich_menu')) {
    function tolich_menu($slug)
    {
        ?>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <?php wp_nav_menu(array(
                    'menu' => 'main-menu',
                    'theme_location' => 'top',
                    'depth' => 2,
                    'container' => false,
                    'menu_class' => 'nav navbar-nav',
                    'walker' => new wp_bootstrap_navwalker(),
                    'fallback_cb' => 'wp_bootstrap_navwalker::fallback'
                )
            ); ?>
<!--            <form id="searchform" class="navbar-form navbar-left" role="search"-->
<!--                  action="--><?php //echo esc_url(site_url()); ?><!--" method="get">-->
<!--                <div class="form-group">-->
<!--                    <input id="s" name="s" type="text" class="form-control search-field"-->
<!--                           placeholder="--><?php //esc_attr_e('Search &hellip;', 'tolich'); ?><!--"-->
<!--                           value="--><?php //echo esc_attr(get_search_query()); ?><!--">-->
<!--                </div>-->
<!--                <button id="searchsubmit" type="submit" name="submit" class="btn btn-default">-->
<!--                    <img src="--><?php //echo get_template_directory_uri() ?><!--/assets/img/search-icon.png">-->
<!--                </button>-->
<!--            </form>-->
            <span class="search-icon">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/search-icon.png">
            </span>

        </div>
        <?php
    }
}

/**
 * @ Create a pagination for page index, archive.
 * @ tolich_pagination()
 **/
if (!function_exists('tolich_pagination')) {
    function tolich_pagination()
    {

        if (is_singular())
            return;

        global $wp_query;

        /** Stop execution if there's only 1 page */
        if ($wp_query->max_num_pages <= 1)
            return;

        $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
        $max = intval($wp_query->max_num_pages);

        /**    Add current page to the array */
        if ($paged >= 1)
            $links[] = $paged;

        /**    Add the pages around the current page to the array */
        if ($paged >= 3) {
            $links[] = $paged - 1;
            $links[] = $paged - 2;
        }

        if (($paged + 2) <= $max) {
            $links[] = $paged + 2;
            $links[] = $paged + 1;
        }

        echo '<div class="navigation"><ul>';

        /**    Previous Post Link */
        if (get_previous_posts_link())
            printf('<li>%s</li>', get_previous_posts_link("<<"));

        /**    Link to first page, plus ellipses if necessary */
        if (!in_array(1, $links)) {
            $class = 1 == $paged ? ' class="active"' : '';
            printf('<li%s><a href="%s">%s</a></li>', $class, esc_url(get_pagenum_link(1)), '1');

            if (!in_array(2, $links))
                echo '<li>…</li>';
        }

        /**    Link to current page, plus 2 pages in either direction if necessary */
        sort($links);
        foreach ((array)$links as $link) {
            $class = $paged == $link ? ' class="active"' : '';
            printf('<li%s><a href="%s">%s</a></li>', $class, esc_url(get_pagenum_link($link)), $link);
        }

        /**    Link to last page, plus ellipses if necessary */
        if (!in_array($max, $links)) {
            if (!in_array($max - 1, $links))
                echo '<li>…</li>';

            $class = $paged == $max ? ' class="active"' : '';
            printf('<li%s><a href="%s">%s</a></li>', $class, esc_url(get_pagenum_link($max)), $max);
        }

        /**    Next Post Link */
        if (get_next_posts_link())
            printf('<li>%s</li>', get_next_posts_link(">>"));

        echo '</ul></div>';

    }

}

/**
 * @ Function to show post thumbnail
 * @ The post thumbnail will not be shown in the single page, but image post
 * @ tolich_thumbnail( $size )
 **/
if (!function_exists('tolich_thumbnail')) {
    function tolich_thumbnail($size)
    {
        // Only show thumbnail with the post without password
        if (!is_single() && has_post_thumbnail() || has_post_format('image')) : ?>
            <figure class="post-thumbnail image"><?php the_post_thumbnail($size); ?></figure>
        <?php else: ?>
            <figure class="post-thumbnail default"><img
                        src="<?php echo get_template_directory_uri() ?>/assets/img/default.png">
            </figure>
        <?php endif;

    }
}


/**
 * @ Function to show post title in tag .entry-header
 * @ tolich_entry_header()
 **/
if (!function_exists('tolich_entry_header')) {
    function tolich_entry_header()
    {
        ?>
        <h4 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <?php the_title(); ?>
            </a>
        </h4>
        <?php
    }
}

/**
 * @ Function to show post's information (Post Meta)
 * @ tolich_entry_meta()
 **/
if (!function_exists('tolich_entry_meta')) {
    function tolich_entry_meta()
    {
        if (!is_page()) :
            echo '<div class="entry-meta">';

            // Show post author, date time and category
            printf(__('<span class="author">Đăng bởi %1$s</span>', 'tolich'),
                get_the_author());

            printf(__('<span class="date-published"> tại %1$s</span>', 'tolich'),
                get_the_date());

            printf(__('<span class="category"> trong %1$s</span>', 'tolich'),
                get_the_category_list(', '));

            // Show the number of comments
            if (comments_open()) :
                echo ' <span class="meta-reply">';
                comments_popup_link(
                    __('Bình luận', 'tolich'),
                    __('Một bình luận', 'tolich'),
                    __('% bình luận', 'tolich'),
                    __('Đọc tất cả bình luận', 'tolich')
                );
                echo '</span>';
            endif;
            echo '</div>';
        endif;
    }
}

/*
 * Add comment form
 */
if (!function_exists('tolich_comment_form')) {
    function tolich_comment_form()
    {
        $fields = array(
            'author' => '<p class="comment-form-author">' .
                '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' placeholder="' . __('Nhập tên của bạn', 'tolich') . '" aria-required="true" required="required"/></p>',
            'email' => '<p class="comment-form-email"> ' .
                '<input id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req . ' placeholder="' . __('Nhập email của bạn', 'tolich') . '" aria-required="true" required="required"/></p>',
        );

        $fields = apply_filters('comment_form_default_fields', $fields);
        $comments_args = array(
            'fields' => $fields,
            // Change the title of send button
            'label_submit' => __('Gửi bình luận', 'tolich'),
            // Change the title of the reply section
            'title_reply' => __('Bình luận bài viết', 'tolich'),
            'title_reply_before' => '<div class="title"><h3 id="reply-title" class="comment-reply-title">',
            'title_reply_after' => '</h3></div>',
            'comment_notes_before' => '',
            'logged_in_as' => '',
            // Remove "Text or HTML to be displayed after the set of comment fields".
            'comment_notes_after' => '',
            // Redefine your own textarea (the comment body).
            'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
        );
        comment_form($comments_args);
    }
}
/*
 * Add readmore and excerpt to the end of posts
 */
function tolich_readmore()
{
    return '...<a class="read-more" href="' . get_permalink(get_the_ID()) . '">' . __('Đọc tiếp >>', 'tolich') . '</a>';
}

add_filter('excerpt_more', 'tolich_readmore');

/**
 * @ Function to show information of post type
 * @ It will show the post excerpt in the home page (the_excerpt)
 * @ and full content in the single page
 * @ tolich_entry_content()
 **/
if (!function_exists('tolich_entry_content')) {
    function tolich_entry_content()
    {

        if (!is_single()) :
            the_excerpt();
        else :
            the_content();

            /*
             * Pagination code
             */
            $link_pages = array(
                'before' => __('<p>Page:', 'tolich'),
                'after' => '</p>',
                'nextpagelink' => __('Trang sau', 'tolich'),
                'previouspagelink' => __('Trang trước', 'tolich')
            );
            wp_link_pages($link_pages);
        endif;

    }
}

/**
 * @ Function to show post tags
 * @ tolich_entry_tag()
 **/
if (!function_exists('tolich_entry_tag')) {
    function tolich_entry_tag()
    {
        if (has_tag()) :
            echo '<div class="entry-tag">';
            printf(__('Tagged in %1$s', 'tolich'), get_the_tag_list('', ', '));
            echo '</div>';
        endif;
    }
}


/**
 * @ Import CSS and Javascript into theme
 * @ use hook wp_enqueue_scripts() to display them to front-end
 **/
function tolich_styles()
{
    wp_register_style('main-style', get_template_directory_uri() . '/style.css', 'all');
    wp_enqueue_style('main-style');
    wp_register_style('custom-style', get_template_directory_uri() . '/assets/css/style.css', 'all');
    wp_enqueue_style('custom-style');

    // Bootstrap
    wp_register_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', 'all');
    wp_enqueue_style('bootstrap');

    // Font-awesome
    wp_register_style('font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css', 'all');
    wp_enqueue_style('font-awesome');
    // Owl Carousel
    wp_register_style('owl-carousel-min', get_template_directory_uri() . '/assets/owlcarousel/owl.carousel.min.css', 'all');
    wp_enqueue_style('owl-carousel-min');
    wp_register_style('owl-carousel-default', get_template_directory_uri() . '/assets/owlcarousel/owl.theme.default.min.css', 'all');
    wp_enqueue_style('owl-carousel-default');
}

add_action('wp_enqueue_scripts', 'tolich_styles');

function tolich_scripts()
{
    // Register the script like this for a theme:
    wp_register_script('bootstrap-script', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array('jquery'));
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script('bootstrap-script');

    wp_register_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'));
    wp_enqueue_script('main-script');

    // JS for Owl Carousel
    wp_register_script('owl-script', get_template_directory_uri() . '/assets/owlcarousel/owl.carousel.min.js', array('jquery'));
    wp_enqueue_script('owl-script');
}

add_action('wp_enqueue_scripts', 'tolich_scripts');

// Breadcrumbs
function tolich_breadcrumbs()
{

    // Settings
    $separator = '>';
    $breadcrums_id = 'breadcrumbs';
    $breadcrums_class = 'breadcrumbs';
    $home_title = 'Trang chủ';

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy = 'products';

    // Get the query & post information
    global $post, $wp_query;

    // Do not display on the homepage
    if (!is_front_page()) {

        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';

        if (is_archive() && !is_tax() && !is_category() && !is_tag()) {

            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';

        } else if (is_archive() && is_tax() && !is_category() && !is_tag()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';

            }

            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';

        } else if (is_single()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                $term = get_the_terms(get_the_ID(), 'product_categories')[0];
                $cat_name = $term->name;
                $cat_link = get_term_link($term->slug, 'product_categories');

                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';

            }

            // Get post category info
            $category = get_the_category();

            if (!empty($category)) {

                // Get last category post is in
                $last_category = end(array_values($category));

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','), ',');
                $cat_parents = explode(',', $get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach ($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">' . $parents . '</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }

            }

            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);
                $cat_id = $taxonomy_terms[0]->term_id;
                $cat_nicename = $taxonomy_terms[0]->slug;
                $cat_link = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name = $taxonomy_terms[0]->name;

            }

            // Check if the post is in a category
            if (!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

                // Else if post is in a custom taxonomy
            } else if (!empty($cat_id)) {

                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

            } else {

                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

            }

        } else if (is_category()) {

            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';

        } else if (is_page()) {

            // Standard page
            if ($post->post_parent) {

                // If child page, get parents
                $anc = get_post_ancestors($post->ID);

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                if (!isset($parents)) $parents = null;
                foreach ($anc as $ancestor) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }

                // Display parent pages
                echo $parents;

                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';

            } else {

                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';

            }

        } else if (is_tag()) {

            // Tag page

            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args = 'include=' . $term_id;
            $terms = get_terms($taxonomy, $args);
            $get_term_id = $terms[0]->term_id;
            $get_term_slug = $terms[0]->slug;
            $get_term_name = $terms[0]->name;

            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';

        } elseif (is_day()) {

            // Day archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';

            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';

        } else if (is_month()) {

            // Month Archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';

        } else if (is_year()) {

            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';

        } else if (is_author()) {

            // Auhor archive

            // Get the author information
            global $author;
            $userdata = get_userdata($author);

            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';

        } else if (get_query_var('paged')) {

            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">' . __('Page') . ' ' . get_query_var('paged') . '</strong></li>';

        } else if (is_search()) {

            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';

        } elseif (is_404()) {

            // 404 page
            echo '<li>' . 'Lỗi 404' . '</li>';
        } elseif (is_home()) {
            echo '<li class="item-current item-current-' . get_the_title(get_option('page_for_posts', true)) . '"><strong class="bread-current bread-current-' . get_the_title(get_option('page_for_posts', true)) . '" title="Page ' . get_the_title(get_option('page_for_posts', true)) . '">' . get_the_title(get_option('page_for_posts', true)) . '</strong></li>';

        }

        echo '</ul>';

    }

}

function add_my_widgets_collection($folders)
{
    $folders[] = get_template_directory() . '/inc/widgets/';
    return $folders;
}

add_filter('siteorigin_widgets_widget_folders', 'add_my_widgets_collection');

// add group widget
function tolich_add_widget_tabs($tabs)
{
    $tabs[] = array(
        'title' => __('ToLich Widgets', 'tolich'),
        'filter' => array(
            'groups' => array('tolich')
        )
    );
    return $tabs;
}

add_filter('siteorigin_panels_widget_dialog_tabs', 'tolich_add_widget_tabs', 20);

// change excerpt length
function custom_excerpt_length($length)
{
    return 40;
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);


// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');

if (!function_exists('tolich_post_meta')) {
    function tolich_post_meta()
    {
        ?>
        <ul class="post_meta">
            <li class="meta">
                <label><?php _e("Mã sản phẩm:", "tolich") ?></label>
                <span><?php echo(get_post_meta(get_the_ID(), 'ma-san-pham')[0]) ?></span>
            </li>
            <li class="meta">
                <label><?php _e("Loại sản phẩm:", "tolich") ?></label>
                <span><?php echo(get_post_meta(get_the_ID(), 'loai-san-pham')[0]) ?></span>
            </li>
            <li class="meta">
                <label><?php _e("Đơn vị tính:", "tolich") ?></label>
                <span><?php echo(get_post_meta(get_the_ID(), 'don-vi-tinh')[0]) ?></span>
            </li>
            <li class="meta">
                <label><?php _e("Xuất xứ:", "tolich") ?></label>
                <span><?php echo(get_post_meta(get_the_ID(), 'xuat-xu')[0]) ?></span>
            </li>
            <li class="meta">
                <label><?php _e("Tình trạng:", "tolich") ?></label>
                <span><?php echo(get_post_meta(get_the_ID(), 'tinh-trang')[0]) ?></span>
            </li>
            <li class="meta">
                <label><?php _e("Kích thước:", "tolich") ?></label>
                <span><?php echo(get_post_meta(get_the_ID(), 'kich-thuoc')[0]) ?></span>
            </li>
        </ul>
        <?php
    }
}

include 'inc/widgets/list-products-category.php';
include 'inc/widgets/related-posts.php';
include 'inc/widgets/product-categories.php';