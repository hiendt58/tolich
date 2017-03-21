jQuery(document).ready(function ($) {

    // $('#searchform').on('hover', function () {
    //     $('.form-group').toggle();
    //     $('#searchsubmit').toggle();
    //
    // });
    // $('#searchform').on('keypress', function () {
    //     if ($this.keyCode == 13) {
    //         $('#searchsubmit').click();
    //     }
    // });


    // Stick the #nav to the top of the window
    var nav = $('#header .navbar');
    var navHomeY = nav.offset().top;
    var isFixed = false;
    var $w = $(window);
    var width = $(window).width();
    $w.scroll(function () {
        if (width <= 768) {
            return;
        }
        var scrollTop = $w.scrollTop();
        var shouldBeFixed = scrollTop > navHomeY;
        if (shouldBeFixed && !isFixed) {
            nav.css({

                position: 'fixed',
                top: 0,
                left: nav.offset().left,
                width: nav.width()
            });
            $('.navbar-brand > img').css({
                height: '100%',
                top: 0,
            });
            // $('#header .navbar-default .navbar-collapse').css({transform: 'translateY(30%)'});
            isFixed = true;
        } else if (!shouldBeFixed && isFixed) {
            nav.css({

                position: 'relative'
            });
            $('.navbar-brand > img').css({
                height: '150%',
                bottom: '0',
                top: 'auto'
            })
            // $('#header .navbar-default .navbar-collapse').css({transform: 'translateY(15%)'});
            isFixed = false;
        }
    });
    $('<div class="border-right"></div>').insertAfter('#main-content h3');
    $('<div class="border-right"></div>').insertAfter('.logo-carousel-widget h3.widget-title');
    $('<div class="border-left"></div>').insertBefore('.logo-carousel-widget h3.widget-title');

    // owl-carousel slider in the footer section
    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        navText: ["<div></div>", "<div'></div>"],
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
        // center: true,
        // stagePadding: 30,
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            480: {
                items: 3,
            },
            768: {
                items: 5,
            },
            1024: {
                items: 6
            }
        },

    });
    $(".owl-carousel").trigger('play.owl.autoplay', [1000]);
    var height = $('.owl-item img').width();
    $('.owl-item img').css({'height': height + 'px'});

   // change comment form template
    $(".comment-form-comment").each(function() {
        var comment_form = $(this);
        var mail_form = $('.comment-form-email');
        comment_form.insertAfter(mail_form);
    });

    var img_height = $('.post-thumbnail.image img').height();
    $('.post-thumbnail.default img').height(img_height);

});

