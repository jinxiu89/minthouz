function gNotice() {
    var close = $('#g-notice .close');
    close.click(function () {
        $(this).parents('#g-notice').stop(true, false).slideUp(200)
    })
}

// 2020.10.08 添加导航交互样式 - 新版
function gMenuHover() {
    var nav = $('#nav'),
        navItem = $('#menu-list .menu-item');
    nav.mouseleave(function () {
        nav.removeClass('navActive');
        $(this).find('.item-children').stop(true, false).slideUp(200);
        $(this).find('.menu-item').removeClass('menu-item-active');
    });
    navItem.mouseenter(function () {
        var _this = this,
            _thisItemDom = $(_this).children('.item-children');
        nav.addClass('navActive');
        $(_this).siblings('li').removeClass('menu-item-active');
        $(_this).addClass('menu-item-active');
        navItem.toArray().forEach(function (item) {
            var itemDom = $(item).children('.item-children');
            if (itemDom.css('display') === 'block') {
                _thisItemDom.css('display', 'block');
                if (_thisItemDom.length === 0) {
                    $(_this).siblings('li').children('.item-children').stop(true, false).slideUp(200)
                } else {
                    $(_this).siblings('li').children('.item-children').css('display', 'none');
                }
            }
        });
        $(_this).children('.item-children').stop(true, false).slideDown(200)
    });
}

/*todo: 导航交互改造
* 1.当用户向下滑动页面时，导航条不会随之固定到视窗顶部。产品详情页用户向下滑动页面时，产品标题固定到视窗顶部
* 2.当用户向上滑动页面时，导航条固定到视窗顶部（效果为滑动显示，而不是一瞬间出现导航）
* 3.特别注意：首页由于导航做的时透明效果，所以当向上滑动时，需要额外给导航背景，以及在滑动到原本导航位置时需要移除背景，重新变成透明背景
* */

/*function navFixedTop () {
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
}*/

function gTop() {
    var g_top = $("#g-top");
    g_top.click(function () {
        $("html,body").animate({"scrollTop": 0}, 300);
    });
}

$(function () {

    gNotice();

    gMenuHover();

    // navFixedTop();

    // $(window).bind('scroll', navFixedTop);

    gTop();

});
