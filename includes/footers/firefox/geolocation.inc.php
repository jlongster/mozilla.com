<?php

/**
 * Extra HTML footer content for the "Geolocation" page
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

$extra_footers = <<<EXTRA_FOOTERS
<script src="/js/jquery/jquery.min.js"></script>
<script src="/js/jquery/jquery.nyroModal.pack.js"></script>
<script src="/js/mozilla-expanders.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key={$config['gmap_api_key']}"></script>
<script src="/js/geolocation-demo.js"></script>
<script>// <![CDATA[
$(document).ready(function() {
    if (!navigator.geolocation) return true; // Fx 3.5+ only
    $('#try-geolocation')
        .nyroModal({
            minWidth: 510,
            minHeight: 400,
            processHandler: function() {
                $('#geodemo-error, #geo-busy').hide();
            },
            endShowContent: function() {
                geodemo.initialize();
            }
        })
        .show();
    $('#locateButton').click(function() {
        geodemo.locateMeOnMap();
    });
});
// ]]></script>
EXTRA_FOOTERS;

?>
