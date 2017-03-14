<div class="logo-carousel-widget">
    <?php
    if (!empty($instance['heading'])) $title = $instance['heading'];
    ?>
    <div class="title"><h3 class="widget-title"><?php echo $title ?></h3></div>
    <?php
    if (!empty($instance['list_logo'])):
        ?>
        <div class="owl-carousel">
            <?php
            $repeater_items = $instance['list_logo'];
            foreach ($repeater_items as $index => $repeater_item):

                if (!empty($repeater_item['image'])) {
                    $src_image = wp_get_attachment_image_src($repeater_item['image']);
                }
                ?>
                <div class="image-logo item">
                    <img src="<?php if ($src_image[0]) {
                        echo $src_image[0];
                    } else {
                        echo get_template_directory_uri() . '/assets/img/default.png';
                    } ?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>