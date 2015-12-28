$(function () {
    $.validator.addMethod("regx", function (value, element, regexpr) {
        var re = new RegExp(regexpr, "i");
        return re.test(value);
    });
});
jQuery.extend(jQuery.validator.messages, {
    digits: "Solo i numeri sono ammessi",
    email: "Email non valida",
    equalTo: "Le password non coincidono",
    required: "Questo campo è obbligatorio",
    regx: "Formato del campo non valido"
});
var Login = function () {

    var handleLogin = function () {
        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            rules: {
                email: {
                    required: true,
                    regx: "^[a-zA-Z0-9+&*-]+(?:\.[a-zA-Z0-9_+&*-]+)*@(?:[a-zA-Z0-9-]+\.)+[a-zA-Z]{2,7}$",
                    minlength: 5,
                    maxlength: 50
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 32
                },
                remember: {
                    required: false
                }
            },

            messages: {
                email: {
                    regx: "L'email inserita non è corretta",
                    required: "E-mail è obbligatorio"
                },
                password: {
                    required: "Formato password errato. La password deve contenere minimo 8 caratteri."
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                //$('.alert-danger', $('.login-form')).show();
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function (form) {
                //form.submit();
            }
        });

        $('.login-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit();
                }
                return false;
            }
        });

        $('.login-form').submit(function (event) {
            if ($('.login-form').validate().form()) {
                //$('.login-form').hide(100);
                //$('#preloader').show(500);
                var request = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "/auth/login",
                    data: request,
                    success: function (r) {
                        if (r.status) {
                            window.location.replace(r.redirect);
                        } else {
                            $('.alert-danger', $('.login-form')).show();
                            $('#alert_message').text(r.error);
                        }
                    },
                    dataType: "json"
                });
            }
            event.preventDefault();
            return false;
        });
    }

    var handleForgetPassword = function () {
        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },

            messages: {
                email: {
                    required: "Email è obbligatorio."
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit

            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function (form) {
                form.submit();
            }
        });

        $('.forget-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });

        jQuery('#forget-password').click(function () {
            jQuery('.login-form').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#back-btn').click(function () {
            jQuery('.login-form').show();
            jQuery('.forget-form').hide();
        });

    }

    var handleRegister = function () {

        function format(state) {
            return state.text;
            //if (!state.id) return state.text; // optgroup
            //return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
        }


        $("#select2_sample4").select2({
            placeholder: '<i class="fa fa-building-o"></i>&nbsp;Seleziona il corso di laurea',
            allowClear: true,
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function (m) {
                return m;
            }
        });


        $('#select2_sample4').change(function () {
            $('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });


        $('.register-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                    maxlength: 30,
                    regx: "^[a-z_ èàòù]+$"
                },
                surname: {
                    required: true,
                    minlength: 2,
                    maxlength: 30,
                    regx: "^[a-z_ èàòù]+$"
                },
                matricola: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                email: {
                    required: true,
                    email: true,
                    minlength: 5,
                    maxlength: 50
                },
                address: {
                    required: true
                },
                city: {
                    required: true
                },
                country: {
                    required: true
                },

                username: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 32
                },
                rpassword: {
                    required: true,
                    equalTo: "#register_password",
                    minlength: 8,
                    maxlength: 32
                },

                cdl_matricola: {
                    required: true
                },

                tnc: {
                    required: true
                }
            },

            messages: { // custom messages for radio buttons and checkboxes
                tnc: {
                    required: "Accetta trattamento dei dati personali"
                },
                rpassword: {
                    required: "Password non coincidono"
                },
                matricola: {
                    minlength: "Lunghezza matricola non valida",
                    maxlength: "Lunghezza matricola non valida"
                },
                password: {
                    minlength: "Lunghezza password non valida",
                    maxlength: "Lunghezza password non valida"
                },
                rpassword: {
                    minlength: "Lunghezza password non valida",
                    maxlength: "Lunghezza password non valida"
                },

                cdl_matricola: "Selezionare un CdL"
            },

            invalidHandler: function (event, validator) { //display error alert on form submit

            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                if (element.attr("name") == "tnc") { // insert checkbox errors after the container
                    error.insertAfter($('#register_tnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function (form) {
                //form.submit();
            }
        });

        $('.register-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.register-form').validate().form()) {
                    $('.register-form').submit();
                }
                return false;
            }
        });

        $('.register-form').submit(function (e) {
            var request = $(this).serialize();
            if ($('.register-form').validate().form()) {
                $.ajax({
                    type: "POST",
                    url: "/auth/register",
                    data: request,
                    success: function (r) {
                        if (r.status) {
                            window.location.replace(r.redirect);
                        } else {
                            $('.alert-danger', $('.register-form')).show();
                            $('#alert_message', $('.register-form')).text(r.error);
                        }
                    },
                    dataType: "json"
                });
            }
            return false;
        });

        jQuery('#register-btn').click(function () {
            jQuery('.login-form').hide();
            jQuery('.register-form').show();
        });

        jQuery('#register-back-btn').click(function () {
            jQuery('.login-form').show();
            jQuery('.register-form').hide();
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleLogin();
            //handleForgetPassword();
            handleRegister();
        }

    };

}();