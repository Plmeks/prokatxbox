$(document).ready(function(){
    var loadVkWidget = function () {
        var mode = 0;

        if ($(window).width() < 768)
            mode = 1;

        VK.Widgets.Group("vk_groups", {
            mode: mode, width: "auto", height: "auto",
            color1: 'f2f3f4', color2: '333333', color3: 'e44739'
        }, 85009498);
    };

    $(window).bind("resize", function(){
        $("#vk_groups").remove();
        $("#vk-groups-parent").append("<div id='vk_groups'></div>");
        loadVkWidget();
    });

    loadVkWidget();
});
