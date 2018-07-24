adminApp.controller('adminController', function($scope) {
    $scope.title = "Администрирование";
    $scope.main = true;
});

$(document).ready(function() {
    $("#grid").append("");
});