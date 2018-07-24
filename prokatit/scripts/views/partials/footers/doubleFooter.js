$(document).ready(function() {
    var vkWidgetInit = function () {
        var mode = 0;

        //if ($(window).width() < 768)
        //    mode = 1;

        $("#vk-groups").remove();
        $("#vk-groups-wrap").append("<div id='vk-groups'></div>");
        $("#vk-groups").html("");

        VK.Widgets.Group("vk-groups", {
            mode: mode, width: "auto", height: "300px",
            color1: 'white', color2: '333333', color3: 'F6A10A'
        }, 85009498);


    };
    
    //vkWidgetInit();

    var setBodyMargin = function() {
        $('body').css('margin-bottom', $('#prefooter').height());
    };

	
	setTimeout(function() {
		//vkWidgetInit();
		$("body").css("margin-bottom", $('#doubleFooter').height());
	}, 100);
	
	setTimeout(function() {
		//vkWidgetInit();
		vkWidgetInit();
		$("body").css("margin-bottom", $('#doubleFooter').height());
	}, 500);

    $(window).on("resize", function(){
        //setBodyMargin();
        //vkWidgetInit();
    });


    $(window).on("load", function(){
    	// vkWidgetInit();
     //   $("body").css("margin-bottom", $('#doubleFooter').height());
        //$("body").css('margin-bottom', $('#prefooter').height());
        //setBodyMargin();
        
        
    });
});
