	$.validator.addMethod("phoneVerify", function(value, element) {
		value = value.replace('(','');
		value = value.replace(')','');
		value = value.replace(' ','');
		phone = value.replace('-','');
		
		if (phone.length == 0) {
			return true;
		} else if(phone.length!=10){
			return false;
		}
		return true;
	}, "O campo telefone tem que possuir 10 dígitos");