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
        nav.addClass('navActive');
        $(this).children('.item-children').css('display', 'block');
    }, function () {
        nav.removeClass('navActive');
        $(this).children('.item-children').css('display', 'none');
    })
}

/*function newMenu () {
    var nav = $('#nav'),
        navList = $('#menu-list'),
        navItem = $('#menu-list .menu-item');
    navList.hover(function () {
        nav.addClass('navActive');
    }, function () {
        nav.removeClass('navActive');
    });

    navItem.mouseenter(function () {
        if (nav.hasClass('navActive')) {
            $(this).children('.item-children').css('display', 'block');
        } else {
            $(this).children('.item-children').slideDown(300);
        }
    });
    navItem.mouseleave(function () {
        var x = navList.mouseover();
        console.log(x);
        if (nav.hasClass('navActive')) {
            $(this).children('.item-children').css('display', 'none');
        }
    });
}*/

function gTop () {
    var g_top = $("#g-top");
    g_top.click(function () {
        $("html,body").animate({"scrollTop": 0}, 300);
    });
}

$(function () {

    gNotice();

    menuHover();

    // newMenu();

    gTop();

});
