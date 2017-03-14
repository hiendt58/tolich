<div class="banner-widget">
    <?php
    if (!empty($instance['banner'])) {
        $banner = $instance['banner'];
        foreach ($banner as $index => $src) {
            if (!empty($src['image'])) {
                $src_image = wp_get_attachment_image_src($src['image']);
                ?>
                <div class="image">
                    <img src="<?php if ($src_image[0]) {
                        echo $src_image[0];
                    } else {
                        echo get_template_directory_uri() . '/assets/img/default.png';
                    } ?>" alt="">
                </div>

            <?php }
        }
    }
    ?>
</div> 