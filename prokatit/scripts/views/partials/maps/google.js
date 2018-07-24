$(document).ready(function(){
    $(window).bind("resize", function(){
        $("#googleMap").height($('body').outerHeight() / 1.2);
    });



    var scrollMapBehaviour = function() {
        $('#googleMap').addClass('scrolloff'); // set the pointer events to none on doc ready

        $('#mapSection').on('click', function () {
            $('#googleMap').removeClass('scrolloff'); // set the pointer events true on click
        });

        $("#googleMap").mouseleave(function () {
            $('#googleMap').addClass('scrolloff'); // set the pointer events to none when mouse leaves the map area
        });
    };

    var initMap = function() {
        $("#googleMap").height($('body').outerHeight() / 1.2);
        scrollMapBehaviour();
    };

    initMap();
});