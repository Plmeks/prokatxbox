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
$(document).ready(function () {
    $('#fastOrderForm').formValidation({
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
            product: {
                trigger: 'blur',
                validators: {
                    notEmpty: {
                        message: 'Выберите товар аренды'
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
            }
        }
    }).on('success.form.fv', function (e) {
            e.preventDefault();
            var fromDate = $('#fromDate').data("date");
            var toDate = $('#toDate').data("date");
            var countDays = moment(toDate, 'DD.MM.YYYY').diff(moment(fromDate, 'DD.MM.YYYY'), 'days');

            $.ajax({
                type: "POST",
                url: "https://" + window.location.host + "/home/makeOrder",
                data: $(this).serialize() + "&countDays=" + countDays,
                dataType: "json",
                success: (function (response) {
                    confirm("Успешно оформлено!");
                    window.location.href = "https://" + window.location.host + "/cart/success";
                }.bind(this))
            });


        })
        .find('[name="phone"]').mask("+375 (00) 000-00-00");

    $("#console").change(function () {
        if (this.value == "catalogue") {
            this.value = "";
            window.location.href = "https://" + window.location.host + "/catalogue";
        }
    });

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
    }).on('dp.change', function (e) {
            var fromDate = e.date;
            var toDate = $('#toDate').data("date");
            var toDatePicker = $('#toDate').data("DateTimePicker");

            if (fromDate)
                toDatePicker.minDate(moment(fromDate).add(24, 'hours'));

            if ((fromDate && toDate) && moment(fromDate, 'DD.MM.YYYY') >= moment(toDate, 'DD.MM.YYYY'))
                toDatePicker.date(moment(fromDate).add(24, 'hours'));

            $('#fastOrderForm').formValidation('revalidateField', 'from');
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
    }).on('dp.change', function (e) {
            $('#fastOrderForm').formValidation('revalidateField', 'to');
        });
});
﻿$(document).ready(function(){
    $("#prokatit-landing .owl-carousel").owlCarousel({
        loop: true,
        items: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        autoplayTimeout: 7000,
        smartSpeed: 1000,
//        animateOut: 'fadeOut',
//        touchDrag: false,
//        mouseDrag: false,
        nav: false,
        dots: false
    });
});

$(document).ready(function(){
});
$(document).ready(function(){
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

