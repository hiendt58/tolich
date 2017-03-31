<div class="single-content">
    <div class="title">
        <h3><?php echo get_the_title() ?></h3>
    </div>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php get_template_part('content', 'customer'); ?>
    <?php endwhile; ?>

    <?php else : ?>
        <?php get_template_part('content', 'none'); ?>
    <?php endif; ?>
</div>

