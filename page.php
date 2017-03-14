<?php get_header(); ?>
    <div class="container">
        <div id="content" class="row">
            <section id="sidebar" class="col-lg-3 col-sm-3 col-xs-0">
                <?php get_sidebar(); ?>
            </section>
            <section id="main-content" class="col-lg-9 col-sm-9 col-xs-12">
                <?php if (!is_front_page()): ?>
                    <div class="title">
                        <h3><?php echo get_the_title() ?></h3>
                    </div>
                <?php endif; ?>
                <?php the_content() ?>
                <?php
                if (is_front_page()) {
                    if (is_active_sidebar('list-category')) {
                        dynamic_sidebar('list-category');
                    } else {
                        _e('Đây là vùng hiển thị widget. Truy cập Appearance -> Widgets để thêm các widget mới.', 'tolich');
                    }
                }
                ?>
            </section>
        </div>
    </div>
<?php get_footer(); ?>