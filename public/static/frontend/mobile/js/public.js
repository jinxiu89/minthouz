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

function gNavPositionTop () {
    var nav = $('.g-hd');
    var notice = $('.g-notice');
    $(window).bind('scroll', function () {
        var scroll = $(document).scrollTop();
        var noticeH = notice.css('display') === 'none' ? 0 : notice.height();
        if (scroll > noticeH) {
            nav.addClass('g-hd-fixed');
            $('section').css('padding-top', nav.height() || 0);
        } else {
            nav.removeClass('g-hd-fixed');
            $('section').css('padding-top', 0);
        }
    })
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

    gNavPositionTop();

    gTop();

});
