<?php

switch($pageid) {
    default:
    case 'firefoxflicks':
        $folder      = '';
        $body_id     = 'firefoxflicks';
        $return_home = '';
        break;
    case 'firefoxflicks-brief':
        $folder      = 'brief/';
        $body_id     = 'firefoxflicks-brief';
        $return_home = '<a href="../" class="home">' . ___('« Return Home') . '</a>';
        $link = array(
            0 => 'http://www.mozilla.org/en-US/firefox/brand/platform/',
            1 => 'http://www.mozilla.org/en-US/firefox/brand/',
            2 => 'mailto:firefoxflicks@mozilla.org',
            3 => 'http://popcornjs.org/',
        );
        break;
    case 'firefoxflicks-faq':
        $folder      = 'faq/';
        $body_id     = 'firefoxflicks-faq';
        $return_home = '<a href="../" class="home">' . ___('« Return Home') . '</a>';
        $link = array(
            0 => '../brief/',
            1 => 'mailto:firefoxflicks@mozilla.org',
            2 => 'http://mozilla.org/en-US/firefox/brand/',
            3 => 'http://www.mozilla.org/foundation/trademarks/policy.html',
            4 => 'http://search.creativecommons.org/',
            5 => 'http://en.wikipedia.org/wiki/Public_domain',
        );
        break;
}


// temporary include to parallelize webdev and l10n-webdev work on the project
require_once $config['file_root'] . '/includes/l10n/firefoxflicks-helper.inc.php';

require_once $config['file_root'] . '/includes/l10n/header-firefoxflicks.inc.php';

echo '    <section id="primary"><div class="container">';
echo $return_home;
require_once $config['file_root'] . '/' . $lang . '/firefoxflicks/' . $folder . 'content.inc.html';
echo '    </div></section>';

require_once $config['file_root'] . '/includes/l10n/footer-firefoxflicks.inc.php';

