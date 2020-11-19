function gNotice () {
    var close = $('#g-notice .close');
    close.click(function () {
        $(this).parents('#g-notice').slideUp()
    })
}

function menuBar () {
    var bar = $('#menu-bar'),
        menu = $('#menu-box');
    bar.click(function () {
        menu.stop(true, false).slideToggle();
        menu.find('.item-link').siblings('.child-menu').slideUp();
    });
    menu.find('.item-link').click(function () {
        $(this).siblings('.child-menu').stop(true, false).slideToggle();
    })
}

function navFixedTop () {
    var nav = $('.g-hd'),
        scroll = $(document).scrollTop(),
        notice = $('.g-notice'),
        noticeH = notice.css('display') === 'none' ? 0 : notice.outerHeight() || 0;
    if (scroll > noticeH) {
        nav.addClass('g-hd-fixed');
        $('section').css('padding-top', nav.outerHeight())
    } else {
        nav.removeClass('g-hd-fixed');
        $('section').css('padding-top', 0)
    }
}

function gTop () {
    var g_top = $("#g-top");
    function topBar () {
        var doc = $(document).scrollTop();
        if (doc >= 1000) {
            g_top.show();
        }
        if (doc < 1000) {
            g_top.hide();
        }
    }
    topBar();
    $(window).scroll(function () {
        topBar();
    });
    g_top.click(function () {
        $("html,body").animate({"scrollTop": 0}, 300);
    });
}

$(function () {
    gNotice();

    menuBar();

    navFixedTop();
    $(window).bind('scroll', navFixedTop)

    gTop();

});
