	$.validator.addMethod("cellPhoneVerify", function(value, element) {
		value = value.replace('(','');
		value = value.replace(')','');
		value = value.replace(' ','');
		cell_phone = value.replace('-','');

		if( cell_phone.length != 10 && cell_phone.length != 11){
			return false;
		}
		return true;
	}, "O campo celular tem que possuir 10 ou 11 dígitos");