function isFill(args) {
	for (var i=0; i<args.length; i++) {
		if (args[i].value == "") {
			alert("Debes rellenar los campos marcados con un *");
			return false;
		}
	}
	return true;
}

function isMaxLength(textField, length) {
	var tmp = textField.value.length;
	if (tmp > length) {
		var msg = "El area de texto soporta un maximo de " + length.toString() + " caracteres\n";
		msg += "y has digitado " + tmp.toString() + "\n\n";
		msg += "Deseas que el sistema recorte el texto?";
		return confirm(msg);
	}
	return true;
}
