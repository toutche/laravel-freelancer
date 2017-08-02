//var field;
$.validator.addMethod("selectVerify", function(value, element, arg){
	if($(element).val() == "") {
  		return false;
	}
	return true;
}, "O campo grau é obrigatório");