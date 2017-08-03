	$.validator.addMethod("exactly", function(value, element, params) {		
		if (value.length != params) {
			return false;
		}
		return true;
	}, "Não possui o número de caracteres correpondentes");