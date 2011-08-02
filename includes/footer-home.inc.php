<?php

$extra_footers = empty($extra_footers) ? '' : $extra_footers;

// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";

?>

    </div><!-- end #doc -->
    </div><!-- end #wrapper -->

    <!-- end #footer -->
    <?=$extra_footers?>
    <?=$stats_js?>

    <script>
    // <![CDATA[

    // Firefox 3.x update notice. Only show for Firefox 3.x, don't show for
    // cousins that say they are Firefox 3.x.
    var isOldVersion = (navigator.userAgent &&
        navigator.userAgent.indexOf('Firefox/3.') !== -1 &&
        navigator.userAgent.indexOf('Camino') === -1 &&
        navigator.userAgent.indexOf('SeaMonkey') === -1);

    isOldVersion = true;

    if (isOldVersion) {
        var oldOnload = window.onload;
        window.onload = function() {
            var script = document.createElement('script');
            script.src = '<?php echo $config['static_prefix']; ?>/js/update-v3.js';
            document.body.appendChild(script);
            if (typeof oldOnload == 'function') {
                oldOnload();
            }
        }
    }

    // ]]>
    </script>

</body>
</html>

