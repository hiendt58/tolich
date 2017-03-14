<div class="content">
    <div class="title">
        <h3><?php echo get_the_title() ?></h3>
    </div>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php get_template_part('content', 'product'); ?>
    <?php endwhile; ?>

    <?php else : ?>
        <?php get_template_part('content', 'none'); ?>
    <?php endif; ?>
</div>
<?php tolich_comment_form(); ?>
<div class="related-products-widget widget related-products">
    <?php
    $cat = get_the_terms(get_the_ID(), 'product_categories')[0];
    ?>
    <div class="title">
        <h3 class="widget-title">Sản phẩm cùng loại</h3>
    </div>

    <?php

    $cat_recent_products = new WP_Query(array(
        'post_type' => 'products',
        'posts_per_page' => '4',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_categories',
                'field' => 'slug',
                'terms' => $cat->slug,
            ),
        ),
    ));

    if ($cat_recent_products->have_posts()) { ?>

        <div class='products'>
            <div class='row'>
                <?php
                while ($cat_recent_products->have_posts()) {

                    $cat_recent_products->the_post();
                    ?>
                    <div class="col-sm-3 col-xs-6">
                        <div class="product">

                            <a href="<?php get_permalink() ?>" class="product-name">
                                <div class="product-thumbnail">
                                    <?php tolich_thumbnail('thumbnail'); ?>
                                </div>
                                <div class="product-title">
                                    <?php echo get_the_title(); ?>
                                </div>

                                <div class='product-price'>Giá:
                                    <span><?php echo(get_post_meta(get_the_ID(), 'gia')[0]) ?></span>
                                </div>

                            </a>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    <?php } ?>


</div>
