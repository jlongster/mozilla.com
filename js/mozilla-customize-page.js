/**
 * Initializes pagers on this page after the document has been loaded
 */
YAHOO.util.Event.onDOMReady(function ()
{
	if (Mozilla.hasPersonas) {
		var iframe = document.createElement('iframe');
		iframe.setAttribute('src', Mozilla.PersonaPreviewer.LIVE_URL);
		iframe.setAttribute('id', 'persona-preview-frame');
		iframe.setAttribute('width', '100%');
		iframe.setAttribute('height', '180');

		var previewers = YAHOO.util.Dom.getElementsByClassName(
			'persona-previewer');

		if (previewers.length > 0) {
			var previewer = previewers[0];
			previewer.parentNode.replaceChild(iframe, previewer);
		}

		YAHOO.util.Dom.addClass('try-on', 'fx36');
		YAHOO.util.Dom.addClass('see-all-personas', 'fx36');

	} else {
		var previewers = YAHOO.util.Dom.getElementsByClassName(
			'persona-previewer');

		for (var i = 0; i < previewers.length; i++) {
			new Mozilla.PersonaPreviewer(previewers[i]);
		}
	}
});

// create namespace
if (typeof Mozilla == 'undefined') {
	var Mozilla = {};
}

Mozilla.hasPersonas = (function() {
	var hasPersonas = false;

	var matches = navigator.userAgent.match(
		/Gecko\/[0-9]+ .*(Firefox|Namoroka|Minefield)\/([0-9]+\.[0-9]+)/
	);

	if (matches !== null) {
		hasPersonas = (parseFloat(matches[2]) >= 3.6);
	}

	return hasPersonas;
})();

/**
 * Persona previewer widget
 *
 * @param DOMElement container
 */
Mozilla.PersonaPreviewer = function(container)
{
	this.container = container;

	if (!this.container.id) {
		YAHOO.util.Dom.generateId(this.container, 'mozilla-persona-previewer-');
	}

	var pager_content_nodes = YAHOO.util.Dom.getElementsByClassName(
		'persona-previewer-content', 'div', this.container);

	this.id             = this.container.id;
	this.page_container = pager_content_nodes[0];
	this.pages_by_id    = {};
	this.pages          = [];
	this.previous_page  = null;
	this.current_page   = null;
	this.in_animation   = null;
	this.out_animation  = null;

	this.random_start_page = (YAHOO.util.Dom.hasClass(
		this.container, 'persona-previewer-random'));

	var pager_tab_nodes = YAHOO.util.Dom.getElementsByClassName(
		'persona-previewer-tabs', 'ul', this.container);

	this.tabs = pager_tab_nodes[0];

	// add pages
	var page_nodes = YAHOO.util.Dom.getChildrenBy(this.page_container,
		function (n) { return (n.nodeName == 'DIV'); });

	// initialize pages with tabs
	var tab_nodes = YAHOO.util.Dom.getChildren(this.tabs);
	var index = 0;
	for (var i = 0; i < page_nodes.length; i++) {
		if (i < tab_nodes.length) {
			var tab_node = YAHOO.util.Dom.getFirstChildBy(tab_nodes[i],
				function(n) { return (n.nodeName == 'A'); });

			if (tab_node) {
				this.addPersona(new Mozilla.Persona(page_nodes[i], index,
					tab_node));

				index++;
			}
		}
	}

	// initialize current page
	var current_page = null;

	if (this.pages.length > 0) {
		if (this.random_start_page) {
			this.setPersona(this.getPseudoRandomPersona());
		} else {
			var def_page = YAHOO.util.Dom.getFirstChildBy(this.page_container,
				function(n){return YAHOO.util.Dom.hasClass(n, 'default-page')});

			if (def_page) {
				var def_id;
				if (def_page.id.substring(0, 5) == 'page-') {
					def_id = def_page.id.substring(5);
				} else {
					def_id = def_page.id;
				}
				this.setPersona(this.pages_by_id[def_id]);
			} else {
				this.setPersona(this.pages[0]);
			}
		}
	}
}

Mozilla.PersonaPreviewer.LIVE_URL =
	'http://www.getpersonas.com/en-US/external/mozilla/';

Mozilla.PersonaPreviewer.prototype.getPseudoRandomPersona = function()
{
	var page = null;

	if (this.pages.length > 0) {
		var now = new Date();
		page = this.pages[now.getSeconds() % this.pages.length];
	}

	return page;
}

Mozilla.PersonaPreviewer.PAGE_DURATION     = 0.15; // seconds

Mozilla.PersonaPreviewer.prototype.prevPersonaWithAnimation = function()
{
	var index = this.current_page.index - 1;
	if (index < 0) {
		index = this.pages.length - 1;
	}

	this.setPersonaWithAnimation(this.pages[index]);
}

Mozilla.PersonaPreviewer.prototype.nextPersonaWithAnimation = function()
{
	var index = this.current_page.index + 1;
	if (index >= this.pages.length) {
		index = 0;
	}

	this.setPersonaWithAnimation(this.pages[index]);
}

Mozilla.PersonaPreviewer.prototype.addPersona = function(page)
{
	this.pages_by_id[page.id] = page;
	this.pages.push(page);
	if (page.tab) {
		YAHOO.util.Event.on(page.tab, 'mouseover',
			function (e)
			{
				YAHOO.util.Event.preventDefault(e);
				this.setPersonaWithAnimation(page);
			},
			this, true);
	}
}

Mozilla.PersonaPreviewer.prototype.update = function()
{
	if (this.tabs) {
		this.updateTabs();
	}
}

Mozilla.PersonaPreviewer.prototype.updateTabs = function()
{
	var class_name = this.tabs.className;
	class_name = class_name.replace(/pager-selected-[\w-]+/g, '');
	class_name = class_name.replace(/^\s+|\s+$/g,'');
	this.tabs.className = class_name;

	this.current_page.selectTab();
	YAHOO.util.Dom.addClass(this.tabs,
		'pager-selected-' + this.current_page.id);
}

Mozilla.PersonaPreviewer.prototype.setPersona = function(page)
{
	if (this.current_page !== page) {
		if (this.current_page) {
			this.current_page.deselectTab();
			this.current_page.hide();
		}

		if (this.previous_page) {
			this.previous_page.hide();
		}

		this.previous_page = this.current_page;

		this.current_page = page;
		this.current_page.show();
		this.update();
	}
}

Mozilla.PersonaPreviewer.prototype.setPersonaWithAnimation = function(page)
{
	if (this.current_page !== page) {

		// deselect last selected page (not necessarily previous page)
		if (this.current_page) {
			this.current_page.deselectTab();
		}

		// start opacity at current opacity if page was changed while another
		// page was fading in
		if (this.in_animation && this.in_animation.isAnimated()) {
			var start_opacity = parseFloat(YAHOO.util.Dom.getStyle(
				this.page_container, 'opacity'));

			this.in_animation.stop(false);
		} else {
			var start_opacity = 1.0;
		}

		// fade out if we're not already fading out
		if (!this.out_animation || !this.out_animation.isAnimated()) {
			// only set previous page if we are not already fading out
			this.previous_page = this.current_page;

			this.out_animation = new YAHOO.util.Anim(this.page_container,
				{ opacity: { from: start_opacity, to: 0 } },
				Mozilla.PersonaPreviewer.PAGE_DURATION, YAHOO.util.Easing.easeOut);

			this.out_animation.onComplete.subscribe(this.fadeInPersona,
				this, true);

			this.out_animation.animate();
		}

		// always set current page
		this.current_page = page;
		this.update();
	}

	// for Safari 1.5.x bug setting window.location.
	return false;
}

Mozilla.PersonaPreviewer.prototype.fadeInPersona = function()
{
	if (this.previous_page) {
		this.previous_page.hide();
	}

	this.current_page.show();

	this.in_animation = new YAHOO.util.Anim(this.page_container,
		{ opacity: { from: 0, to: 1 } }, Mozilla.PersonaPreviewer.PAGE_DURATION,
		YAHOO.util.Easing.easeIn);

	this.in_animation.animate();
}

/**
 * @param DOMElement element
 * @param DOMElement tab_element
 */
Mozilla.Persona = function(element, index, tab_element)
{
	this.element = element;

	if (!this.element.id) {
		YAHOO.util.Dom.generateId(this.element,
			'mozilla-persona-previewer-persona-');
	}

	this.element.id = 'page-' + this.id;
	this.index      = index;

	if (tab_element) {
		this.tab = tab_element;
	} else {
		this.tab = null;
	}

	this.hide();
}

Mozilla.Persona.prototype.selectTab = function()
{
	if (this.tab) {
		YAHOO.util.Dom.addClass(this.tab, 'selected');
	}
}

Mozilla.Persona.prototype.deselectTab = function()
{
	if (this.tab) {
		YAHOO.util.Dom.removeClass(this.tab, 'selected');
	}
}

Mozilla.Persona.prototype.focusTab = function()
{
	if (this.tab) {
		this.tab.focus();
	}
}

Mozilla.Persona.prototype.hide = function()
{
	this.element.style.display = 'none';
}

Mozilla.Persona.prototype.show = function()
{
	this.element.style.display = 'block';
}
