$().ready(function() {
	// validate signup form on keyup and submit
	$("#register-form").validate({
		focusInvalid: false,
		focusCleanup: true,
		rules: {
			name: {
				required: true,
				minlength: 3,
				maxlength: 100
			},
			user_name: {
				required: true,
				minlength: 3,
				maxlength: 100
			},
			email: {
				required: true,
				maxlength: 40,
				email: true
			},
			password: {
				required: true,
				rangelength: [6, 16]
			},
			confirm_password: {
				required: true,
				equalTo: "#password"
			}
		},
		messages: {
			name: {
				required: "O campo nome é obrigatório",
				minlength: "Mínimo de caracteres para o nome é 3",
				maxlength: "Máximo de caracteres para o nome é 100"
			},
			user_name: {
				required: "O campo nome de usuário é obrigatório",
				minlength: "Mínimo de caracteres para o nome de usuário é 3",
				maxlength: "Máximo de caracteres para o nome de usuário é 100"
			},
			email: {
				required: "O campo email é obrigatório",
				maxlength: "Máximo de caracteres para o e-mail é 40",
				email: "Digite um e-mail válido"
			},
			password: {
				required: "O campo senha é obrigatório",
				rangelength: "O campo senha deve possuir entre 6 e 16 caracteres"
			},
			confirm_password: {
				required: "O campo confirmar senha é obrigatório",
				equalTo: "Senhas devem ser iguais"
			}
		},
    	errorPlacement: function(error, element) {
			showErrorMessage(element,error);
    	},
    	success: function(label, element) {
    		removeErrorMessage(element);
    	}
	});

	$("#login-form").validate({
		focusInvalid: false,
		focusCleanup: true,
		rules: {
			email_username: {
				required: true
			},
			password_login: {
				required: true
			}
		},
		messages: {
			email_username: {
				required: "O campo e-mail/usuário é obrigatório"
			},
			password_login: {
				required: "O campo senha é obrigatório"
			}
		},
    	errorPlacement: function(error, element) {
			showErrorMessage(element,error);
    	},
    	success: function(label, element) {
    		removeErrorMessage(element);
    	}
	});

	$("#form_password_reset_request").validate({
		focusInvalid: false,
		focusCleanup: true,
		rules: {
			email_reset: {
				required: true,
				email: true
			}
		},
		messages: {
			email_reset: {
				required: "O campo e-mail é obrigatório",
				email: "Digite um e-mail válido"
			}
		},
    	errorPlacement: function(error, element) {
			showErrorMessage(element,error);
    	},
    	success: function(label, element) {
    		removeErrorMessage(element);
    	}
	});

	$("#form_password_reset").validate({
		focusInvalid: false,
		focusCleanup: true,
		rules: {
			password_reset: {
				required: true,
				rangelength: [6, 16]
			},
			password_reset_confirm: {
				required: true,
				equalTo: "#password_reset"
			}
		},
		messages: {
			password_reset: {
				required: "O campo senha é obrigatório",
				rangelength: "O campo senha deve possuir entre 6 e 16 caracteres"
			},
			password_reset_confirm: {
				required: "O campo confirmar senha é obrigatório",
				equalTo: "Senhas devem ser iguais"
			}
		},
    	errorPlacement: function(error, element) {
			showErrorMessage(element,error);
    	},
    	success: function(label, element) {
    		removeErrorMessage(element);
    	}
	});

	function showErrorMessage(element, error) {
		$(element).parent().find('p').remove();
		//Paints the border of the field signaling required field
		$(element).parent().parent().addClass('has-error');
		//Show 'p' whith error message
		$(element).after('<p class="alert-danger">'+ error[0].innerHTML +'</p>');
	}

	function removeErrorMessage(element) {
		$(element).parent().parent().removeClass('has-error');
		$(element).parent().find('p').remove();
	}
});

