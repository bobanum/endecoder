/*jslint browser:true, esnext:true*/
import Endecoder from "./Endecoder.js";
export default class App {
	static load() {
		return new Promise(resolve => {
			window.addEventListener("load", e => {
				resolve(e);
			});
		});
	}
	static init() {
		this.load().then(_data => {
			Endecoder.init();
		});
	}
}
App.init();
