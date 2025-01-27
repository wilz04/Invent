function User() {
	this.eMail = null;
	this.pwd = null;
	this.name = null;
	this.rate = new Array();
	
	this.register = user_register;
	this.login = user_login;
	this.getName = user_getName;
	this.addProduct = user_addProduct;
	this.delProduct = user_delProduct;
	this.getRate = user_getRate;
	this.logout = user_logout;
}

function isEMail(eMail) {
	var result = false;
	var eMails = eMail.split(',');
	var tmp;
	for (var i=0; i<eMails.length; i++) {
		if (eMails[i] != "") {
			tmp = eMails[i].split('@');
			if (tmp.length == 2) {
				tmp = tmp[1].split('.');
				if (tmp.length < 2) {
					return false;
				}
			} else {
				return false;
			}
			result = true;
		}
	}
	return result;
}

function user_getName() {
	return this.eMail.split('@')[0];
}

function user_register(eMail, pwd, fName, sName, id, phone) {
	if (eMail == "" || pwd == "" || fName == "" || sName == "") {
		alert("Debes llenar los campos marcados con un *");
		return false;
	}
	if (!isEMail(eMail)) {
		alert("El e-mail no es válido!");
		return false;
	}
	loadURL("pages/register.php?email="+eMail+"&pwd="+pwd+"&fname="+fName+"&sname="+sName+"&id="+id+"&phone="+phone);
	
	this.eMail = eMail;
	this.pwd = pwd;
	this.name = this.getName();
	
	document.getElementById("name").innerHTML = "Bienvenido " + this.name + "!";
	return true;
}

function user_login(eMail, pwd) {
	if (eMail == "" || pwd == "") {
		alert("Debes llenar los campos marcados con un *");
		return false;
	}
	if (!isEMail(eMail)) {
		alert("El e-mail no es válido!");
		return false;
	}
	loadURL("pages/login.php?email="+eMail+"&pwd="+pwd);
	
	this.eMail = eMail;
	this.pwd = pwd;
	this.name = this.getName();
	
	document.getElementById("name").innerHTML = "Bienvenido " + this.name + "!";
	return true;
}

function user_addProduct(product) {
	this.rate.push(product);
}

function user_delProduct(product) {
	with (this) {
		var i;
		for (i in rate) {
			if (rate[i] == product) {
				rate.splice(i, 1);
			}
		}
	}
}

function user_getRate() {
	with (this) {
		var tmp = new Array();
		var j = rate.length;
		for (var i=0; i<j; i++) {
			tmp.push(rate.shift());
		}
		return tmp;
	}
}

function user_logout() {
	with (this) {
		email = null;
		pwd = null;
		name = null;
		rates = new Array();
	}
}
