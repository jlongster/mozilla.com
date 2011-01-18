$(document).ready(function() {

	var opened = (function() {
		var ul = $('#email-form ul');
		return ul.hasClass('error');
	})();

	function scrollTo(id, time)
	{
		$('html, body')
			.animate(
				{ scrollTop: $(id).offset().top }, time
			);
	}

	function open()
	{
		if (!opened) {
			scrollTo('#email-form', 500);
			$('#whatsnew #newsletter').css('height', 'auto');
			$('#form-pane').fadeIn();
			$('#form-pane select[name=country]').focus();

			opened = true;
		}
	}

	$('#email-form').submit(function(e) {
		if (!opened) {
			e.preventDefault();
			open();
		}
	});

	$('#email-open').click(function(e) {
		e.preventDefault();

		if (!opened) {
			$(this).addClass('opened');
			var uri = $(this).attr('data-wt_uri');
			var ti = $(this).attr('data-wt_ti');
			dcsMultiTrack('DCS.dcsuri', uri, 'WT.ti', ti);
		}

		open();
	});
});
