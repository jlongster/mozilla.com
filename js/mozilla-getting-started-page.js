$(document).ready(function() {
	$('<div id="overlay" />').appendTo('body');

	$('#features > li > a')
		.click(function(e) {
			e.preventDefault();
			$('#overlay')
				.css('display', 'block')
				.css('height', $(document).height() + 'px');

			var width = $('#overlay-' + this.id).width();
			var height = $('#overlay-' + this.id).height();
			var docWidth = $(document).width();
			var viewHeight = $(window).height();

			$('#overlay-' + this.id)
				.appendTo('body')
				.css('display', 'block')
				.css('top', ((viewHeight - height) / 2) + 'px')
				.css('left', ((docWidth - width) / 2) + 'px')
		});

	$('#features > li')
		.hover(function() {
			var id = $('a', this)[0].id;
			$('#screenshot > div')
				.addClass('screenshot-overlay-' + id);
		}, function () {
			$('#screenshot > div')
				.removeClass();
		});

	$('#overlay,.overlay-box > div > .close').click(function(e) {
		e.preventDefault();
		$('.overlay-box').each(function() {
			$(this).css('display', 'none');
		});
		$('#overlay').css('display', 'none');
		$('video').each(function() {
			if (typeof this.pause != 'undefined') {
				this.pause();
			}
		});
	});

});
