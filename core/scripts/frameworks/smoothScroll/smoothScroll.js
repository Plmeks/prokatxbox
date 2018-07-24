/**
 * Created with JetBrains PhpStorm.
 * User: Максим
 * Date: 02.02.16
 * Time: 15:36
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function() {
    $(function() {
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
});