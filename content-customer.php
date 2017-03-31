
<article id="customer-<?php the_ID(); ?>" class="customer">
    <?php if (!is_single()): ?>
        <div class="clearfix">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <div class="customer-thumbnail">
                    <?php tolich_thumbnail('thumbnail'); ?>
                </div>
                <header class="customer-header">
                    <?php tolich_entry_header(); ?>
                </header>
                <div class="separator"></div>
                <div class="customer-meta">
                    <div><i class="fa fa-map-marker"></i><?php echo(get_post_meta($post->ID, 'địa_chỉ')[0]) ?></div>
                    <div><i class="fa fa-phone"></i><?php echo(get_post_meta($post->ID, 'điện_thoại')[0]) ?></div>
                    <div><i class="fa fa-globe"></i>
                        <?php $web_add = get_post_meta($post->ID, 'website')[0] ?>
                        <a href="<?php echo $web_add ?>"> <?php echo $web_add ?>
                    </div>
                    </div>

            </a>
        </div>
    <?php else: ?>
        <div class="clearfix">
            <div class="row">
                <div class="col-sm-5 col-xs-12">
                    <div class="customer-thumbnail">
                        <?php tolich_thumbnail('thumbnail'); ?>
                    </div>
                </div>
                <div class="col-sm-7 col-xs-12">
                    <header class="customer-header">
                        <?php tolich_entry_header(); ?>
                    </header>
                    <?php tolich_customer_meta() ?>
                </div>
            </div>
            <div class="description">
                <?php the_content() ?>

            </div>
        </div>
    <?php endif; ?>

</article>