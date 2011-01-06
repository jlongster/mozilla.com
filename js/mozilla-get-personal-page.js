YAHOO.util.Event.onDOMReady(function()
{
	Mozilla.GetPersonalPage();
});

// create namespace
if (typeof Mozilla == 'undefined') {
	function Mozilla() {}
}

/**
 * Selects and displays a random feature on the Firefox firstrun page
 *
 * If a specific feature is specified in the URL query string, it is always
 * displayed.
 */
(function() {
	var M = Mozilla;

	M.GetPersonalPage = function()
	{
		var containers =
			YAHOO.util.Dom.getElementsByClassName('item-container');

		var items = [];
		var map = [];
		for (var i = 0; i < containers.length; i++) {
			map[i] = i;
			items[i] = YAHOO.util.Dom.getFirstChild(containers[i]);
		}

		var index = null;
		for (var i = 0; i < map.length; i++) {
			index = Math.floor(Math.random() * (map.length - i)) + i;
			_swap(map, i, index);
		}

		for (var i = 0; i < map.length; i++) {
			containers[i].appendChild(items[map[i]]);
		}
	}

	function _swap(map, a, b)
	{
		var c = map[a];
		map[a] = map[b];
		map[b] = c;
	}
})();
