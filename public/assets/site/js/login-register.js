
	
	function validatePassword(form,password,confirm_password) {
		$(form).submit(function(event) {
			
			removeErrorMessage($(password));
			removeErrorMessage($(confirm_password));

			if($(password).val().length == 0) {
				showErrorMessage($(password), 'O campo senha é obrigatório', event);
			}else if($(password).val().length < 6 || $(password).val().length > 16) {
				showErrorMessage($(password), 'O campo senha deve possuir entre 6 e 16 caracteres', event);
			}else if($(confirm_password).val() != $(password).val()) {
				showErrorMessage($(password), 'Senhas devem ser iguais', event);
				showErrorMessage($(confirm_password), 'Senhas devem ser iguais', event);
			}else{
				return;
			}
		});
	}

	/*
		$("#register-form").submit(function(event) {
			var password = $("#password");
			var confirm_password = $("#confirm-password");

			removeErrorMessage(password);
			removeErrorMessage(confirm_password);

			if(password.val().length == 0) {
				showErrorMessage(password, 'O campo senha é obrigatório', event);
			}else if(password.val().length < 6 || password.val().length > 16) {
				showErrorMessage(password, 'O campo senha deve possuir entre 6 e 16 caracteres', event);
			}else if(confirm_password.val() != password.val()) {
				showErrorMessage(password, 'Senhas devem ser iguais', event);
				showErrorMessage(confirm_password, 'Senhas devem ser iguais', event);
			}else{
				return;
			}
		});

	 */

	function showErrorMessage(element, message, event = null) {
		//Paints the border of the field signaling required field
		element.parent().parent().addClass('has-error');
		//Show 'p' whith error message
		$('<p>'+ message +'</p>').insertAfter(element).addClass('alert-danger');
		if(event != null ) event.preventDefault();
	}

	function removeErrorMessage(element) {
		element.parent().parent().find('p').remove();
		element.parent().parent().removeClass('has-error');
	}

