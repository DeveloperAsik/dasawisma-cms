<script>
    var fnSubmitLogin = function () {
        loadingImg('loading', 'play');
        var uri = _config_api_base_url + '/generate-token';
        var type = 'POST';
        var formdata = {
            username: $('input[name="username"]').val(),
            password: Base64.encode($('input[name="password"]').val()),
            device_id: _app_uuid
        };
        var response = fnAjaxSend(formdata, uri, type, '', false);
        if (response.responseJSON.status === 200) {
            fnToaStr(response.responseJSON.message, 'success', {timeOut: 2000});
            var res = fnAjaxSend({token: response.responseJSON.data.token}, _config_api_base_url + '/auth/save-token', 'POST', {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, false);
            if (res.status === 200) {
                setTimeout(function () {
                    loadingImg('loading', 'destroy');
                    window.location = _config_base_url + '/dashboard';
                }, 2000);
            } else {
                setTimeout(function () {
                    loadingImg('loading', 'destroy');
                    window.location = _config_base_url + '/logout';
                }, 2500);
            }
        }
        return false;
    };
    var Login = function () {

        var handleLogin = function () {
            $('.login-form').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                    remember: {
                        required: false
                    }
                },
                messages: {
                    username: {
                        required: "Username is required."
                    },
                    password: {
                        required: "Password is required."
                    }
                },
                invalidHandler: function (event, validator) { //display error alert on form submit   
                    $('.alert-danger', $('.login-form')).show();
                },
                highlight: function (element) { // hightlight error inputs
                    $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                },
                success: function (label) {
                    label.closest('.form-group').removeClass('has-error');
                    label.remove();
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.closest('.input-icon'));
                },
                submitHandler: function (form) {
                    fnSubmitLogin();
                }
            });
        };

        return {
            //main function to initiate the module
            init: function () {
                fnToaStr('login js successfully load', 'success', {timeOut: 2000});
                handleLogin();
            }

        };
    }();
    jQuery(document).ready(function () {
        Login.init();
    });
</script>
