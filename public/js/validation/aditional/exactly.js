	$.validator.addMethod("exactly", function(value, element, params) {		
		//test if value is null (not required)
		if (value.length == 0) {
			return true;
		}
		if (value.length != params) {
			return false;
		}
		return true;
	}, "Não possui o número de caracteres correpondentes");