<?php get_header(); ?>

<?php if (get_post_type() == 'products'): ?>
    <?php get_template_part('category', 'product'); ?>
<?php else: ?>
    <div id="archive">

        <div class="archive-title">
            <h3>
                <?php echo get_the_archive_title() ?>
            </h3>
        </div>
        <div class="list-posts">
            <?php if (have_posts()) :
            while (have_posts()) : the_post(); ?>

                <?php get_template_part('content'); ?>

            <?php endwhile; ?>
        </div>
        <?php tolich_pagination(); ?>
        <?php else : ?>
            <?php get_template_part('content', 'none'); ?>
        <?php endif; ?>

    </div>

<?php endif; ?>
<?php
if (is_active_sidebar('list-category')) {
    dynamic_sidebar('list-category');
} else {
    _e('Đây là vùng hiển thị widget. Truy cập Appearance -> Widgets để thêm các widget mới.', 'tolich');
}
?>
<?php get_footer(); ?>