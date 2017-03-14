<?php get_header(); ?>
    <div class="container">
        <div id="content">
            <?php
            _e('<h2>404 PAGE NOT FOUND</h2>', 'tolich');
            _e('<p>Nội dung bạn vừa tìm kiếm không có. Vui lòng thử lại!</p>', 'tolich');

            get_search_form();

            _e('<h3>Content categories</h3>', 'tolich');
            echo '<div class="404-catlist">';
            wp_list_categories(array('title_li' => ''));
            echo '</div>';

            _e('<h3>Tag Cloud</h3>', 'tolich');
            wp_tag_cloud();
            ?>

        </div>
    </div>


<?php get_footer(); ?>