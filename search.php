<?php get_header(); ?>
    <div class="search-info">

        <?php
        $search_query = new WP_Query('s=' . $s . '&showposts=-1');
        $search_keyword = wp_specialchars($s, 1);
        $search_count = $search_query->post_count;
        //var_dump( $search_query );
        printf(__('Kết quả tìm kiếm cho <strong>%1$s</strong>. Tìm được <strong>%2$s</strong> bài tương ứng.', 'tolich'), $search_keyword, $search_count);
        ?>
    </div>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php get_template_part('content', get_post_format()); ?>
<?php endwhile; ?>
    <?php tolich_pagination(); ?>
<?php else : ?>
    <?php get_template_part('content', 'none'); ?>
<?php endif; ?>


<?php get_footer(); ?>