/* 
 * Home page survey for Firefox users in en-US
 * bug 620501
 */

$(document).ready(function() {


var surveyId = 'survey201012';
var surveyUrl = 'http://www.surveygizmo.com/s3/438545/f3795538bac9';
var freq = 0.05;
var cookieName = surveyId;
var cookieDays = 7;

function setCookie(name, value, path, expire)
{
	if (expire) {
		var expdate = new Date();
		expdate.setDate(expdate.getDate() + expire);
		expire = ';expires=' + expdate.toUTCString();
	} else {
		expire = '';
	}

	if (path) {
		path = ';path=' + path;
	} else {
		path = '';
	}

	document.cookie = name + '=' + escape(value) + expire + path;
}

function getCookie(name)
{
	if (document.cookie.length === 0) {
		return null;
	}

	var start = document.cookie.indexOf(name + '=');

	if (start === -1) {
		return null;
	}

	start += name.length + 1;
	end    = document.cookie.indexOf(';', start);
	if (end === -1) {
		end = document.cookie.length;
	}

	return unescape(document.cookie.substring(start, end));
}

if (getCookie(cookieName) === null) {
	var survey = (Math.floor(Math.random() / freq) == 0) ? '1' : '0';
	setCookie(cookieName, survey, '/', cookieDays);
}

if (getCookie(cookieName) == '1' && $('#k_close_button').length == 0) {
	var height = Math.max($(document).height(), $(window).height());

	var $overlay = $('<div id="' + surveyId + '_overlay">')
		.css('position', 'absolute')
		.css('background', '#fff')
		.css('opacity', '0.60')
		.css('top', '0')
		.css('left', '0')
		.css('width', '100%')
		.css('height', height + 'px')
		.css('zIndex', '1000')
		.appendTo($('body'));

	var $lightBox = $('<div id="' + surveyId + '_box">')
		.css('background', '#e3e2e0')
		.css('padding', '10px')
		.css('border', '1px solid #777')
		.css('position', 'absolute')
		.css('width', '660px')
		.css('height', '720px')
		.css('top', '30px')
		.css('left', '50%')
		.css('marginLeft', '-350px')
		.css('zIndex', '1001')
		.css('overflow', 'hidden')
		.css('boxShadow', '0 5px 50px rgba(0,0,0,0.8)')
		.css('MozBoxShadow', '0 5px 50px rgba(0,0,0,0.8)')
		.css('WebkitBoxShadow', '0 5px 40px rgba(0,0,0,0.6)')
		.css('borderRadius', '8px')
		.css('MozBorderRadius', '8px')
		.css('WebkitBorderRadius', '8px')
		.appendTo($('body'));

	var $closeLink = $('<a href="#close">Close</a>')
		.css('display', 'block')
		.css('float', 'right')
		.css('padding', '8px 48px 10px 20px')
		.css('background', 'url("/img/tignish/firefox/video-close.png") no-repeat 100% 0')
		.click(function(e) {
			e.preventDefault();
			setCookie(cookieName, '0', '/', cookieDays);
			$lightBox.css('display', 'none');
			$overlay.css('display', 'none');
		})
		.appendTo($lightBox);

	var $iframe = $('<iframe '
		+ 'name="' + surveyId + '_iframe" '
		+ 'id="' + surveyId + '_iframe" '
		+ 'frameBorder="0" '
                + 'src="' + surveyUrl + '" '
		+ '></iframe>')
		.css('background', '#ffffff')
		.css('width', '100%')
		.css('height', '100%')
		.css('border', 'none')
		.css('clear', 'right')
		.appendTo($lightBox);


}

});

