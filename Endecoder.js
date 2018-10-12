/*jslint browser:true, esnext:true*/
class Endecoder {
	static reverse() {
		var t = document.getElementById("t").value;
		var r = document.getElementById("r").value;
		document.getElementById("t").value = r;
		document.getElementById("r").value = t;
		var m = document.getElementById("m").value;
		var m2 = "";
		for (let i = m.length - 1; i >= 0; i--) {
			var n = m.charCodeAt(i) - 32;
			m2 += String.fromCharCode((n % 64) + 64);
		}
		document.getElementById("m").value = m2;
	}
	static init() {

	}
}
Endecoder.init();
