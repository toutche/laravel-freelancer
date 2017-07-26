	$.validator.addMethod("brazilianDate",
	    function(value, element) {
	        // put your own logic here, this is just a (crappy) example
	        return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
	    },
	    "Digite uma data válida no formato DD/MM/AAAA"
	);