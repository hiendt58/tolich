<?php get_header(); ?>
    <div class="container">
        <div id="content" class="row">
            <div class="search-info">

                <?php
                $search_query = new WP_Query('s=' . $s . '&showposts=-1');
                $search_keyword = wp_specialchars($s, 1);
                $search_count = $search_query->post_count;
                //var_dump( $search_query );
                printf(__('Kết quả tìm kiếm cho <strong>%1$s</strong>. Tìm được <strong>%2$s</strong> bài tương ứng.', 'tolich'), $search_keyword, $search_count);
                ?>
            </div>
            <section id="sidebar" class="col-lg-3 col-sm-3 col-xs-0">
                <?php get_sidebar(); ?>
            </section>
            <section id="main-content" class="col-lg-9 col-sm-9 col-xs-12">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php get_template_part('content', get_post_format()); ?>
                <?php endwhile; ?>
                    <?php tolich_pagination(); ?>
                <?php else : ?>
                    <?php get_template_part('content', 'none'); ?>
                <?php endif; ?>
            </section>


        </div>

    </div>

<?php get_footer(); ?>