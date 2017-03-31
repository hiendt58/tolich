<div class="single-content">
    <div class="title">
        <h3><?php echo get_the_title() ?></h3>
    </div>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="career-content">
            <header class="customer-header">
                <?php tolich_entry_header(); ?>
            </header>
            <div class="description">
                <?php the_content() ?>
            </div>
            <?php tolich_career_meta() ?>
        </div>


    <?php endwhile; ?>

    <?php else : ?>
        <?php get_template_part('content', 'none'); ?>
    <?php endif; ?>
</div>