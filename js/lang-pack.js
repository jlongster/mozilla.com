function init_content()
{
	// check if navigator is Firefox
	if (navigator.userAgent.indexOf("Firefox") > -1 || navigator.userAgent.indexOf("BonEcho") > -1) {

		// remove the download link and download note
		var install_link = document.getElementById('firefox-install');
		install_link.parentNode.removeChild(install_link);

		var install_note = document.getElementById('install-note');
		install_note.parentNode.removeChild(install_note);

	} else {

		// replace locale switcher link with span
		var anchor = document.getElementById('install-locale-switcher');
		var span = document.createElement('span');
		for (var i = 0; i < anchor.childNodes.length; i++) {
			span.appendChild(anchor.childNodes[i]);
		}
		anchor.parentNode.replaceChild(span, anchor);

		// replace language install link with span
		var anchor = document.getElementById('install-language');
		var span = document.createElement('span');
		for (var i = 0; i < anchor.childNodes.length; i++) {
			span.appendChild(anchor.childNodes[i]);
		}
		anchor.parentNode.replaceChild(span, anchor);

		// remove the locale install note
		var lang_note = document.getElementById('lang-install-note');
		lang_note.parentNode.removeChild(lang_note);

	}
}

$(document).ready(init_content);
