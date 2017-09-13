$(document).ready(function() {

	//Set token for ajax request
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('input[name="_token"]').val()
		}
	});

	//Plugin getParent by levels
	jQuery.fn.getParent = function(num) {
		var last = this[0];
		for (var i = 0; i < num; i++) {
			last = last.parentNode;
		}
		return jQuery(last);
	};

	// Disable function
	jQuery.fn.extend({
		disable: function(state) {
			return this.each(function() {
				this.disabled = state;
			});
		}
	});

	$('.semester').hide();
	$('.crea').hide();

	//mobile url = /laravel/public
	function getAJAX(url, key, before_send = function(){}) {
		var response;
		var jqxhr = $.post({                    
			url: url,
			data: { key: key},
			dataType: 'json',
			async: false,
			timeout: 50000,
			beforeSend: function(){
				(before_send)();
			}
		});

		jqxhr.done(function(responseRequest){
			response = new Number(responseRequest[key]);
		});
		return response;
	}

	function getAJAXCourses() {
		var response = new Array();
		var columns = JSON.parse('["id", "name_of_course"]');
		var where = JSON.parse('[ ["status",1] ]');
		var jqxhr = $.post({                    
			url: '/cursos',
			data: {columns: columns, where: where},
			dataType: 'json',
			async: false,
			timeout: 50000,
		});

		jqxhr.done(function(responseRequest){
			$.each(responseRequest, function(index, value) {
				response.push(value.id + "");
			});
		});
		return response;
	}

	//variable to control total experiences
	var number_of_experiences = getAJAX('/session/get', 'number_of_experiences');
	//variable to control total educations
	var number_of_educations = getAJAX('/session/get', 'number_of_educations');
	//variable to control courses
	var courses = getAJAXCourses();

	//Action click from button delete experience
	$(document).on('click','#delete-experience',function(event) {
		event.preventDefault();

		//(div_experience = .experience) div of button clicked
		var div_experience = $(this).getParent(3);
		//Data-attribute of the div_experience
		var id = new Number(div_experience.attr("data-experience"));

		//show confirmation modal for the exclusion
		showModal($('[data-remodal-id=modal]'), 'experience', id);
  	});

	//Action click from button add new experience
	$(document).on('click','#add-experience',function(event){
		event.preventDefault(); //Prevent default from click

 		//identifies the current button clicked
 		var current = $(this);

		//disable buttom link
		current.bind('click', false);
		//update global variable number_of_experiences 
		number_of_experiences = number_of_experiences + 1;

  		//add loading image
  		var before_send = function() {
  			current.getParent(3).append('<div id="loading"></div>');
  		};
		//Get value number_of_experiences
		var number_of_experiences_local = (getAJAX('/session/get', 'number_of_experiences', before_send) + 1);
		
		var jqxhr;
		if (number_of_experiences_local <= 5) {
  			//set new current session value of number_of_experiences with ajax request
  			jqxhr = $.post({
  				url: '/session/set',
  				data: { key: 'number_of_experiences', value: number_of_experiences_local},
  				dataType: 'json'
  			});

  			jqxhr.always(function() {

				//Get 'last' experience by 'number_of_experiences'
				var last_experience = $(".experience[data-experience='" + (number_of_experiences_local - 1) + "']")

				last_experience
				.clone()	
				.attr('data-experience', number_of_experiences_local)
				.appendTo($('#experiences'));

				update_fields_experiences(number_of_experiences_local);
				current.remove(); //Remove link from previous experience
				validateExperiences();
				removeLoading('div#loading');
			});

  		} else {
  			removeLoading('div#loading');
  			alert("Máximo de experiências é 5");
  		}
		//enable buttom link
		current.disable(false);
	});

	//Action click from button delete education
	$(document).on('click','#delete-education', function(event) {
		event.preventDefault();

		var div_education = $(this).getParent(3);
		var id = new Number(div_education.attr("data-education"));
		//show confirmation modal for the exclusion
		showModal($('[data-remodal-id=modal]'), 'education', id);
	});

	//Action click from button add new education
	$(document).on('click','#add-education',function(event) {
		event.preventDefault(); //Prevent default from click

		//identifies the current button clicked
		var current = $(this);

		//disable buttom link
		current.bind('click', false);
		
		//add loading image
  		var before_send = function() {
  			current.getParent(3).append('<div id="loading"></div>');
  		};
		//Get current session value of number_of_educations with ajax request
		var number_of_educations_local = (getAJAX('/session/get', 'number_of_educations', before_send) + 1);
    	var jqxhr;

    	if (number_of_educations_local <= 5) {
    		//update global variable number_of_educations
    		number_of_educations = number_of_educations + 1;
  			//set new current session value of number_of_educations with ajax request
  			jqxhr = $.post({
  				url: '/session/set',
  				data: { key: 'number_of_educations', value: number_of_educations_local},
  				dataType: 'json'
  			});

  			jqxhr.always(function() {

				//Get 'last' experience by 'number_of_educations'
				var last_education = $(".education[data-education='" + (number_of_educations_local - 1) + "']")

				last_education
				.clone()	
				.attr('data-education', number_of_educations_local)
				.appendTo($('#educations'));

				update_fields_educations(number_of_educations_local);
				current.remove(); //Remove link from previous experience
				validateEducations();
				removeLoading('div#loading');
			});	
  		} else {
  			removeLoading('div#loading');
  			alert("Máximo de educações é 5");
  		}
		//enable buttom link
		current.disable(false);
	});

	//action the click exclusion education|experience 
	$(document).on('click', '.remodal [data-remodal-action=confirm]', function(e) {
		e.preventDefault();

		var modal = $(this).getParent(1); //div modal
		var reference = modal.attr("data-reference"); // reference: 'education', 'experience'
		var id = new Number(modal.attr("data-id")); //id modal: id of experience or education
		//var div = $(".education[data-education='" + id + "']");
		var div = $("."+reference+"[data-"+reference+"='" + id + "']");
		var number_of; // number variable global: 'number_of_educations', 'number_of_experiences'

		//add loading image
  		var before_send = function() {
			//if it's the last 'div.education', ''div.experience'', add loading in the previous div else in the next div  
			number_of = (reference == 'education') ? number_of_educations : number_of_experiences;
			if (number_of == id) {
				div.prev().append('<div id="loading"></div>');
			} else {
				div.next().prepend('<div id="loading"></div>');
			}
		};
		
		//Get value number_of_experiences|number_of_experiences
		var number = getAJAX("/session/get", "number_of_"+reference+"s", before_send);
		var jqxhr;

		//Updates indexes the experiences, or educations after the removed div
	  	for(i = (id+1); i <= number; i++) {
	  		if (reference == 'education') {
				update_fields_educations(i,true);
			} else if(reference == 'experience') {
				update_fields_experiences(i,true);
			}
	  	}

	  	//set new current session value of 'number_of_educations', 'number_of_experiences' with ajax request
		jqxhr = $.post({
			url: '/session/set',
			data: { key: "number_of_"+reference+"s", value: (number-1)},
			dataType: 'json'
		});

		jqxhr.always(function() {
			//puts the button when there is only one experiment or education, or when the one to be deleted is the last one placed in the previous one
			if(number == 1 || id == number_of) {
				div.prev().find("div.add-post-btn:last > div:first-child").append('<a href="#" id="add-'+reference+'" class="btn-added"><i class="ti-plus"></i> Adicionar</a>');
			}
			//Remove div -> '.experience', '.education', div of button clicked
			div.remove();
			//update global variable 'number_of_educations', 'number_of_experiences'
			if (reference == 'education') {
				number_of_educations = number_of_educations - 1;
			} else if(reference == 'experience') {
				number_of_experiences = number_of_experiences - 1;
			}
			removeLoading('div#loading');
		});
	});

	function removeLoading(identifier) {
		//remove loading image
		$(identifier).remove();
	}

	//Function update inputs and textarea attributes name of experiences
	function update_fields_experiences(number_of_experience, remove = false) {
		
		var new_number_of_experience
		
		if (remove == false) {
			new_number_of_experience = number_of_experience;
			number_of_experience = number_of_experience - 1;
			//if exists button, remove this
			$(".experience[data-experience='" + new_number_of_experience + "'] div.add-post-btn > div:last > a").remove();
			//add button remove experience
			$(".experience[data-experience='" + new_number_of_experience + "'] div.add-post-btn > div:last").append('<a href="#" id="delete-experience" class="btn-delete"><i class="ti-trash"></i> Remover este</a>');
		} else {
			new_number_of_experience = number_of_experience - 1;
			//update new attibute data-experience for 'div.experience' 
			$(".experience[data-experience='" + number_of_experience + "']").attr("data-experience", new_number_of_experience);

		}
		
		//Fetches all clone inputs
		$(".experience[data-experience='" + new_number_of_experience + "'] :input").each( function() {
			
			//Set news attributes name
			switch($(this).attr("name")) {
				case 'ex_company_name_[' + number_of_experience + ']':
					$(this).attr("name", "ex_company_name_[" + new_number_of_experience + "]");
					break;
				case 'ex_responsibility_name_[' + number_of_experience + ']':
					$(this).attr("name", "ex_responsibility_name_[" + new_number_of_experience + "]");
					break;
				case 'ex_start_date_[' + number_of_experience + ']':
					$(this).attr("name", "ex_start_date_[" + new_number_of_experience + "]");
					break;
				case 'ex_end_date_[' + number_of_experience + ']':
					$(this).attr("name", "ex_end_date_[" + new_number_of_experience + "]");
					break;
			}
			//If action remove not clean values
			if(remove == false) $(this).val("");
			removeErrorMessage($(this));
		});

		//Update references of the Summernote (recreate)
		var current_editor = $(".experience[data-experience='" + new_number_of_experience + "']:last section.editor");
		
		current_editor.find('div.note-editor').remove();
		current_editor.find("textarea").remove();					
		current_editor.append("<textarea name='ex_description_["+ new_number_of_experience +"]'></textarea>");
		current_editor.find("textarea")
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

	//Function update inputs and textarea attributes name of educations
	function update_fields_educations(number_of_education, remove = false) {
		
		var new_number_of_education;

		if (remove == false) {
			new_number_of_education = number_of_education;
			number_of_education = number_of_education - 1;
			//if exists button, remove this
			$(".education[data-education='" + new_number_of_education + "'] div.add-post-btn > div:last > a").remove();
			//add button remove education
			$(".education[data-education='" + new_number_of_education + "'] div.add-post-btn > div:last").append('<a href="#" id="delete-education" class="btn-delete"><i class="ti-trash"></i> Remover este</a>');
		} else {
			new_number_of_education = number_of_education - 1;
			//update new attibute data-education for 'div.education' 
			$(".education[data-education='" + number_of_education + "']").attr("data-education", new_number_of_education);
		}
		
		//Fetches all clone inputs
		$(".education[data-education='" + new_number_of_education + "'] :input").each( function() {
			
			var element = $(this);
			
			//Set news attributes name
			switch($(this).attr("name")) {
				case 'ed_select_degree_[' + number_of_education + ']':
					//$(this) == select
					$(this).getParent(3).prev().attr("for", "ed_select_degree_[" + new_number_of_education + "]"); //external label
					$(this).getParent(3).attr("id", "ed_select_degree_[" + new_number_of_education + "]"); //div#ed_select_degree_[i]
					$(this).prev().prev().attr("data-id", "ed_select_degree_[" + new_number_of_education + "]"); // button
					$(this).attr("name", "ed_select_degree_[" + new_number_of_education + "]");
					$(this).attr("id", "ed_select_degree_[" + new_number_of_education + "]");
					$(this).attr("data-id", new_number_of_education);

					var label = $(this).getParent(2); //#label
					var select = label.find("select").clone(); //clone select
					var index;
					//If action remove not clean values
					if(remove == true) {
						//Get index of selected option
						index = label.find("li.selected").attr("data-original-index");
					}
					label.find(".bootstrap-select").remove(); //remove div.bootstrap-select
					select.appendTo(label).selectpicker("render"); //add new select
					//If action remove not clean values
					if(remove == true) {
						//Remarks option selected by index
						select.children().eq(index).attr("selected", "selected");
					}
					select.change();
					element = select;
					break;
				/*case 'ed_course_[' + number_of_education + ']':
					$(this).attr("name", "ed_course_[" + new_number_of_education + "]");
					break;*/
				case 'ed_select_course_[' + number_of_education + ']':
					//$(this) == select
					$(this).getParent(3).prev().attr("for", "ed_select_course_[" + new_number_of_education + "]"); //external label
					$(this).getParent(3).attr("id", "ed_select_course_[" + new_number_of_education + "]"); //div#ed_select_degree_[i]
					$(this).prev().prev().attr("data-id", "ed_select_course_[" + new_number_of_education + "]"); // button
					$(this).attr("name", "ed_select_course_[" + new_number_of_education + "]");
					$(this).attr("id", "ed_select_course_[" + new_number_of_education + "]");
					$(this).attr("data-id", new_number_of_education);

					var label = $(this).getParent(2); //#label
					var select = label.find("select").clone(); //clone select
					var index;
					//If action remove not clean values
					if(remove == true) {
						//Get index of selected option
						index = label.find("li.selected").attr("data-original-index");
					}
					label.find(".bootstrap-select").remove(); //remove div.bootstrap-select
					select.appendTo(label).selectpicker("render"); //add new select
					//If action remove not clean values
					if(remove == true) {
						//Remarks option selected by index
						select.children().eq(index).attr("selected", "selected");
					}
					select.change();
					element = select;
					break;
				case 'ed_semester_[' + number_of_education + ']':
					$(this).attr("name", "ed_semester_[" + new_number_of_education + "]");
					break;
				case 'ed_crea_state_[' + number_of_education + ']':
					$(this).getParent(3).attr("id", "ed_crea_state_[" + new_number_of_education + "]"); //div#ed_crea_state_[i]
					$(this).prev().prev().attr("data-id", "ed_crea_state_[" + new_number_of_education + "]"); // button
					$(this).attr("name", "ed_crea_state_[" + new_number_of_education + "]");
					$(this).attr("id", "ed_crea_state_[" + new_number_of_education + "]");
					$(this).attr("data-id", new_number_of_education);

					var label = $(this).getParent(2); //#label
					var select = label.find("select").clone(); //clone select
					var index;
					//If action remove not clean values
					if(remove == true) {
						//Get index of selected option
						index = label.find("li.selected").attr("data-original-index");
					}
					label.find(".bootstrap-select").remove(); //remove div.bootstrap-select
					select.find('option:selected').removeAttr("selected");//remove option selected
					select.appendTo(label).selectpicker("render"); //add new select
					//If action remove not clean values
					if(remove == true) {
						//Remarks option selected by index
						select.children().eq(index).attr("selected", "selected");
					}
					select.change();
					element = select;
					break;
				case 'ed_crea_number_[' + number_of_education + ']':
					$(this).attr("name", "ed_crea_number_[" + new_number_of_education + "]");
					break;
				case 'ed_college_[' + number_of_education + ']':
					$(this).attr("name", "ed_college_[" + new_number_of_education + "]");
					break;
				case 'ed_start_date_[' + number_of_education + ']':
					$(this).attr("name", "ed_start_date_[" + new_number_of_education + "]");
					break;
				case 'ed_end_date_[' + number_of_education + ']':
					$(this).attr("name", "ed_end_date_[" + new_number_of_education + "]");
					break;
			}

			$(".education[data-education='" + new_number_of_education + "']").find("div.semester").attr("id", "semester_" + new_number_of_education);
			$(".education[data-education='" + new_number_of_education + "']").find("div.crea").attr("id", "crea_" + new_number_of_education);

			//If action remove not clean values
			if(remove == false) {
				//if obj equal 'SELECT' don't clean value 
				if(element[0].tagName != 'SELECT') {
					$(this).val("");
				}
			}
			removeErrorMessage(element);
		});
	}

	//When there is change select state crea
	$(document).on('change', '.crea select.selectpicker', function() {
		$(this).valid();
	});

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

	//Used in the validation of experiences by Array
	// must be called after validate()
	var validateExperiences = function() {
		$('input.ex_company_name').each(function() {
			$(this).rules('add', {
				required: true,
				minlength: 3,
				maxlength: 100,
				messages: {
					required: "O campo nome da empresa é obrigatório",
					minlength: jQuery.validator.format("Mínimo de caracteres para o campo nome da empresa é {0}"),
					maxlength: jQuery.validator.format("Máximo de caracteres para o campo nome da empresa é {0}")
				}
			});
		});

		$('input.ex_responsibility_name').each(function() {
			$(this).rules('add', {
				required: true,
				minlength: 3,
				maxlength: 100,
				messages: {
					required: "O campo cargo é obrigatório",
					minlength: jQuery.validator.format("Mínimo de caracteres para o campo cargo é {0}"),
					maxlength: jQuery.validator.format("Máximo de caracteres para o campo cargo é {0}")
				}
			});
		});

		$('input.ex_start_date').each(function() {
			$(this).rules('add', {
				required:true,
				number: true,
				exactly: 4,
				messages: {
					required: "O campo data de início é obrigatório",
					number: "O campo data de início só aceita números",
					exactly: jQuery.validator.format("O campo data de início tem que possuir {0} números")
				}
			});
		});

		$('input.ex_end_date').each(function() {
			$(this).rules('add', {
				number: true,
				exactly: 4,
				messages: {
					number: "O campo data de término só aceita números",
					exactly: jQuery.validator.format("O campo data de término tem que possuir {0} números")
				}
			});
		});
	}
	validateExperiences();

	//Used in the validation of educations by Array
	// must be called after validate()
	var validateEducations = function() {
		$('select.ed_select_degree').each(function() {
			$(this).rules('add', {
				valueNotEquals: "",
				inArray: ["graduating", "graduate"],
				messages: {
					valueNotEquals: "O campo grau é obrigatório",
					inArray: "Selecione uma opção"
				}
			});
		});
		$('select.ed_select_course').each(function() {
			$(this).rules('add', {
				valueNotEquals: "",
				inArray: courses,
				messages: {
					valueNotEquals: "O campo curso é obrigatório",
					inArray: "Selecione um curso válido"
				}
			});
		});
		$('input.ed_college').each(function() {
			$(this).rules('add', {
				required: true,
				minlength: 3,
				maxlength: 100,
				messages: {
					required: "O campo instituição de ensino é obrigatório",
					minlength: jQuery.validator.format("Mínimo de caracteres para o campo instituição de ensino é {0}"),
					maxlength: jQuery.validator.format("Máximo de caracteres para o campo instituição de ensino é {0}")
				}
			});
		});
		$('input.ed_start_date').each(function() {
			$(this).rules('add', {
				required: true,
				number:true,
				exactly:4,
				messages: {
					required: "O campo ano de início é obrigatório",
					number: "O campo ano de início só aceita números",
					exactly: jQuery.validator.format("O campo ano de início tem que possuir {0} números")
				}
			});
		});
		$('input.ed_end_date').each(function() {
			$(this).rules('add', {
				number: true,
				exactly: 4,
				messages: {
					number: "O campo ano de término só aceita números",
					exactly: jQuery.validator.format("O campo ano de término tem que possuir {0} números")
				}
			});
		});
	}
	validateEducations();

	function addRulesOfGraduate(state, number) {
		state.rules('add', {
			valueNotEquals: "",
			inArray: ["AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB",
			"PR", "PE", "PI", "RJ", "RN", "RO", "RS", "RR", "SC", "SE", "SP", "TO"],
			messages: {
				valueNotEquals: "O campo estado é obrigatório",
				inArray: "Escolha um estado"
			}
		});
		number.rules('add', {
			required: true,
			number:true,
			messages: {
				required: "O campo CREA é obrigatório",
				number: "O campo CREA só aceita números"
			}
		});
	}
	function removeRulesOfGraduate(state, number) {
		state.rules('remove');
		number.rules('remove');
	}

	function addRulesOfGraduating(semester) {
		semester.rules('add', {
			required: true,
			number: true,
			range: [1,10],
			messages: {
				required: "O campo semestre é obrigatório",
				number: "O campo semestre só aceita números",
				range: "O campo semestre precisa estar entre 1 e 10"
			}
		});
	}

	function removeRulesOfGraduating(semester) {
		$(semester).rules('remove');
	}

	//Identifies whether the degree is selected and shows the specific div according to the degree.
	//When it returns with error in the educations already appears, the clones with the 
	//div semester or crea open.

	//Ready the document
	$('.degree select.selectpicker').each(function(){
		open_crea_or_semester($(this), false);
	});
	//When there is change
	$(document).on('change', '.degree select.selectpicker', function() {
		open_crea_or_semester($(this), true);
	});
	//When there is change on select ed_select_courses
	$(document).on('change', '.course select.selectpicker', function() {
		if($(this).valid()) {
			removeErrorMessage($(this));
		}
	});

	function open_crea_or_semester(element, validate) {
		var option_selected = element.val();
		var education_number = element.attr('data-id');
		var semester = $("div#semester_" + education_number);
		var crea = $("div#crea_" + education_number);

		if(option_selected == 'graduating') {
			crea.hide();
			semester.show();
			removeErrorMessage(crea.find('select'));
			removeErrorMessage(crea.find('input'));
			removeRulesOfGraduate(crea.find('select'), crea.find('input'));
			addRulesOfGraduating(semester.find('input'));
		} else if(option_selected == 'graduate') {
			semester.hide();
			crea.show();
			removeErrorMessage(semester.find('input'));
			removeRulesOfGraduating(semester.find('input'));
			addRulesOfGraduate(crea.find('select'), crea.find('input'));
		} else if(option_selected == '') {
			semester.hide();
			crea.hide();
		}
		if(validate) element.valid();
	}

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
			case "ed_select_degree_[" + $(element).attr('data-id') + "]":
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
			case "ed_select_degree_[" + $(element).attr('data-id') + "]":
				levelParent = 4;
				break;
			case "ed_select_course_[" + $(element).attr('data-id') + "]":
				levelParent = 4;
				break;
			default:
				levelParent = 1;
				break;
		}
		
		$(element).getParent(levelParent).removeClass('has-error');
		$(element).getParent(levelParent).find('p.alert-danger').remove();
	}
	/**
	 * [showModal Opens exclusion remodal of education or experience ]
	 * @param  {[object]} modal     [object div.remodal]
	 * @param  {[String]} reference [call reference: 'education', 'experience']
	 * @param  {[Number]} id        [id number of div to be deleted]
	 */
	function showModal(modal, reference, id) {
		modal.attr("data-id", id);
		modal.attr("data-reference", reference);
		if (reference == 'experience') { reference = 'experiência'} else if(reference == 'education') { reference = 'educação'}
		modal.find("p > b:first-child").text(reference);
		modal.find("p > b:last").text(id);
		var inst = modal.remodal(); //instance
		inst.open(); //open remodal
	}
});