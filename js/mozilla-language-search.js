// create namespace
if (typeof Mozilla == 'undefined') {
	var Mozilla = {};
}

Mozilla.LanguageSearch = function(input, results_container, data, version)
{
	this.data = data;

	YAHOO.util.Event.onDOMReady(function () {
		this.init(input, results_container);
	}, this, true);

	this.old_keywords = null;
	this.timer = null;
	this.version = version;
}

/**
 * Time in ms before search is performed after keywords are changed
 *
 * @var NUmber
 */
Mozilla.LanguageSearch.timeout_period = 50;

Mozilla.LanguageSearch.max_results = 10;

Mozilla.LanguageSearch.no_results_text = 'No matching languages found.';
Mozilla.LanguageSearch.download_text = 'download';

Mozilla.LanguageSearch.prototype.init = function(input, results_container)
{
	if ((typeof input).toLowerCase() == 'string') {
		input = YAHOO.util.Dom.get(input);
	}

	input.setAttribute('autocomplete', 'off');

	if ((typeof results_container).toLowerCase() == 'string') {
		results_container = YAHOO.util.Dom.get(results_container);
	}

	// setup key event handlers
	YAHOO.util.Event.on(input, 'keyup', this.handleKeywordsChange,
		this, true);

	YAHOO.util.Event.on(input, 'blur', this.handleKeywordsChange,
		this, true);

	// set up results container
	this.results_container = document.createElement('div');
	this.results_container.className = 'results';
	results_container.appendChild(this.results_container);

	// perform initial search
	this.value = input.value;
	this.search();
}

Mozilla.LanguageSearch.prototype.handleKeywordsChange = function(e)
{
	var target = YAHOO.util.Event.getTarget(e);
	var value = target.value.replace(/^\s+|\s+$/g, ''); // trim whitespace

	// if value changed
	if (value != this.value) {
		if (this.timer != null) {
			clearTimeout(this.timer);
		}

		// timeout for search to occur
		var that = this;
		this.timer = setTimeout(function() {
			that.search();
		}, Mozilla.LanguageSearch.timeout_period)

		this.value = value;
	}
}

Mozilla.LanguageSearch.prototype.search = function()
{
	var languages = this._searchLanguage(this.value);

	this._clearResults(this.results_container);

	if (languages.length > 0) {
		for (var i = 0; i < languages.length; i++) {
			this._drawResult(this.results_container, languages[i]);
		}
	} else if (this.value.length > 0) {
		this._drawNoResults(this.results_container);
	}
}

Mozilla.LanguageSearch.prototype._searchLanguage = function(keywords)
{
	var languages = [];

	if (keywords.length == 0) {
		return languages;
	}

	keywords = keywords.replace('\\', '\\\\').replace('/', '\\/');
	var search = new RegExp('(?:^' + keywords + '|[ (]' + keywords + ')', 'i');

	var i = 0;
	while (i < this.data.length
		&& languages.length < Mozilla.LanguageSearch.max_results
	) {
		// check both the english and native versions
		if (   search.test(this.data[i][1])
			|| search.test(this.data[i][2])
		) {
			languages.push(this.data[i]);
		}

		i++;
	}

	return languages;
}

Mozilla.LanguageSearch.prototype._clearResults = function(container)
{
	while (container.firstChild) {
		container.removeChild(container.firstChild);
	}
}

Mozilla.LanguageSearch.prototype._drawNoResults = function(container)
{
	var header = document.createElement('h4');
	header.className = 'no-results';
	header.appendChild(document.createTextNode(
		Mozilla.LanguageSearch.no_results_text));

	var result_div = document.createElement('div');
	result_div.className = 'result';
	result_div.appendChild(header);

	container.appendChild(result_div);
}

Mozilla.LanguageSearch.prototype._drawResult = function(container, language)
{
	var header = document.createElement('h4');

	var span = document.createElement('span');
	span.className = 'lang';
	span.appendChild(document.createTextNode(language[1]));
	header.appendChild(span);

	if (language[1] != language[2]) {
		var span = document.createElement('span');
		span.className = 'lang-native';
		span.appendChild(document.createTextNode(language[2]));
		header.appendChild(document.createTextNode(' '));
		header.appendChild(span);
	}

	var build_list = document.createElement('ul');

	var platforms = [
		[ 'win',   'Windows' ],
		[ 'osx',   'OS X' ],
		[ 'linux', 'Linux' ]
	];

	var beta = false;

	for (var i = 0; i < platforms.length; i++) {
		if (language[3][platforms[i][1]]) {
			var anchor = document.createElement('a');
			anchor.className = this._getPlatformClassName(platforms[i][0]);

			if (language[3][platforms[i][1]]['filesize']) {
				anchor.title = language[3][platforms[i][1]]['filesize'] +
					'M ' + Mozilla.LanguageSearch.download_text;
			}

			if (language[3][platforms[i][1]]['beta']) {
				beta = true;
			}

			anchor.href = this._getPlatformHref(language, platforms[i][0]);
			anchor.appendChild(document.createTextNode(platforms[i][1]));

			var build = document.createElement('li');
			build.appendChild(anchor);

			build_list.appendChild(build);
		}
	}

	var result_div = document.createElement('div');
	result_div.className = 'result';
	if (beta) {
		result_div.className += ' beta';
	}
	result_div.appendChild(header);
	result_div.appendChild(build_list);

	container.appendChild(result_div);
}

Mozilla.LanguageSearch.prototype._getPlatformHref = function(language, platform)
{
	// special case for Japanese Mac OS X version
	var lang;
	if (language[0] == 'ja' && platform == 'osx') {
		lang = 'ja-JP-mac';
	} else {
		lang = language[0];
	}

	var href = 'http://download.mozilla.org/?product=firefox-' + this.version +
		'&os=' + platform + '&lang=' + lang;

	return href;
}

Mozilla.LanguageSearch.prototype._getPlatformClassName = function(platform)
{
	switch (platform) {
	case 'osx':
		return 'osx-uni';
		break;

	case 'linux':
		return 'linux';
		break;

	case 'win':
	default:
		return 'windows';
		break;
	}
};
