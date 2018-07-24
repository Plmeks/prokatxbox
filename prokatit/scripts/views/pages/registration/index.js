$(document).ready(function() {
    $('#registerForm')
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
                            message: 'Такой email уже зарегестрирован!' + "<a href='" + "https://" + window.location.host + "/login" +"'>Авторизоваться</a>",
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
                    window.location.href = "https://" + window.location.host + "/dashboard";
                }.bind(this))
            });
        });
});