function menuHover () {
    var nav = $('#nav'),
        navItem = $('#menu-list .menu-item');
    navItem.hover(function () {
        nav.toggleClass('navActive');
        $(this).children('.item-children').stop(true, false).fadeToggle(300);
    })
}

$(function () {

    menuHover();

});