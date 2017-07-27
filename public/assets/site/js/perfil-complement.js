$(document).ready(function() {

	$('#options-degree').change(function(){
		var option_selected = $(this).val();
		var semestre = $('#semestre');
		var crea = $('#crea');

		if(option_selected == 'graduating') {
			crea.hide();
			semestre.show();
		} else if(option_selected == 'graduate'){
			semestre.hide();
			crea.show();
		} else if(option_selected == 'select-degree') {
			semestre.hide();
			crea.hide();
		}
	});

	//Action click from button add new experience
	$(document).on('click','#add-experience',function(event){
		event.preventDefault(); //Prevent default from click
		
		//Get amount number of experiences
		var number_of_experiences = new Number($('input[name="number_of_experiences"]').attr('value')) + 1;

		if (number_of_experiences <= 5) {
			//Set new amount of experiences
			$('input[name="number_of_experiences"]').attr('value', number_of_experiences);

			//Get 'last' experience by 'number_of_experiences'
			var last_experience = $(".experience[data-experience='" + (number_of_experiences - 1) + "']")
			last_experience
					.clone()	
					.attr('data-experience', number_of_experiences)
					.appendTo($('#experiences'));

			update_fields(number_of_experiences);

			$(this).remove(); //Remove link from previous experience
		} else {
			alert("Máximo de experiências é 5");
		}
	});

	//Function update inputs and textarea attributes name
	function update_fields(number_of_experiences) {

		//Fetches all clone inputs
		$(".experience[data-experience='" + number_of_experiences + "'] :input").each( function() {
			
			//Set news attributes name
			switch($(this).attr("name")) {
				case 'ex_company_name_' + (number_of_experiences - 1):
					$(this).attr("name", "ex_company_name_" + number_of_experiences);
					break;
				case 'ex_responsibility_name_' + (number_of_experiences - 1):
					$(this).attr("name", "ex_responsibility_name_" + number_of_experiences);
					break;
				case 'ex_start_date_' + (number_of_experiences - 1):
					$(this).attr("name", "ex_start_date_" + number_of_experiences);
					break;
				case 'ex_end_date_' + (number_of_experiences - 1):
					$(this).attr("name", "ex_end_date_" + number_of_experiences);
					break;
			}
			$(this).val("");
		});

		$(".experience[data-experience='" + number_of_experiences + "']")
							.find('div.note-editor')
							.remove();

		//Find clone textearea and set new attribute name 
		$(".experience[data-experience='" + number_of_experiences + "']")
							.find('textarea')
							.attr("name", "ex_description_" + number_of_experiences)
							.summernote({
					    		height: 150,	
					    		lang: 'pt-BR',
					    		toolbar: [
								    // [groupName, [list of button]]
								    ['style', ['bold', 'italic', 'underline', 'clear']],
								    ['font', ['strikethrough', 'superscript', 'subscript']],
								    ['fontsize', ['fontsize']],
								    ['color', ['color']],
								    ['para', ['ul', 'ol', 'paragraph']],
								    ['height', ['height']]
								  ]
					    	});
	}

	$("#complement_register").validate({
		focusInvalid: false,
		focusCleanup: true,
		rules: {
			//basic informations
			name: {
				required: true,
				minlength: 3,
				maxlength:100
			},
			cpf: {
				required: true,
				cpfVerify: true
			},
			email: {
				required: true,
				email: true
			},
			professional_title: {
				minlength: 3,
				maxlength: 100
			},
			phone: {
				required: false,
				phoneVerify: true
			},
			cell_phone: {
				required: false,
				cellPhoneVerify: true
			},
			site: {
				url: true
			},
			date_birth: {
				required: true,
				brazilianDate: true
			},
			image_perfil: {
				extension: "jpg|jpeg|png",
				filesize: 2097152
			}
		},
		messages: {
			name: {
				required: "O campo nome é obrigatório",
				minlength: "Mínimo de caracteres para o nome é 3",
				maxlength: "Máximo de caracteres para o nome é 100"
			},
			cpf: {
				required: "O campo CPF é obrigatório"
			},
			email: {
				required: "O campo e-mail é obrigatório",
				email: "Digite um e-mail válido"
			},
			professional_title: {
				minlength: "Mínimo de caracteres para o título profissional é 3",
				maxlength: "Máximo de caracteres para o título profissional é 100"
			},
			site: {
				url: "Digite uma url no formato http://www ou https://www"
			},
			date_birth: {
				required: "O campo data de nascimento é obrigatório"
			},
			image_perfil: {
				extension: "Insira uma imagem no formato jpeg, png ou jpg"
			}
		},
    	errorPlacement: function(error, element) {
			showErrorMessage(element,error);
    	},
    	success: function(label, element) {
    		removeErrorMessage(element);
    	},
    	// The div has the following class `.note-editable .panel-body` that we can use to
  		// exclude it from validation
    	ignore: ":hidden:not(#summernote),.note-editable.panel-body"
	});

	//Masks
	$('input[name="cpf"]').mask('000.000.000-00');
	$('input[name="phone"]').mask('(00) 0000-0000');

	var options = {
		onKeyPress: function(cell_phone, ev, el, op) {
			var masks = ['(00) 0000-00000', '(00) 00000-0000'];
			mask = (cell_phone.length > 14) ? masks[1] : masks[0];
			el.mask(mask,op);
		}
	}
	$('input[name="cell_phone"]').mask('(00) 0000-00000',options);
	$('input[name="date_birth"]').mask('00/00/0000');

	function showErrorMessage(element, error) {
		$(element).parent().find('p').remove();
		if($(element).attr('id') == 'image_perfil') {
			$('<p class="alert-danger">'+ error[0].innerHTML +'</p>').insertAfter($(element).next());
		} else {
			//Paints the border of the field signaling required field
			$(element).parent().addClass('has-error');
			//Show 'p' whith error message
			$(element).after('<p class="alert-danger">'+ error[0].innerHTML +'</p>');
		}
	}

	function removeErrorMessage(element) {
		$(element).parent().removeClass('has-error');
		$(element).parent().find('p').remove();
	}
});