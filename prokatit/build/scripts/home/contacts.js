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


$(document).ready(function(){
});
$(document).ready(function(){
    $('#emailForm').formValidation({
        fields: {
            name: {
                trigger: 'blur',
                validators: {
                    notEmpty: {
                        message: 'Введите имя'
                    },
                    regexp: {
                        regexp: /^[а-яА-Яa-zA-Z\s]+$/,
                        message: 'Имя может содержать только буквы'
                    }
                }
            },
            email: {
                trigger: 'blur',
                validators: {
                    notEmpty: {
                        message: 'Введите ваш e-mail адрес'
                    },
                    emailAddress: {
                        message: 'Введите корректный e-mail'
                    }
                }
            },
            message: {
                trigger: 'blur',
                validators: {
                    notEmpty: {
                        message: 'Сообщение не может быть пустым'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "https://" + window.location.host + "/home/sendEmail",
            data: $(this).serialize(),
            dataType: "json",
            success : (function(response){
                confirm("Ваше сообщение успешно отправлено!");
                $(this).formValidation('resetForm', true);
            }.bind(this))
        });
    });
});
$(document).ready(function(){

    var firstCity = $('#content-cities button')[0];
    var currentCoords = {
        lat: parseFloat($(firstCity).attr('lat')),
        lng: parseFloat($(firstCity).attr('lng'))
    };

    $(firstCity).addClass('selected');

    var standartZoom = 17;
    var noAddressZoom = 12;

    var cityMap = new GMaps({
        div: '#city-map',
        zoom: standartZoom,
        click: function(e) {
            cityMap.setOptions({scrollwheel: true});
            cityMap.hideInfoWindows();
        },
        drag: function(e) {
            cityMap.setOptions({scrollwheel: true});
            cityMap.hideInfoWindows();
        },
        mouseout: function(e) {
            cityMap.setOptions({scrollwheel: false});
            cityMap.hideInfoWindows();
        },
        scrollwheel: false,
        lat: currentCoords.lat,
        lng: currentCoords.lng
    });

    cityMap.addMarker({
        lat: currentCoords.lat,
        lng: currentCoords.lng,
        title: 'Prokatit ' + $(firstCity).text().trim(),
        infoWindow: {
            content: '<p class="marker">Выгодный прокат приставок, снаряжения для туризма и велосипедов в городе ' +
                $(firstCity).text().trim() + ', Республика Белурсь.</p>'
        }
    });

    $( window ).resize(function() {
        cityMap.setCenter({
            lat: currentCoords.lat,
            lng: currentCoords.lng
        });
    });



    $('#content-cities button').click(function(e){
        var button = e.target;
        $('#content-cities .item').each(function(index, element) {
            $(element).removeClass('show');
        });
        $("#" + button.name).addClass('show');

        $('#content-cities button').each(function(index, element) {
            $(element).removeClass('selected');
        });
        $(button).addClass('selected');

        currentCoords = {
            lat: parseFloat($(button).attr('lat')),
            lng: parseFloat($(button).attr('lng'))
        };


        if(currentCoords) {
            cityMap.addMarker({
                lat: currentCoords.lat,
                lng: currentCoords.lng,
                title: 'Prokatit ' + $(button).text().trim(),
                infoWindow: {
                    content: '<p class="marker">Выгодный прокат приставок, снаряжения для туризма и велосипедов в городе ' +
                        $(button).text().trim() + ', Республика Белурсь.</p>'
                }
            });

            if($(button).attr('no-address')) {
                cityMap.setZoom(noAddressZoom);
            } else {
                cityMap.setZoom(standartZoom);
            }

            cityMap.setCenter({
                lat: currentCoords.lat,
                lng: currentCoords.lng
            });
        }
    });

});
