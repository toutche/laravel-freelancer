$(document).ready(function() {

	
	$('#options-degree').change(function(){
		var option_selected = $(this).val();
		var semestre = $('#semestre');
		var crea = $('#crea');
		console.log(option_selected);
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

	$('#save').click(function(){
		event.preventDefault(); //Prevent default from click
		//console.log($("textarea[name='ex_description_1'").summernote("code"));
		//alert("Salvou");
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
});