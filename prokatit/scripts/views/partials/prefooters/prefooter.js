$(document).ready(function(){
    var vkWidgetInit = function () {
        var mode = 0;

        if ($(window).width() < 768)
            mode = 1;

        $("#vk-groups").remove();
        $("#vk-groups-wrap").append("<div id='vk-groups'></div>");
        $("#vk-groups").html("");

        VK.Widgets.Group("vk-groups", {
            mode: mode, width: "auto", height: "auto",
            color1: 'white', color2: '333333', color3: 'F6A10A'
        }, 85009498);
    };

    $(window).bind("resize", function(){
        vkWidgetInit();
    });

    $(window).bind("load", function(){
        vkWidgetInit();
    });

});