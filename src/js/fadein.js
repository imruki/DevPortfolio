$(document).ready(function () {

    /* fadein content at the top without verifying scroll */
    $('.fadein-from-start').each(function (i) {
        $(this).animate({ 'opacity': '1' }, 500);

    });
/* Check the location of each desired element */
$('.fadein').each(function (i) {

    var bottom_of_object = $(this).position().top + $(this).outerHeight();
    var bottom_of_window = $(window).scrollTop() + $(window).height();

    /* If the object is completely visible in the window, fade it it */
    if (bottom_of_window + 70 > bottom_of_object) {

        $(this).animate({ 'opacity': '1' }, 500);

    }

});
    /* Every time the window is scrolled ... */
    $(window).scroll(function () {


        /* Check the location of each desired element */
        $('.fadein').each(function (i) {

            var bottom_of_object = $(this).position().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();

            /* If the object is completely visible in the window, fade it it */
            if (bottom_of_window + 70 > bottom_of_object) {

                $(this).animate({ 'opacity': '1' }, 500);

            }

        });



    });

});