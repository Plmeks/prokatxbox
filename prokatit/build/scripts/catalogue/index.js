$(document).ready(function(){
});
var app = angular.module('app', ['angularUtils.directives.dirPagination']);

app.factory("cartService", function(){
    var smallCartScope;
    var bigCartScope;
    return {
        getSmallCartScope: function () {
            return smallCartScope;
        },
        getBigCartScope: function () {
            return bigCartScope;
        },
        setSmallCartScope: function (value) {
            smallCartScope = value;
        },
        setBigCartScope: function(value) {
            bigCartScope = value;
        },
        smallCartAdd: function (value) {
            smallCartScope.cartItems.push(value);
        },
        bigCartRemove: function() {

        },
        smallCartRemove: function(idProduct) {
            smallCartScope.delete(idProduct);
        }
    };
});

app.service("helperMethodsService", function($sce){
    this.formatPrice = function(price) {
        return price? price.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 "): "";
    };

    this.trustedHtml = function(value) {
        return value? $sce.trustAsHtml(value): "";
    };
});

function formatPrice(price) {
    return price.reverse().replace(/((?:\d{2})\d)/g, '$1 ').reverse();
}

$(document).ready(function(){
    var vkWidgetInit = function () {
        var mode = 0;

        $("#vk-groups").remove();
        $("#vk-groups-wrap").append("<div id='vk-groups'></div>");
        $("#vk-groups").html("");

        VK.Widgets.Group("vk-groups", {
            mode: mode, width: "auto", height: "300px",
            color1: 'white', color2: '333333', color3: 'F6A10A'
        }, 85009498);
    };

    vkWidgetInit();
    window.addEventListener("orientationchange", function() {
        vkWidgetInit();
    }, false);
});

﻿app.controller('NavbarController', function($scope, cartService) {
    $scope.cartItems = [];
    cartService.setSmallCartScope($scope);

    var initCart = function() {
        var cart = JSON.parse(localStorage.getItem("cart"));

        if(cart)
            angular.forEach(cart, function(value, key) {
                $scope.cartItems.push(value);
            });

    };

	$scope.formatPrice = function(price) {
		return price.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ");
	};

    $scope.delete = function(idProduct) {
        $scope.cartItems = $.grep($scope.cartItems, function(value) {
            return value.id !== idProduct;
        });

        localStorage.setItem("cart", JSON.stringify($scope.cartItems));

        var bigCart = cartService.getBigCartScope();
        if(bigCart){
            bigCart.cartItems = $scope.cartItems;
            bigCart.setSummary();
            //bigCart.revalidateOrders();
        }
    };

    $scope.exit = function() {
        $.ajax({
            type: "POST",
            url: "https://" + window.location.host + "/dashboard/logOut",
            success : (function(){
                window.location.reload();
            })
        });
    };

    initCart();
});

$(document).ready(function() {
	$(window).on('scroll', function(){
	    $('.navbar-collapse').collapse('hide');
	});
	$('.nav a').on('click', function(){
		$('.navbar-collapse').collapse('hide');
	    // $('.btn-navbar').click();
	    // $('.navbar-toggle').click();
	});
    $("#userMenu li.dropdown").hover(
        function() {
            $('.dropdown-menu', this).stop( true, true ).fadeIn(400);
            $(this).toggleClass('open');
            // $('b', this).toggleClass("caret caret-up");
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).fadeOut(1);
            $(this).toggleClass('open');
            //$('b', this).toggleClass("caret caret-up");
        }
    );

    $('#loginForm')
        .formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            live: "disabled",
            fields: {
                login: {
                    validators: {
                        notEmpty: {
                            message: 'Введите имя пользователя, либо Email'
                        },
                        remote: {
                            message: 'Такого пользователя не существует',
                            url: "https://" + window.location.host + "/login/isDataExists",
                            type: 'POST',
                            data: {
                                type: "login or email"
                            }
                        },
                        callback: {
                            callback: function (value, validator, $field) {
                                var password = validator.getFieldElements('to').val();

                                if(password)
                                $('#loginForm').formValidation('updateStatus', 'password', NOT_VALIDATED);
                                $('#loginForm').formValidation('revalidateField', 'password');

                                return true;
                            }
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Пароль не может быть пустым'
                        },
                        remote: {
                            message: 'Неверный пароль',
                            url: "https://" + window.location.host + "/login/isDataExists",
                            type: 'POST',
                            data: function(validator, $field, value) {
                                return {
                                    loginValid: validator.getFieldElements('login').val(),
                                    type: "password"
                                };
                            }
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();
            window.location.reload();
        });

    $('#registrationForm')
        .formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                login: {
                    trigger: 'blur',
                    validators: {
                        notEmpty: {
                            message: 'Введите имя пользователя'
                        },
                        stringLength: {
                            min: 4,
                            max: 30,
                            message: 'Имя пользователя должно быть минимум 4 символа'
                        },
                        remote: {
                            message: 'Такой пользователь уже зарегестрирован',
                            url: "https://" + window.location.host + "/registration/isDataDisable",
                            type: 'POST',
                            data: {
                                type: 'login'
                            }
                        },
                        regexp: {
                            regexp: /^[а-яА-Яa-zA-Z0-9_\.]+$/,
                            message: 'Имя пользователя может содержать только буквы и цифры'
                        }
                    }
                },
                email: {
                    trigger: 'blur',
                    validators: {
                        notEmpty: {
                            message: 'Введите e-mail'
                        },
                        emailAddress: {
                            message: 'Неверный формат e-mail адреса'
                        },
                        remote: {
                            message: 'Такой email уже зарегестрирован!' + "<a href='" + "http://" + window.location.host + "/login" +"'>Авторизоваться</a>",
                            url: "https://" + window.location.host + "/registration/isDataDisable",
                            type: 'POST',
                            data: {
                                type: 'email'
                            }
                        }
                    }
                },
                password: {
                    trigger: 'blur',
                    validators: {
                        notEmpty: {
                            message: 'Пароль не может быть пустым'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'Пароль должен содержать минимум 6 символов'
                        }
                    }
                },
                confirmPassword: {
                    trigger: 'blur',
                    validators: {
                        notEmpty: {
                            message: 'Подтверждаемый пароль не может быть пустым'
                        },
                        identical: {
                            field: 'password',
                            message: 'Пароли не совпадают'
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "https://" + window.location.host + "/registration/registerUser",
                data: $(this).serialize(),
                success : (function(response){
                    window.location.reload();
                }.bind(this))
            });
        });
});


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

