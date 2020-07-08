function gNotice () {
    var close = $('#g-notice .close');
    close.click(function () {
        $(this).parents('#g-notice').slideUp()
    })
}

function menuHover () {
    var nav = $('#nav'),
        navItem = $('#menu-list .menu-item');
    navItem.hover(function () {
        nav.toggleClass('navActive');
        $(this).children('.item-children').stop(true, false).fadeToggle(300);
    })
}

$(function () {

    gNotice();

    menuHover();

});