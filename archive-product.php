<?php
global $wp_query;
$args = array_merge($wp_query->query_vars, array('post_type' => 'products', 'posts_per_page' => '16'));
query_posts($args);
?>
    <div id="archive-product">
        <div class="archive-title">
            <h3>
                <?php echo (get_the_terms(get_the_ID(), 'product_categories')[0]->name) ?>
            </h3>
        </div>
        <div class="row list-posts">
            <?php if (have_posts()) :
            while (have_posts()) : the_post(); ?>

                <?php get_template_part('content', 'product'); ?>

            <?php endwhile; ?>
        </div>
        <?php tolich_pagination(); ?>
        <?php else : ?>
            <?php get_template_part('content', 'none'); ?>
        <?php endif; ?>

    </div>
<?php
if (is_active_sidebar('list-category')) {
    dynamic_sidebar('list-category');
} else {
    _e('Đây là vùng hiển thị widget. Truy cập Appearance -> Widgets để thêm các widget mới.', 'tolich');
}
?>