<?php get_header(); ?>
    <div class="page">
        <?php if (!is_front_page()): ?>
            <div class="title">
                <h3><?php echo get_the_title() ?></h3>
            </div>
        <?php endif; ?>
        <?php the_content() ?>
    </div>

<?php
if (is_active_sidebar('list-category')) {
    dynamic_sidebar('list-category');
} else {
    _e('Đây là vùng hiển thị widget. Truy cập Appearance -> Widgets để thêm các widget mới.', 'tolich');
}
?>

<?php get_footer(); ?>