<?php $class = "col-sm-3 col-xs-6"; ?>
<article id="product-<?php the_ID(); ?>" class="product <?php //if (!is_single()) echo $class ?>">
    <?php if (!is_single()): ?>
        <div class="clearfix">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
            <div class="product-thumbnail">
                <?php tolich_thumbnail('thumbnail'); ?>
            </div>
            <header class="product-header">
                <?php tolich_entry_header(); ?>
                <div class="product-price">
                    Giá:
                    <span><?php echo(get_post_meta($post->ID, 'gia')[0]) ?></span>
                </div>
            </header>
        </a>
        </div>
    <?php else: ?>
        <div class="clearfix">
            <div class="row product_meta">
                <div class="col-sm-5 col-xs-12">
                    <div class="product-thumbnail">
                        <a href="<?php echo get_the_post_thumbnail_url()?>" data-lightbox="product-image">
                        <?php tolich_thumbnail('thumbnail'); ?>
                        </a>
                    </div>
                </div>
                <div class="col-sm-7 col-xs-12">
                    <header class="product-header">
                        <?php tolich_entry_header(); ?>
                        <div class="product-price">
                            Giá:
                            <span><?php echo(get_post_meta($post->ID, 'gia')[0]) ?></span>
                        </div>
                    </header>
                    <?php tolich_product_meta() ?>
                    <div class="contact">
                        <div class="buy-now">
			<a href="tel:0969997980">
                            <img src="<?php echo get_template_directory_uri()?>/assets/img/buy-now.png"/>
			</a>
                        </div>
                        <div class="call-now">
                        <a href="tel:0969997980">
                            <img src="<?php echo get_template_directory_uri()?>/assets/img/call-now.png"/>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tech-infor">
                <div class="label">
                    <label><?php _e("Thông số kỹ thuật", 'tolich')?></label>
                </div>

                <div class="content">
                    <?php the_content()?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</article>