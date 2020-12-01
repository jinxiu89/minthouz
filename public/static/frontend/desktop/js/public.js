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

//全局侧边栏的返回顶部的按钮
function gTop() {
    var g_top = $("#g-top");
    g_top.click(function () {
        $("html,body").animate({"scrollTop": 0}, 300);
    });
}

/*todo: 导航交互改造
* 1.当用户向下滑动页面时，导航条不会随之固定到视窗顶部。产品详情页用户向下滑动页面时，产品标题固定到视窗顶部
* 2.当用户向上滑动页面时，导航条固定到视窗顶部（效果为滑动显示，而不是一瞬间出现导航）
* 3.特别注意：首页由于导航做的时透明效果，所以当向上滑动时，需要额外给导航背景，以及在滑动到原本导航位置时需要移除背景，重新变成透明背景
* */

//1、判断滚动条是向上还是向下滚动
function pageScroll() {
    var p = 0,
        t = 0;
    $(window).scroll(function () {
        p = $(this).scrollTop();
        if (t < p) { // 向下滚动
            scrollDown(p, t)
        } else { // 向上滚动
            scrollUp(p, t)
        }
        setTimeout(function () {t = p;}, 0)
    })
}

// todo: 基本功能完成，下一步需要添加渐变的效果
function scrollDown (p, t) {
    var header = $('.g-hd'),
        noticeHeight = $('.g-notice').outerHeight(true) || 0,
        hdHeight = $('.g-hd .hd').outerHeight(true) || 0,
        navHeight = $('.g-hd .nav').outerHeight(true) || 0,
        headerHeight = hdHeight + navHeight;
    if (p >= (headerHeight + noticeHeight)) {
        console.log('导航取消固定');
        header.removeClass('cloneNav');
        $('.g-section').css('paddingTop', 0 + 'px');
    }
}

// todo: 基本功能完成，下一步需要添加渐变的效果
function scrollUp (p, t) {
    var header = $('.g-hd'),
        noticeHeight = $('.g-notice').outerHeight(true) || 0,
        hdHeight = $('.g-hd .hd').outerHeight(true) || 0,
        navHeight = $('.g-hd .nav').outerHeight(true) || 0,
        headerHeight = hdHeight + navHeight;
    header.css('height', headerHeight + 'px');
    if (p <= noticeHeight) {
        console.log('导航取消固定');
        header.removeClass('cloneNav');
        $('.g-section').css('paddingTop', 0 + 'px');
    } else {
        console.log('导航固定');
        header.addClass('cloneNav');
        $('.g-section').css('paddingTop', headerHeight + 'px');
    }
}

$(function () {

    gNotice();

    gMenuHover();

    gTop();

    pageScroll()

});
