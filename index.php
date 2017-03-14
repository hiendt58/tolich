<?php get_header(); ?>
    <div class="container">
        <div id="content" class="row">
            <section id="sidebar" class="col-lg-3 col-sm-3 col-xs-0">
                <?php get_sidebar(); ?>
            </section>
            <section id="main-content" class="col-lg-9 col-sm-9 col-xs-12">
                <div class="title">
                    <h3><?php echo get_the_title() ?></h3>
                </div>
                <?php the_content() ?>
            </section>
        </div>
    </div>
<?php get_footer(); ?>