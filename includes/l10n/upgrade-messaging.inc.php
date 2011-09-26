<?php

// Persistent Upgrade messaging, only display if it is translated
$needed = array(
    'v3UpdateHeading'
        => 'Update now',
    'v3UpdateP1'
        => 'You need an upgrade! Stay safe in less than a minute. <br/> Start using your new Firefox for the best in browsing and customization on the Web. <br/>   It’s fast and free!',
    'v3UpdateP2'
        => 'Upgrade now',
    'v3CloseText'
        => 'Close',
);

$display_upgrade_warning = true;

if(!in_array($lang, array('en-US', 'en-GB', 'en-ZA'))) {

    $persistent_strings  = "\n        var v3UpdateLink = '/firefox/new/';\n";
    $persistent_strings .= "        var v3UpdateLearnLink = '/firefox/features/';\n";

    foreach($needed as $key => $val) {

        if($key == 'v3UpdateP2') {
            $persistent_strings .= "        var $key = '<a href=\'%s\' class=\"button\">" . addslashes(___($val)) . "</a> <span><a href=\'%s\'>" . addslashes(___('Learn More')) . "</a>.</span>';\n";
            continue;
        }

        $persistent_strings .= "        var $key = '" . addslashes(___($val)) . "';\n";

        if(i__($val) == false) {
            $display_upgrade_warning = false;
            break;
        }
    }
} else {
    $persistent_strings = '';
}

$upgrade_warning = <<<UPGRADE
    <script>
    // <![CDATA[

    // Firefox 3.x update notice. Only show for Firefox 3.x, don't show for
    // cousins that say they are Firefox 3.x.
    var isOldVersion = (navigator.userAgent &&
        navigator.userAgent.indexOf('Firefox/3.') !== -1 &&
        navigator.userAgent.indexOf('Camino') === -1 &&
        navigator.userAgent.indexOf('SeaMonkey') === -1);

    if (isOldVersion) {
        var oldOnload = window.onload;

{$persistent_strings}

        window.onload = function() {

            // dynamically include stylesheet shared by all locales, including en-US
            var cssNode   = document.createElement('link');
            cssNode.type  = 'text/css';
            cssNode.rel   = 'stylesheet';
            cssNode.href  = '{$config['static_prefix']}/style/oldfirefoxupdate.css';
            cssNode.media = 'screen';
            document.getElementsByTagName("head")[0].appendChild(cssNode);

            // dynamically include javascript file shared by all locales, including en-US
            var script = document.createElement('script');
            script.src = '{$config['static_prefix']}/js/update-v3.js';
            document.body.appendChild(script);

            if (typeof oldOnload == 'function') {
                oldOnload();
            }
        }
    }

    // ]]>
    </script>
UPGRADE;

if($display_upgrade_warning == false) {
        $upgrade_warning = '';
}

