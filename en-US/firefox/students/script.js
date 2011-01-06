/**
    Bubbles up persona event to tell Firefox to load a persona
**/
function dispatchPersonaEvent(aType, aNode) 
{
    var aliases = {'PreviewPersona': 'PreviewBrowserTheme',
                   'ResetPersona': 'ResetBrowserThemePreview',
                   'SelectPersona': 'InstallBrowserTheme'};
    try {
        if (!aNode.hasAttribute("persona"))
			return;	
		
    $(aNode).attr("data-browsertheme", $(aNode).attr("persona")); 

    var aliasEvent = aliases[aType];
    var events = [aType, aliasEvent];

    for(var i=0; i<events.length; i++) {
      var event = events[i];
      var eventObject = document.createEvent("Events");
      eventObject.initEvent(event, true, false);
      aNode.dispatchEvent(eventObject);
    }
    } catch(e) {}
}

/**
    Binds click and hover events to the element.
    Click - bubbles up ResetPersona event
    Mouseenter - bubbles up PreviewPersona
    Mouseleave - bubbles up ResetPersona
**/
$.fn.previewPersona = function(resetOnClick) {
    
    if(resetOnClick) {
        jQuery(this).click(function(event) {
            dispatchPersonaEvent('ResetPersona', event.originalTarget);
        });
    }
    
    jQuery(this).hover(
        function(event) {
            dispatchPersonaEvent('PreviewPersona', event.originalTarget);
        },
        function(event) {
            dispatchPersonaEvent('ResetPersona', event.originalTarget);
        }
    );
};

