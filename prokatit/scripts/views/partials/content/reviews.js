app.controller('ReviewsController', function($scope) {
	﻿// $(document).ready(function(){
﻿		var serverUrl =  "https://" + window.location.host + "/home/";
	﻿	
	    $.ajax({
	        type: "GET",
	        url: serverUrl + "reviews",
	        dataType: 'json',
	        success: (function (data) {
	            $scope.$apply(function () {
	                $scope.reviews = data;
	            });
	            initOwlCarousel();
	        })
	    });
	    
	    function initOwlCarousel() {
	    	$("#prokatit-reviews .owl-carousel").owlCarousel({
		        loop: true,
		        items: 1,
		        autoplay: true,
		        autoplaySpeed: 2000,
		        autoplayTimeout: 12000,
		        smartSpeed: 1000,
		    });
		
		    var owl = $("#prokatit-reviews .owl-carousel").data('owlCarousel');
		    $('.right').bind('click', function(){
		        owl.next();
		    });
		
		    $('.left').bind('click', function(){
		        owl.prev();
		    });
	    }
	});
