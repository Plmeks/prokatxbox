 $(document).ready(function() {
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
                    },
                    enabled: false
                }
            }
        })
        .on('success.validator.fv', function(e, data) {
            if (data.field === 'password' && data.validator === 'remote') {
                //console.log(data.result.userData);

            }
        })
        .on('success.field.fv', function(e, data) {
            if (data.field === 'login') {
                $('#loginForm').formValidation('enableFieldValidators', 'password', true);
                $('#loginForm').formValidation('revalidateField', 'password');
            }

            if(data.field === 'password') {
                window.location.href = "https://" + window.location.host + "/dashboard";
            }
        })
        .on('err.field.fv', function(e, data) {
            if (data.field === 'login') {
                $('#loginForm').formValidation('enableFieldValidators', 'password', false);
                $('#loginForm').formValidation('revalidateField', 'password');
            }
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();
            //window.location.href = "http://" + window.location.host + "/dashboard";
        });

});