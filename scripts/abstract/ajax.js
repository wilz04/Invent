function new_Ajax() {
	var me = null;
	try { // Mozilla, Safari,...
		me = new XMLHttpRequest();
		me.overrideMimeType("text/html");
	} catch (e) { // IE
		try {
			me = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				me = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				me = null;
			}
		}
	}
	return me;
}

function getURL(url, target) {
	var ajax = new_Ajax();
	if (ajax != null) {
		ajax.open("GET", url, false);
		ajax.onreadystatechange = function() {
			if (ajax.readyState == 4) {
				if (ajax.status == 200) {
					document.getElementById(target).innerHTML = ajax.responseText;
				}
			}
		};
		ajax.send(null);
	}
}
