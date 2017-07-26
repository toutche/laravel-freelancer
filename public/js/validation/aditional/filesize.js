	$.validator.addMethod('filesize', function (value, element, param) {
    	//Size in bytes
		if(element.files[0].size > param) return false;
	    return true;
	}, 'Tamanho máximo para imagem de perfil é 2MB');