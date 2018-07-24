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