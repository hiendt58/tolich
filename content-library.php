
<article id="library-<?php the_ID(); ?>" class="library ">
    <?php if (!is_single()): ?>
        <div class="clearfix">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <div class="library-thumbnail">
                    <?php tolich_thumbnail('thumbnail'); ?>
                </div>
                <header class="library-header">
                    <?php tolich_entry_header(); ?>
                </header>
            </a>
        </div>
    <?php else: ?>
        <header class="library-header">
            <?php tolich_entry_header(); ?>
        </header>
        </div>
        <div class="description">
            <?php the_content() ?>
        </div>
    <?php endif; ?>

</article>