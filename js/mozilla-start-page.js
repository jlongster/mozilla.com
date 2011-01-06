YAHOO.util.Event.onDOMReady(function()
{
	Mozilla.StartPage();
});

// create namespace
if (typeof Mozilla == 'undefined') {
	var Mozilla = {};
}

/**
 * Selects and displays a random feature on the Firefox firstrun page
 *
 * If a specific feature is specified in a cookie named 'partner', it is always
 * displayed.
 */
(function() {
	var M = Mozilla;
	var Cookie = YAHOO.util.Cookie;

	M.StartPage = function()
	{
		var feature = M.StartPage.getFeature();
		var feature_element = document.getElementById('customize_' + feature);
		feature_element.style.display = 'block';
	}

	M.StartPage.features = [
		'ebay',
		'foxmarks',
		'foxytunes',
		'stumbleupon',
		'cooliris',
		'linkedin',
		'forecastfox',
		'downloadday'
	];

	M.StartPage.getFeature = function()
	{
		var feature = 'default';

		// get feature from partner cookie
		var partner_feature = Cookie.get('partner');
		if (partner_feature) {
			for (var i = 0; i < M.StartPage.features.length; i++) {
				if (partner_feature == M.StartPage.features[i]) {
					feature = partner_feature;
					break;
				}
			}
		}

		return feature;
	}
})();
