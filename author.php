<?php get_header(); ?>

    <div class="author-box"><?php
        // display author avatar
        echo '<div class="author-avatar">' . get_avatar(get_the_author_meta('ID')) . '</div>';

        // display author name
        printf('<h3>' . __('Đăng bởi %1$s', 'tolich') . '</h3>', get_the_author());

        // display author description
        echo '<p>' . get_the_author_meta('description') . '</p>';

        // display author website field
        if (get_the_author_meta('user_url')) : printf(__('<a href="%1$s" title="Ghé thăm trang %2$s">Ghé thăm website của tôi</a>', 'tolich'),
            get_the_author_meta('user_url'), get_the_author());
        endif;
        ?></div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php get_template_part('content', get_post_format()); ?>
<?php endwhile; ?>
    <?php tolich_pagination(); ?>
<?php else : ?>
    <?php get_template_part('content', 'none'); ?>
<?php endif; ?>

<?php get_footer(); ?>