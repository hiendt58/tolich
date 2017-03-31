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

    $("label[for='_dwqa_anonymous_email'").text("Email");
    $("label[for='_dwqa_anonymous_name'").text("Họ tên");
    $('.dwqa-content-edit-form label[for=question_title]').text("Tiêu đề câu hỏi");
    $('#question-title').attr("placeholder", 'Tiêu đề câu hỏi');
    $("input[name='dwqa-question-submit']").val('Gửi câu hỏi');
    $("input[name='submit-answer']").val('Gửi câu trả lời');
    $("input[name='dwqa-edit-question-submit']").val('Lưu thay đổi');
    $('.wp-editor-area').attr('placeholder', 'Nhập câu hỏi của bạn');
    $('.dwqa-answer-form-title').text("Câu trả lời của bạn");

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
            isFixed = true;
        } else if (!shouldBeFixed && isFixed) {
            nav.css({

                position: 'relative'
            });
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
    $(".comment-form-comment").each(function () {
        var comment_form = $(this);
        var mail_form = $('.comment-form-email');
        comment_form.insertAfter(mail_form);
    });

    var img_height = $('.post-thumbnail.image img').height();
    $('.post-thumbnail.default img').height(img_height);

    $('img.alignnone').each(function () {
        $src = $(this).attr('src');
        $element = '<a href="' + $src + '" data-lightbox="roadtrip"></a>';
        $(this).wrap($element);

    })

});

