<?php get_header(); ?>
    <div class="container">
        <div id="content" class="row">
            <section id="sidebar" class="col-lg-3 col-sm-3 col-xs-0">
                <?php get_sidebar(); ?>
            </section>
            <section id="main-content" class="col-lg-9 col-sm-9 col-xs-12">
                <?php if (get_post_type() == 'products'): ?>
                    <div id="single-product">
                        <?php get_template_part('single', 'product'); ?>
                    </div>

                <?php else: ?>
                    <div id="single">
                        <div class="content">
                            <div class="title">
                                <h3><?php echo get_the_title() ?></h3>
                            </div>
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <?php get_template_part('content'); ?>
                                <?php get_template_part('author-bio'); ?>
                            <?php endwhile; ?>

                            <?php else : ?>
                                <?php get_template_part('content', 'none'); ?>
                            <?php endif; ?>
                        </div>
                        <?php tolich_comment_form(); ?>

                    </div>
                <?php endif; ?>
            </section>
        </div>
    </div>

<?php get_footer(); ?>