function have(id, i) {
	var tmp;
	var j;
	for (j in toolbar) {
		tmp = toolbar[j].split(',');
		if (tmp[i] == id) {
			return j;
		}
	}
	return -1;
}

function show(id, owner) {
	if (owner == "") {
		owner = "_root";
	}
	if (have(id, 0) == -1) {
		toolbar.push(id + "," + owner);
	}
	var i = have(owner, 1);
	var tmp;
	while(i != -1) {
		tmp = toolbar[i].split(',')[0];
		if (tmp != id) {
			document.getElementById(tmp).style.visibility = "hidden";
			toolbar.splice(i, 1);
			i = have(tmp, 1);
		} else {
			break;
		}
	}
	document.getElementById(id).style.visibility = "";
}

function hide(id) {
	if (have(id, 1) == -1) {
		document.getElementById(id).style.visibility = "hidden";
		var i;
		for (i in toolbar) {
			if (toolbar[i].split(',')[0] == id) {
				toolbar.splice(i, 1);
			}
		}
	}
}
