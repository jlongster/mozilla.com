<?php

$body_id = 'report_opportunities';

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';
// common content across State of Mozilla pages
require_once $config['file_root'].'/includes/l10n/state-2010-commoncontent.inc.php';

$navigation = <<<NAV

{$return_top}
<ul class="nav-paging bottom">
    <li class="prev"><a href="/{$lang}/foundation/annualreport/2010/">{$l10n->get('Welcome')}</a></li>
    <li class="next"><a href="/{$lang}/foundation/annualreport/2010/people/">{$l10n->get('People')}</a></li>
</ul>

NAV;

require_once $config['file_root'].'/includes/l10n/header-annual-report-2010.inc.php';
require_once $config['file_root'].'/'.$lang.'/foundation/annualreport/2010/opportunities/content.inc.html';
require_once $config['file_root'].'/includes/l10n/footer-annual-report-2010.inc.php';
