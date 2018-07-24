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
