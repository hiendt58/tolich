<?php get_header(); ?>
    <div class="blog-posts">
        <div class="blog-title">
            <h3><?php echo get_the_title(get_option('page_for_posts', true)); ?></h3>
        </div>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php get_template_part('content'); ?>
        <?php endwhile; ?>
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
<?php get_footer(); ?>