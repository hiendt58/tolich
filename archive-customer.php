<?php
global $wp_query;
$args = array_merge($wp_query->query_vars, array('post_type' => 'customers', 'posts_per_page' => '12'));
query_posts($args);
?>
    <div id="archive-customer">
        <div class="archive-title">
            <h3>
                <?php echo get_the_archive_title() ?>
            </h3>
        </div>
        <div class="list-posts">
            <?php if (have_posts()) :
            while (have_posts()) : the_post(); ?>

                <?php get_template_part('content', 'customer'); ?>

            <?php endwhile; ?>
        </div>
        <?php tolich_pagination(); ?>
        <?php else : ?>
            <?php get_template_part('content', 'none'); ?>
        <?php endif; ?>

    </div>
<?php
