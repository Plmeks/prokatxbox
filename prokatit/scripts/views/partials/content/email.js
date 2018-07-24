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