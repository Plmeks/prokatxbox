app.controller('ProductController', function($scope, cartService, helperMethodsService) {
    $scope.helperMethodsService = helperMethodsService;

    $scope.isInCart = function (idProduct) {
        var parsedLocalCart = JSON.parse(localStorage.getItem("cart"));
        var cart = parsedLocalCart ? parsedLocalCart : [];

        for(var i = 0; i < cart.length; i++)
            if(cart[i].id == idProduct)
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
        type: "POST",
        url: window.location.href,
        dataType: 'json',
        success: (function (data) {
            $scope.$apply(function () {
                $scope.product = data[0];
            });
        })
    });
});