 $.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg !== value;
 }, "Value must not equal arg.");