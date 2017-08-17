jQuery.validator.addMethod("inArray", function(value, element, param) {
    return this.optional(element) || $.inArray(value, param) != -1;
}, jQuery.validator.format(""));