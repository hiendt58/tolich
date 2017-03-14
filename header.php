<!DOCTYPE html>
<!--[if IE 8]>
<html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]>
<html <?php language_attributes(); ?>> <![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <title><?php echo get_bloginfo('name'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<div class="toolbar">
    <div class="container">
        <?php if (is_active_sidebar('toolbar')) {
            dynamic_sidebar('toolbar');
        } else {
            _e('Đây là vùng hiển thị Toolbar. Truy cập Appearance -> Widgets để thêm các widget mới.', 'tolich');
        }
        ?>
    </div>

</div>
<header id="header">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php tolich_logo() ?>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <?php tolich_menu('primary-menu') ?>


        </div>
    </nav>
    <?php if (is_front_page()) { ?>
        <?php echo do_shortcode("[rev_slider alias=\"home-page\"]"); ?>
    <?php } else { ?>
        <div class="container">
            <?php tolich_breadcrumbs(); ?>
        </div>
    <?php } ?>
</header>


