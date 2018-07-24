app.controller('CatalogueShowController', function($scope, $sce, cartService) {
    $scope.currentPage = 1;
    $scope.pageSize = "10";
    $scope.query = "";
    $scope.sort = "-popular";
    
    $scope.scrollTop = function() {
    	window.scrollTo(0, 0);
    };
    
    $scope.setQuery = function(query) {
    	$scope.query = query;
    };
    

    $scope.search = function (row) {
        var query = "";
        if($scope.query) {
        	query = $scope.query.toLowerCase();
        }
            

        return !!(((row.name.toLowerCase()).indexOf(query || '') !== -1 ||
        (row.shortDescription.toLowerCase()).indexOf(query || '') !== -1) ||
        (row.description.toLowerCase()).indexOf(query || '') !== -1);
    };

    $scope.formatPrice = function(price) {
        return price.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ");
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
    
    $scope.formCatalogueTree = function() {
        var catalogueData = [];
        angular.forEach($scope.catalogueTree, function(item) {
            var nodes = [];
            angular.forEach(item.subcategory, function(subItem) {
                nodes.push({
                    text: subItem.name,
                    selectable: false,
                    state: ($scope.currentBranch.shortName == subItem.shortName && $scope.currentBranch.id == subItem.id)? {selected: true}: {},
                    href: "https://" + window.location.host +
                    "/catalogue/category/" + item.category.shortName + "/subcategory/" + subItem.shortName
                });
            });
            nodes = nodes.length? nodes: null;
            catalogueData.push({
                text: item.category.name,
                selectable: false,
                state: ($scope.currentBranch.shortName == item.category.shortName && $scope.currentBranch.id == item.category.id)? {selected: true}: 
                	(($scope.currentBranch.categoryShortName && $scope.currentBranch.categoryShortName == item.category.shortName)? {expanded: true}: {expanded: false}),
                href: "https://" + window.location.host +
                "/catalogue/category/" + item.category.shortName,
                nodes: nodes
            });
        });

        $('#catalogueTree').treeview({
            enableLinks: true,
//            selectedBackColor: "#e44739",
            //highlightSelected: false,
            expandIcon: 'glyphicon glyphicon-chevron-right',
            collapseIcon: 'glyphicon glyphicon-chevron-down',
            data: catalogueData
        });
    };

    $.ajax({
        type: "POST",
        url: window.location.href,
        dataType: 'json',
        data: "",
        success: (function (data) {
        	// var sitemap = ``;
        	// data.products.forEach(function(value) {
        	// 	sitemap += `<url>
        	// 		<loc>http://prokatxbox.by/product/name/${value.shortName}</loc>
        	// 	</url>
        	// 	`;
        	// });
        	// console.log(sitemap);
            $scope.$apply(function () {
                angular.forEach(data, function (value, key) {
                    $scope[key] = value;
                });
            });
            angular.forEach($scope.products, function(value) {
                value.price = parseInt(value.price);
                if(!value.popular) {
                	value.popular = 0;
                }
                value.popular = parseInt(value.popular);
            });
            $scope.formCatalogueTree();
            $('.emptyBox').removeClass('hidden');
        })
    });

});
