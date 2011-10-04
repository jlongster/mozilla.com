<?php

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';
// common content across State of Mozilla pages
require_once $config['file_root'].'/includes/l10n/state-2010-commoncontent.inc.php';

$body_id    = 'report_faq';
$page_title = strip_tags(___('The State of Mozilla <span>Annual Report</span>')) . ' - ' . ___('FAQ');
$i = 1; // initialize counter for anchors

$link = array(
    1  => 'http://static.mozilla.com/moco/en-US/pdf/Mozilla%20Foundation%20and%20Subsidiaries%202010%20Audited%20Financial%20Statement.pdf',
);
$navigation = <<<NAV

{$return_top}

            <div class="content-block pdf">
                <div>
                    {$l10n->get('2010 Audited Financial Statement')}<br/>
                    <a href="{$link[1]}" class="button">{$l10n->get('Download PDF')}</a>
                </div>

                <div>
                    {$l10n->get('2010 Form 990')}<br/>
                    <a href="" class="button">{$l10n->get('Download PDF')}</a>
                </div>
            </div>
<ul class="nav-paging bottom">
    <li class="prev"><a href="/{$lang}/foundation/annualreport/2010/ahead/">{$l10n->get('Ahead')}</a></li>
</ul>
NAV;

require_once $config['file_root'].'/includes/l10n/header-annual-report-2010.inc.php';
?>
        <div id="content">

            <div class="content-block">
                <div class="img-right">
                    <img src="<?=$config['static_prefix']?>/img/covehead/annualreport/photo-not-every-venture.jpg" width="297" height="396" alt="<?=___('Mozilla Firefox billboard, San Francisco');?>" />
                    <p><?=___('Mozilla Firefox billboard, San Francisco');?></p>
                </div>
<?php
require_once $config['file_root'].'/'.$lang.'/foundation/annualreport/2010/faq/content.inc.html';
echo "\n</div>\n";
echo "\n</div>\n";
require_once $config['file_root'].'/includes/l10n/footer-annual-report-2010.inc.php';
