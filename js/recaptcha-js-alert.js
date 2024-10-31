setTimeout(function() {
	if (document.getElementsByClassName('g-recaptcha-response').length == 0)
		document.getElementById('recaptcha_js_alert_box').style.display = 'inline-block';
	}, delay);
