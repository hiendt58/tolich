<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="clearfix">
        <?php if (!is_single()): ?>
            <div class="entry-thumbnail">
                <?php tolich_thumbnail('thumbnail'); ?>
            </div>
        <?php endif; ?>
        <div class="content">
            <header class="entry-header">
                <?php tolich_entry_header(); ?>
            </header>
            <div class="entry-content">
                <?php tolich_entry_content(); ?>
            </div>
        </div>

    </div>
</article>