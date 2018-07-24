/*
app.controller('ServicesController', function($scope) {
    var serverUrl =  "http://" + window.location.host + "/home/popularProducts";

    $scope.chunk = function(value, size) {
        var chunked = [];
        for (var i = 0; i < value.length; i += size) {
            chunked.push(value.slice(i, i + size));
        }
        return chunked;
    };

    $.ajax({
        type: "GET",
        url: serverUrl,
        dataType: 'json',
        data: "",
        success: (function (data) {
            console.log(data);
            $scope.$apply(function () {
                angular.forEach(data, function (value, key) {
                    $scope[key] = value;
                });

                $scope.chunkedProducts = $scope.chunk($scope.popularProducts, 3);
            });
        })
    });
});*/
