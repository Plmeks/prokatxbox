app.controller('PopularProductsController', function($scope, cartService) {
    var serverUrl =  "https://" + window.location.host + "/home/";

    $scope.chunk = function(value, size) {
        var chunked = [];
        for (var i = 0; i < value.length; i += size) {
            chunked.push(value.slice(i, i + size));
        }
        return chunked;
    };

    $scope.isInCart = function (product) {
        var parsedLocalCart = JSON.parse(localStorage.getItem("cart"));
        var cart = parsedLocalCart ? parsedLocalCart : [];
        for(var i = 0; i < cart.length; i++)
            if(cart[i].id == product.id)
                return true;

        return false;
    };

    $scope.addToCart = function (product) {
        var parsedLocalCart = JSON.parse(localStorage.getItem("cart"));
        var cart = parsedLocalCart ? parsedLocalCart : [];

        var isInCart = false;

        $.each(cart, function(key, value) {
            if(value.id == product.id) {
                isInCart = true;
            }
        });

        if(!isInCart) {
            cart.push(product);
            cartService.smallCartAdd(product);
            localStorage.setItem("cart", JSON.stringify(cart));
        }
    };

    $.ajax({
        type: "GET",
        url: serverUrl + "popularProducts",
        dataType: 'json',
        data: "",
        success: (function (data) {
            $scope.$apply(function () {
                angular.forEach(data, function (value, key) {
                    $scope[key] = value;
                });
                
                
				$scope.popularProducts.sort(function(a, b) {
					if(parseInt(a.popular) < parseInt(b.popular))
						return 1;
						
					if(parseInt(a.popular) > parseInt(b.popular))
						return -1;
						
					return 0;
				});
				
                $scope.chunkedProductsLargeScreen = $scope.chunk($scope.popularProducts, 4);
                $scope.chunkedProductsSmallScreen = $scope.chunk($scope.popularProducts, 3);
            });
        })
    });
    
    $.ajax({
        type: "GET",
        url: serverUrl + "competition",
        dataType: 'json',
        data: "",
        success: (function (data) {
            $scope.$apply(function () {
                angular.forEach(data, function (value, key) {
                    $scope[key] = value;
                });
            });
        })
    });
});