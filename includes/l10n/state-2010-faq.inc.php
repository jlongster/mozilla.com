<?php

$body_id = 'report_faq';

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';
// common content across State of Mozilla pages
require_once $config['file_root'].'/includes/l10n/state-2010-commoncontent.inc.php';

$navigation = <<<NAV

{$return_top}
<ul class="nav-paging bottom">
    <li class="prev"><a href="/{$lang}/foundation/annualreport/2010/ahead/">{$l10n->get('Ahead')}</a></li>
</ul>
NAV;

require_once $config['file_root'].'/includes/l10n/header-annual-report-2010.inc.php';
echo "\n<div id=\"content\">\n";
require_once $config['file_root'].'/'.$lang.'/foundation/annualreport/2010/faq/content.inc.html';
echo "\n</div>\n";
require_once $config['file_root'].'/includes/l10n/footer-annual-report-2010.inc.php';
