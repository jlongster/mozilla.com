/**
 * Initializes main menu on this page after the document has been loaded
 */
YAHOO.util.Event.onDOMReady(function ()
{
    var mozilla_menu_bar = new YAHOO.widget.MenuBar('nav-main', {
        autosubmenudisplay:   true,
        hidedelay:            750,
        iframe:               false,
        lazyload:             true,
		monitorresize:        false,
		appendtodocumentbody: true
	});

    mozilla_menu_bar.render();
});
