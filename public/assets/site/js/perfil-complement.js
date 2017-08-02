$(document).ready(function() {

	//Set token for ajax request
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('input[name="_token"]').val()
	  }
	});

	$('#select_degree').change(function(){
		var option_selected = $(this).val();
		var semestre = $('#semestre');
		var crea = $('#crea');

		if(option_selected == 'graduating') {
			crea.hide();
			semestre.show();
		} else if(option_selected == 'graduate'){
			semestre.hide();
			crea.show();
		} else if(option_selected == '') {
			semestre.hide();
			crea.hide();
		}
		$(this).valid();
	});

	//Action click from button add new experience
	$(document).on('click','#add-experience',function(event){
		event.preventDefault(); //Prevent default from click
 	
 		//identifies the current button clicked
		var current = $(this);

		//add loading image
		current.getParent(3).append('<div id="loading_experiences"></div>');

		//mobile url = /laravel/public
		//Get current session value of number_of_experiences with ajax request
		$.post({                    
		  url: '/session/get',
		  data: { key: 'number_of_experiences'},
		  dataType: 'json',
		  timeout: 50000,
		  success: function (response) {
		  	var number_of_experiences = new Number(response.number_of_experiences) + 1;
		  	var jqxhr;
		  	if (number_of_experiences <= 5) {
		  		//set new current session value of number_of_experiences with ajax request
				jqxhr = $.post({
					url: '/session/set',
					data: { key: 'number_of_experiences', value: number_of_experiences},
					dataType: 'json'
				});

				jqxhr.always(function() {
					//Get 'last' experience by 'number_of_experiences'
					var last_experience = $(".experience[data-experience='" + (number_of_experiences - 1) + "']")
					last_experience
							.clone()	
							.attr('data-experience', number_of_experiences)
							.appendTo($('#experiences'));

					update_fields(number_of_experiences);
					current.remove(); //Remove link from previous experience
					
					removeLoading('div#loading_experiences');
				});
				
			} else {
				removeLoading('div#loading_experiences');
				alert("Máximo de experiências é 5");
			}
		  },
		  error: function(xmlhttprequest, textstatus, message) {
		    if(textstatus==="timeout") {
		    	removeLoading('div#loading_experiences');
		        alert("Erro: Tente novamente");
		    }
		  }
		});
	});

	function removeLoading(identifier) {
		//remove loading image
		$(identifier).remove();
	}

	//Function update inputs and textarea attributes name
	function update_fields(number_of_experiences) {

		//Fetches all clone inputs
		$(".experience[data-experience='" + number_of_experiences + "'] :input").each( function() {
			
			//Set news attributes name
			switch($(this).attr("name")) {
				case 'ex_company_name_[' + (number_of_experiences - 1) + ']':
					$(this).attr("name", "ex_company_name_[" + number_of_experiences + "]");
					break;
				case 'ex_responsibility_name_[' + (number_of_experiences - 1) + ']':
					$(this).attr("name", "ex_responsibility_name_[" + number_of_experiences + "]");
					break;
				case 'ex_start_date_[' + (number_of_experiences - 1) + ']':
					$(this).attr("name", "ex_start_date_[" + number_of_experiences + "]");
					break;
				case 'ex_end_date_[' + (number_of_experiences - 1) + ']':
					$(this).attr("name", "ex_end_date_[" + number_of_experiences + "]");
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
			},
			//education
			select_degree: {
				selectVerify: true
			},

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
			},
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
		$(element).getParent(1).find('p.alert-danger').remove();

		var levelParent;
		switch($(element).attr('id')) {
			case "image_perfil":
				$('<p class="alert-danger">'+ error[0].innerHTML +'</p>').insertAfter($(element).next());
				break;
			case "select_degree":
				levelParent = 4;
				//Show 'p' whith error message
				$(element).after('<p class="alert-danger">'+ error[0].innerHTML +'</p>');
				break;
			default:
				levelParent = 1;
				//Show 'p' whith error message
				$(element).after('<p class="alert-danger">'+ error[0].innerHTML +'</p>');
				break;
		}
		//Paints the border of the field signaling required field
		$(element).getParent(levelParent).addClass('has-error');
	}

	function removeErrorMessage(element) {
		var levelParent;
		switch($(element).attr('id')) {
			case "select_degree":
				levelParent = 4;
				break;
			default:
				levelParent = 1;
				break;
		}
		$(element).parent().find('p.alert-danger').remove();
		$(element).getParent(levelParent).removeClass('has-error');
	}

	//Plugin getParent by levels
	jQuery.fn.getParent = function(num) {
	    var last = this[0];
	    for (var i = 0; i < num; i++) {
	        last = last.parentNode;
	    }
	    return jQuery(last);
	};
});