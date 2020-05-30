/*jslint browser:true, esnext:true*/
export default class Endecoder {
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
	static api(data) {
		return new Promise(resolve => {
			var xhr = new XMLHttpRequest();
			xhr.open("post", "http://localhost:3000/api.php");
			xhr.addEventListener("load", e => {
				resolve(xhr);
			});
			xhr.send(data);
		});
	}
	static submit(e) {
		e.preventDefault();
		e.stopPropagation();
		
		var form = document.getElementById('form1');
		var formData = new FormData(form);
		this.api(formData).then(data => {
			var r = document.getElementById('r');
			// r.textContent = data.responseText;
			r.value = data.responseText;
		});		
		return false;
	}
	static init() {
		var form1 = document.getElementById("form1");
		form1.addEventListener("submit", e => this.submit.call(this, e));
		var btn_reverse = document.getElementById("btn_reverse");
		btn_reverse.addEventListener("click", e => this.reverse.call(this, e));
	}
}