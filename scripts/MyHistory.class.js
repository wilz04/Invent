function MyHistory(target) {
	this.me = new Array();
	this.i = 0;
	this.target = target;
	
	this.cat = myHistory_cat;
	this.prev = myHistory_prev;
	this.next = myHistory_next;
}

function myHistory_cat(url) {
	with (this) {
		if (me.length == 0) {
			me[0] = url;
		} else {
			me[++i] = url;
			var k = me.length;
			for (var j = i+1; j<k; ++j) {
				me.pop();
			}
		}
	}
}

function myHistory_prev() {
	with (this) {
		if (i > 0) {
			getURL(me[--i], target);
		}
	}
}

function myHistory_next(){
	with (this) {
		if (i < me.length-1) {
			getURL(me[++i], target);
		}
	}
}
