app.controller('clientsController', function ($scope, helperMethodsService) {
    $scope.helperMethodsService = helperMethodsService;

    $scope.formTree = function () {
        var data = [];

        $scope.links.forEach(function(link) {
            data.push({
                text: link.name,
                selectable: false,
                href: "https://" + window.location.host +
                "/clients/paper/" + link.shortName,
                state: ($scope.paper && $scope.paper.shortName && link.shortName == $scope.paper.shortName) ? {selected: true} : {}
            });
        });
        $('#clientsTree').treeview({
            enableLinks: true,
            expandIcon: 'glyphicon glyphicon-chevron-right',
            collapseIcon: 'glyphicon glyphicon-chevron-down',
            data: data
        });
    };

    $.ajax({
        type: "POST",
        url: window.location.href,
        dataType: 'json',
        data: "",
        success: (function (data) {
            console.log(data);
            $scope.$apply(function () {
                angular.forEach(data, function (value, key) {
                    $scope[key] = value;
                });
            });
            $scope.formTree();
        })
    });

});


