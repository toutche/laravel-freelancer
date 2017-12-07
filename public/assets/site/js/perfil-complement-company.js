$(document).ready(function() {
	
	var div_responsible_enginner_informations = $('#div-responsible-engineer-informations').hide();
	
	$('input[name="is_company_engineer"]').change(function(){
		if($(this).val() == 1) {
			div_responsible_enginner_informations.show();
		} else if($(this).val() == 0) {
			div_responsible_enginner_informations.hide();
		}
	});
	
});