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


$(document).ready(function() {

});

app.controller('CartController', function($scope, cartService, helperMethodsService) {
    $scope.cartItems = [];
    $scope.deliveryNeeded = false;
    $scope.deliveryPrice = 5;
    $scope.rentedCalendarIds = [];
    $scope.formatPrice = helperMethodsService.formatPrice;



    cartService.setBigCartScope($scope);

    $scope.initCart = function() {
        var cart = JSON.parse(localStorage.getItem("cart"));

        if(cart)
            angular.forEach(cart, function(value, key) {
                $scope.cartItems.push(value);
            });
    };

    $scope.getProductsPrice = function() {
        var price = 0;
        angular.forEach($scope.cartItems, function(value) {
            price += parseInt(value.price);
        });

        return price;
    };

    $scope.calculateDate = function(val) {
        console.log(val);
    };

    $scope.getTotalPrice = function() {
        var totalPrice = $scope.getProductsPrice();
        var salesPrice = 0;
        var days = 1;

        var fromDate = $('#fromDate').data("date");
        var toDate = $('#toDate').data("date");
        var diff = moment(toDate, 'DD.MM.YYYY').diff(moment(fromDate, 'DD.MM.YYYY'), 'days');
        if(!isNaN(diff))
            days = diff;
        else
            days = 1;

        //totalPrice += $scope.getProductsPrice();

        //if(days > 1) {
        //    var startPrice = totalPrice;
        //    var sale = 0.66;
        //    var add = startPrice * sale;
        //
        //    for(var i = 0; i < days; i++) {
        //        var day = i + 1;
        //        totalPrice += add;
        //        if(day == 7) {
        //            totalPrice *= 0.7;
        //        }
        //
        //        if(day == 30) {
        //            totalPrice *= 0.7;
        //        }
        //    }
        //}


        if(days) {
            var sale = 0;
            for(var i = 0; i < days; i++) {
                switch(i + 1) {
                    case 2:
                        sale = 0.35;
                        break;
                    case 5:
                        sale = 0.6;
                        break;
                }
                salesPrice += totalPrice * sale;
            }
            totalPrice *= days;
        }

        if(salesPrice)
            totalPrice -= salesPrice;

        if($scope.deliveryNeeded)
            totalPrice += $scope.deliveryPrice;


        return Math.round(totalPrice);
    };

    $scope.setSummary = function() {
        $("#summary").html($scope.getSummary() + " руб.");
    };

    $scope.getSummary = function() {
        return $scope.formatPrice($scope.getTotalPrice());
    };

    //$scope.summary = $scope.formatPrice($scope.getTotalPrice());

    $scope.makeDelivery = function(deliveryOption) {
        switch(deliveryOption) {
            case "courier":
                $scope.deliveryNeeded = true;
                break;
            default:
                $scope.deliveryNeeded = false;
        }
        $scope.setSummary();
    };

    $scope.delete = function(idProduct) {
        $scope.cartItems = $.grep($scope.cartItems, function(value) {
            return value.id !== idProduct;
        });

        localStorage.setItem("cart", JSON.stringify($scope.cartItems));

        var smallCart = cartService.getSmallCartScope();
        if(smallCart){
            smallCart.cartItems = $scope.cartItems;
        }

        $scope.setSummary();

    };


    angular.element(document).ready(function () {
        $scope.setSummary();
        $('#fromDate').datetimepicker({
            locale: 'ru',
            minDate: moment().startOf('d'),
            showClose: true,
            allowInputToggle: true,
            icons: {
                close: 'text-success glyphicon glyphicon-ok'
            },
            tooltips: {
                close: 'Готово',
                selectTime: 'Выберите время'

            }
        }).on('dp.change', function(e) {
            var fromDate = e.date;
            var toDate = $('#toDate').data("date");
            var toDatePicker = $('#toDate').data("DateTimePicker");

            if(fromDate)
                toDatePicker.minDate(moment(fromDate).add(24, 'hours'));

            if((fromDate && toDate) && moment(fromDate, 'DD.MM.YYYY') >= moment(toDate, 'DD.MM.YYYY'))
                toDatePicker.date(moment(fromDate).add(24, 'hours'));

            $('#orderForm').formValidation('revalidateField', 'from');
            $scope.setSummary();
        });


        $('#toDate').datetimepicker({
            locale: 'ru',
            useCurrent: false,
            showClose: true,
            allowInputToggle: true,
            icons: {
                close: 'text-success glyphicon glyphicon-ok'
            },
            tooltips: {
                close: 'Готово',
                selectTime: 'Выберите время'

            }
        }).on('dp.change', function(e) {
            $('#orderForm').formValidation('revalidateField', 'to');
            $scope.setSummary();
        });

        var test = function() {
            $scope.getTotalPrice();
        };

        $('#orderForm')
            .formValidation({
                fields: {
                    phone: {
                        trigger: 'blur',
                        validators: {
                            notEmpty: {
                                message: 'Введите телефон'
                            },
                            regexp: {
                                regexp: /\(\d\d\) \d\d\d-\d\d-\d\d/,
                                message: 'Пример правильного телефона: +375(25) 927-51-26'
                            }
                        }
                    },
                    from: {
                        validators: {
                            notEmpty: {
                                message: 'Выберите начало аренды'
                            },
                            date: {
                                format: 'DD.MM.YYYY h:m',
                                message: 'Правильный пример даты: ' + moment().format("DD.MM.YYYY hh:mm")
                            }
                        }
                    },
                    to: {
                        validators: {
                            notEmpty: {
                                message: 'Выберите окончание аренды'
                            },
                            date: {
                                format: 'DD.MM.YYYY h:m',
                                message: 'Правильный пример даты: ' + moment().format("DD.MM.YYYY hh:mm")
                            }
                        }
                    },
                    delivery: {
                        validators: {
                            notEmpty: {
                                message: 'Выберите способ доставки'
                            }
                        }
                    },
                    address: {
                        validators: {
                            notEmpty: {
                                message: 'Введите адрес'
                            }
                        }
                    },
                    fio: {
                        validators: {
                            notEmpty: {
                                message: 'Введите ФИО'
                            },
                            regexp: {
                                regexp: /^[а-яА-Яa-zA-Z\s]+$/,
                                message: 'ФИО может содержать только буквы'
                            }
                        }
                    }
                }
            })
            .on('success.form.fv', function(e) {
                e.preventDefault();

                var fromDate = $('#fromDate').data("date");
                var toDate = $('#toDate').data("date");
                var countDays = moment(toDate, 'DD.MM.YYYY').diff(moment(fromDate, 'DD.MM.YYYY'), 'days');

                var productIds = [];
                angular.forEach($scope.cartItems, function(value) {
                    productIds.push(value.id);
                });

                $.ajax({
                    type: "POST",
                    url: "https://" + window.location.host + "/cart/makeOrder",
                    data: $(this).serialize() + "&price=" + $scope.getTotalPrice() + "&productIds=" + productIds + "&countDays=" + countDays,
                    dataType: "json",
                    success : (function(response){
                        localStorage.clear();
                        confirm("Успешно оформлено!");
                        window.location.href = "https://" + window.location.host + "/cart/success";
                    }.bind(this))
                });
            })
            .find('[name="phone"]').mask("+375 (00) 000-00-00");
    });
});

