<?php



switch($pageid) {
    default:
    case 'firefoxflicks':
        $folder = '';
        $body_id = 'firefoxflicks';
        break;
    case 'firefoxflicks-brief':
        $folder = 'brief/';
        $body_id = 'firefoxflicks-brief';
        break;
    case 'firefoxflicks-faq':
        $folder = 'faq/';
        $body_id = 'firefoxflicks-faq';
        break;
}


// temporary include to parallelize webdev and l10n- webdev work on the project
require_once $config['file_root'].'/includes/l10n/firefoxflicks-helper.inc.php';

require_once $config['file_root'].'/includes/l10n/header-firefoxflicks.inc.php';

echo '    <section id="primary"><div class="container">';
require_once $config['file_root'].'/'.$lang.'/firefoxflicks/'.$folder.'content.inc.html';
echo '    </div></section>';

require_once $config['file_root'].'/includes/l10n/footer-firefoxflicks.inc.php';

