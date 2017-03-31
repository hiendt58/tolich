<?php get_header(); ?>

<?php if (get_post_type() == 'products'){ ?>
    <div id="single-product">
        <?php get_template_part('single', 'product'); ?>
    </div>
<?php } elseif(get_post_type() == 'customers'){ ?>
    <div id="single-customer">
        <?php get_template_part('single', 'customer'); ?>
    </div>
<?php } elseif(get_post_type() == 'careers'){ ?>
    <div id="single-career">
        <?php get_template_part('single', 'career'); ?>
    </div>
<?php }else{ ?>
    <div id="single">
        <div class="single-content">
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
<?php } ?>

<?php get_footer(); ?>