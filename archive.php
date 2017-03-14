<?php get_header(); ?>
    <div class="container">
        <div id="content" class="row">
            <section id="sidebar" class="col-lg-3 col-sm-3 col-xs-0">
                <?php get_sidebar(); ?>
            </section>
            <section id="main-content" class="col-lg-9 col-sm-9 col-xs-12">
                <?php if (get_post_type() == 'products'): ?>
                    <?php get_template_part('archive', 'product'); ?>

                <?php else: ?>
                    <div id="archive">

                        <div class="archive-title">
                            <h3>
                                <?php echo get_the_archive_title() ?>
                            </h3>
                        </div>
                        <div class="row list-posts">
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
                    <?php
                    if (is_active_sidebar('list-category')) {
                        dynamic_sidebar('list-category');
                    } else {
                        _e('Đây là vùng hiển thị widget. Truy cập Appearance -> Widgets để thêm các widget mới.', 'tolich');
                    }
                    ?>
                <?php endif; ?>
            </section>
        </div>
    </div>

<?php get_footer(); ?>