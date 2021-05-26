"use strict";

// Class Definition
var KTLoginGeneral = function() {

    var login = $('#kt_login');

    var showErrorMsg = function(form, type, msg) {
        var alert = $('<div class="alert alert-' + type + ' alert-dismissible" role="alert">\
			<div class="alert-text">'+msg+'</div>\
			<div class="alert-close">\
                <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>\
            </div>\
		</div>');

        form.find('.alert').remove();
        alert.prependTo(form);
        //alert.animateClass('fadeIn animated');
        KTUtil.animateClass(alert[0], 'fadeIn animated');
        alert.find('span').html(msg);
    }

    // Private Functions
    var displaySignInForm = function() {
        login.removeClass('kt-login--reset');
        login.removeClass('kt-login--forgot');

        login.addClass('kt-login--signin');
        KTUtil.animateClass(login.find('.kt-login__signin')[0], 'flipInX animated');
        //login.find('.kt-login__signin').animateClass('flipInX animated');
    }

    var displayForgotForm = function() {
        login.removeClass('kt-login--signin');

        login.addClass('kt-login--forgot');
        //login.find('.kt-login--forgot').animateClass('flipInX animated');
        KTUtil.animateClass(login.find('.kt-login__forgot')[0], 'flipInX animated');

    }

    var displayResetForm = function() {
        login.removeClass('kt-login--forgot');

        login.addClass('kt-login--reset');
        KTUtil.animateClass(login.find('.kt-login__reset')[0], 'flipInX animated');
        //login.find('.kt-login__signin').animateClass('flipInX animated');
    }


    var handleFormSwitch = function() {
        $('#kt_login_forgot').click(function(e) {
            e.preventDefault();
            displayForgotForm();
        });

        $('#kt_login_forgot_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });
    }

    var handleSignInFormSubmit = function() {
        $('#kt_login_signin_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

            form.ajaxSubmit({
                url: form.attr('action'),
                dataType: "json",
                success: function(response, status, xhr, $form) {
	                btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
	                showErrorMsg(form, 'success', jsoor.translate('Loading...'));
                  setTimeout(function() {
                    window.location.href = response.data.to
                  }.bind(this), 1000)
                },
                error: function(response, status, xhr, $form) {
	                btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
	                showErrorMsg(form, 'danger', response.responseJSON.errors.details[0]);
                }
            });
        });
    }

    var handleForgotFormSubmit = function() {
        $('#kt_login_forgot_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

            form.ajaxSubmit({
                url: form.attr('action'),
                dataType: "json",
                success: function(response, status, xhr, $form) {
              		btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false); // remove
	                form.clearForm(); // clear form
	                form.validate().resetForm(); // reset validation states

	                // display signin form
	                displaySignInForm();
	                var signInForm = login.find('.kt-login__signin form');
	                signInForm.clearForm();
	                signInForm.validate().resetForm();

	                showErrorMsg(signInForm, 'success', jsoor.translate('Cool! Password recovery instruction has been sent to your email.'));
                },
                error: function(response, status, xhr, $form) {
	                btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
	                showErrorMsg(form, 'danger', response.responseJSON.errors.details[0]);
                }
            });
        });
    }

    var handleResetFormSubmit = function() {
        $('#kt_login_reset_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    password: {
                        required: true,
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

            form.ajaxSubmit({
                url: form.attr('action'),
                dataType: "json",
                success: function(response, status, xhr, $form) {
                  console.log('123123')
              		btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false); // remove
	                form.clearForm(); // clear form
	                form.validate().resetForm(); // reset validation states

	                // display signin form
	                displaySignInForm();
	                var signInForm = login.find('.kt-login__signin form');
	                signInForm.clearForm();
	                signInForm.validate().resetForm();

	                showErrorMsg(signInForm, 'success', jsoor.translate('Now Use Your New Password.'));
                },
                error: function(response, status, xhr, $form) {
	                btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
	                showErrorMsg(form, 'danger', response.responseJSON.errors.details[0]);
                }
            });
        });
    }


    // Public Functions
    return {
        // public functions
        init: function() {
            handleFormSwitch();
            handleSignInFormSubmit();
            handleForgotFormSubmit();
            handleResetFormSubmit();
            var url = window.location.href;
            var host = window.location.host;
            if(url.indexOf('reset') != -1) {
              displayResetForm()
            }
        },
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLoginGeneral.init();
});
