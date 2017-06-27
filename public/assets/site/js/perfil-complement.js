$(document).ready(function() {
	//alert('teste');
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
});