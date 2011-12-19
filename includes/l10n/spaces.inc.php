<?php

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';

$body_id    = 'spaces';
$page_title = strip_tags(___('Mozilla Spaces'));

// Email form setup
require_once "{$config['file_root']}/includes/regions.php";
require_once "{$config['file_root']}/includes/email/prefs.php";

$form = new EmailPrefs($_POST);
$form->save_new();

$status = '';
if($form->submitted()) {
    if($form->has_any_errors()) {
        $status = 'error';
    }
    else {
        $status = 'success';
    }
}

$map = <<<MAP

<div id="region-map">
    <ul id="map-sites">
        <li id="site1">
            <span class="pin" title="Mountain View"></span>
            <div class="info" aria-hidden="true">
            <h3>Mountain View</h3>
            <dl>
                <dt>Address:</dt>
                <dd><address>
                650 Castro Street<br/>
                Suite 300<br/>
                Mountain View, California<br/>
                94041-2021<br/>
                USA
                </address></dd>
                <dt>E-mail:</dt>
                <dd><a href="mailto:mozspaces@mozilla.com">mozspaces@mozilla.com</a></dd>
            </dl>
            </div>
        </li>
        <li id="site2">
            <span class="pin" title="Auckland"></span>
            <div class="info" aria-hidden="true">
            <h3>Auckland</h3>
            <dl>
                <dt>Address:</dt>
                <dd><address>
                    Level 7<br/>
                    5 Short Street<br/>
                    Newmarket<br/>
                    Auckland 1023<br/>
                    New Zealand
                </address></dd>
                <dt>E-mail:</dt>
                <dd><a href="mailto:mozspaces@mozilla.com">mozspaces@mozilla.com</a></dd>
            </dl>
            <p>The first of our new spaces. We opened our doors in New Zealand in July 2012.</p>
            </div>
        </li>
        <li id="site3">
            <span class="pin" title="Beijing"></span>
            <div class="info" aria-hidden="true">
            <h3>Beijing</h3>
            <dl>
                <dt>Address:</dt>
                <dd><address>
                    Mozilla Online Ltd.<br/>
                    International Club Office Tower 800A<br/>
                    21 Jian Guo Men Wai Avenue<br/>
                    Chaoyang District, Beijing 100020<br/>
                    China
                </address></dd>
                <dt>E-mail:</dt>
                <dd><a href="mailto:mozspaces@mozilla.com">mozspaces@mozilla.com</a></dd>
            </dl>
            </div>
        </li>
        <li id="site4">
            <span class="pin" title="Paris"></span>
            <div class="info" aria-hidden="true">
            <h3>Paris</h3>
            <dl>
                <dt>Address:</dt>
                <dd><address>
                    28 boulevard Poissonnière<br/>
                    75009 Paris<br/>
                    France
                </address></dd>
                <dt>E-mail:</dt>
                <dd><a href="mailto:mozspaces@mozilla.com">mozspaces@mozilla.com</a></dd>
            </dl>
            <p>The Paris space will be moving to a bigger location. Site visits are happening in Decemeber 2011 and we're targeting to open the new space in the second quarter of 2012.</p>
            </div>
        </li>
        <li id="site5">
            <span class="pin" title="San Francisco"></span>
            <div class="info" aria-hidden="true">
            <h3>San Francisco</h3>
            <dl>
                <dt>Address:</dt>
                <dd><address>
                    2 Harrison Street<br/>
                    San Francisco, California<br/>
                    94105<br/>
                    USA
                </address></dd>
                <dt>E-mail:</dt>
                <dd><a href="mailto:mozspaces@mozilla.com">mozspaces@mozilla.com</a></dd>
            </dl>
            <p>We are excited to announce that our new San Francisco space was launched in September 2012 right on the Embarcadero.</p>
            </div>
        </li>
        <li id="site6">
            <span class="pin" title="Tokyo"></span>
            <div class="info" aria-hidden="true">
            <h3>Tokyo</h3>
            <dl>
                <dt>Address:</dt>
                <dd><address>
                    Kojimachi GN Yasuda Bldg., 4F<br/>
                    3-6-5 Kojimachi, Chiyoda-ku<br/>
                    Tokyo, 102-0083<br/>
                    Japan
                </address></dd>
                <dt>E-mail:</dt>
                <dd><a href="mailto:mozspaces@mozilla.com">mozspaces@mozilla.com</a></dd>
            </dl>
            </div>
        </li>
        <li id="site7">
            <span class="pin" title="Toronto"></span>
            <div class="info" aria-hidden="true">
            <h3>Toronto</h3>
            <dl>
                <dt>Address:</dt>
                <dd><address>
                    366 Adelaide Street West<br/>
                    Suite 500<br/>
                    Toronto, Ontario<br/>
                    M5V 1R9<br/>
                    Canada
                </address></dd>
                <dt>E-mail:</dt>
                <dd><a href="mailto:mozspaces@mozilla.com">mozspaces@mozilla.com</a></dd>
            </dl>
            <p>August 2011 brought the launch of our new Mozilla Space in Toronto, complete with signature espresso machine.</p>
            </div>
        </li>
        <li id="site8">
            <span class="pin" title="Vancouver"></span>
            <div class="info" aria-hidden="true">
            <h3>Vancouver</h3>
            <dl>
                <dt>Address:</dt>
                <dd><address>
                    128 West Hastings Street<br/>
                    Suite 210<br/>
                    Vancouver, British Columbia<br/>
                    V6B 1G8<br/>
                    Canada
                </address></dd>
                <dt>E-mail:</dt>
                <dd><a href="mailto:mozspaces@mozilla.com">mozspaces@mozilla.com</a></dd>
            </dl>
            <p>We are in the process of revamping our Vancouver space. We’re staying in the same building, just expanding to incorporate a new community area that will launch early in 2012. Hope to see you there!</p>
            </div>
        </li>
        <li id="site9">
            <span class="pin" title="London"></span>
            <div class="info" aria-hidden="true">
            <h3>London</h3>
            <dl>
                <dt>Address:</dt>
                <dd><address>
                    101 St. Martins Lane<br/>
                    Suite 300<br/>
                    London<br/>
                    WC2<br/>
                    United Kingdom
                </address></dd>
                <dt>E-mail:</dt>
                <dd><a href="mailto:mozspaces@mozilla.com">mozspaces@mozilla.com</a></dd>
            </dl>
            <p>This space is currently under construction and coming along nicely. We’ll be opening our doors in January 2012.</p>
            </div>
        </li>
        <li id="site10">
            <span class="pin" title="Berlin"></span>
            <div class="info" aria-hidden="true">
            <h3>Berlin</h3>
            <dl>
                <dt>E-mail:</dt>
                <dd><a href="mailto:mozspaces@mozilla.com">mozspaces@mozilla.com</a></dd>
            </dl>
            <p>The search is under way! Stay tuned for updates on tours, building locations and construction kick-off. We’re targeting to open our doors in the second half of 2012.</p>
            </div>
        </li>
        <li id="site11">
            <span class="pin" title="Taipei"></span>
            <div class="info" aria-hidden="true">
            <h3>Taipei</h3>
            <dl>
                <dt>E-mail:</dt>
                <dd><a href="mailto:mozspaces@mozilla.com">mozspaces@mozilla.com</a></dd>
            </dl>
            <p>We’ll be launching our Taipei space in 2012. Stay tuned for more details.</p>
            </div>
        </li>
    </ul>
</div>

MAP;

$dynamic_header = <<<DYNAMIC_HEADER
<!DOCTYPE HTML>
<html lang="{$lang}" dir="{$textdir}">
<head>
    <meta charset="utf-8">
    <title>{$page_title}</title>

    <!--[if lte IE 9]>
    <script src="{$config['static_prefix']}/js/html5.js"></script>
    <![endif]-->

    <style>
    /* MetaWebPro font family licensed from fontshop.com. WOFF-FTW! */
    @font-face {
        font-family: 'MetaBlack';
        src: url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.eot');
        src: local('☺'), url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.woff') format('woff');
        font-weight: bold;
    }
    </style>

    <link href="{$config['static_prefix']}/includes/min/min.css?g=css" rel="stylesheet">
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/spaces.css" media="screen" />
    <script src="{$config['static_prefix']}/includes/min/min.js?g=js"></script>
    <script src="{$config['static_prefix']}/js/spaces.js"></script>

{$extra_headers}
</head>

<body id="{$body_id}" class="{$body_class} locale-{$lang}  {$textdir}">

<div id="wrapper">
{$extra_feature}
<div id="doc">

    <div id="nav-access">
        <a href="#nav-main">{$l10n->get('skip to Navigation')}</a>
        <a href="#switch">{$l10n->get('switch language')}</a>
    </div>

    <header id="branding">
        <div id="nav-mozilla">
            <a href="http://www.mozilla.org/" class="mozilla" title="Visit Mozilla.org">Mozilla</a>
        </div>
    </header>

    <section id="content-main">

DYNAMIC_HEADER;


echo $dynamic_header;
unset($dynamic_header);


echo "\n<div id=\"content\">\n";
require_once $config['file_root'].'/'.$lang.'/about/mozilla-spaces/content.inc.html';
echo "\n</div>\n";

$lang_list          = getLangLinksSelect(array( 'cs', 'de', 'en-US', 'es-ES', 'fr', 'gl', 'hu', 'it', 'ja', 'nl', 'pl', 'sl', 'sq', 'tr', 'zh-CN', 'zh-TW' ));
$lang_list          = str_replace(' (España)', '', $lang_list);
$lang_list          = str_replace(' (US)', '', $lang_list);
$current_year       = date('Y');
$extra_footers      = empty($extra_footers) ? '' : $extra_footers;
$extra_footer_links = empty($extra_footer_links) ? '' : $extra_footer_links;
$creative_commons   = sprintf(___('Except where otherwise <a href="%s">noted</a>, content on this site is licensed under the <br /><a href="%s">Creative Commons Attribution Share-Alike License v3.0</a> or any later version.'),"/$lang/about/legal.html#site", 'http://creativecommons.org/licenses/by-sa/3.0/');

// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";

$country = $form->get('country');
if (!$country) {
  $country = 'us';
}

if ($form->get('format') == 'text') {
    $text_checked = 'checked';
    $html_checked = '';
} else {
    $text_checked = '';
    $html_checked = 'checked';
}

if ($form->get('privacy')){
    $privacy_checked = 'checked';
} else {
    $privacy_checked = '';
}

?>

    </section><!-- end #content-main -->

    <section id="contact">
    <div id="newsletter-signup">

      <h3>Sign up for Mozilla Spaces updates</h3>
      <div id="newsletter-signup" class="newsletter-signup <?= $status ?>" id="newsletter">
        <div class="container">

          <form class="email-form inline-email-form"
                action="#subscribe-form"
                method="post"
                id="subscribe-form">
            <input type="hidden" name="moz-spaces" value="Y" />

            <ul class="<?= $status ?>">
              <li class="open-pane">
                <div class="email-field field">
                  <span class="error-wrapper <?= $form->has_error('email') ? 'field-error' : ''; ?>">
                    <input
                       id="email"
                       name="email"
                       type="email"
                       placeholder="Your Email Address"
                       value="<?= $form->get('email') ?>"
                       class="email">
                  </span>
                  <a id="expand" class="button email-open"
                     href="#subscribe-form"
                     onclick="dcsMultiTrack('DCS.dcssip', 'www.mozilla.org',
                              'DCS.dcsuri', '/mainstream_newsletter/step1', 
                              'WT.ti', 'Link: Monthly News - First Step',
                              'WT.dl', 99,
                              'WT.nv', 'Content',
                              'WT.ac', 'Newsletter');"><b>»</b></a>
                </div>
              </li>
              <li class="form-pane">
<?php
    if($form->has_non_field_error()) {
        echo '<ul class="non-field-errors field-errors"><li>' .
            $form->non_field_error .
        '</li></ul>';
    }

    if($form->has_error()) {
        echo '<ul class="field-errors">';

        foreach($form->errors as $error) {
            if($error == 'email') {
                echo '<li>Whoops! Be sure to enter a valid email address.</li>';
            }
            else if($error == 'country') {
                echo '<li>Please select a country.</li>';
            }
            else if($error == 'privacy') {
                echo '<li>Please read the Mozilla Privacy Policy and agree by checking the box.</li>';
            }
        }

        echo '</ul>';
    }
?>

          <div class="form-details">

            <div class="field country-field">
              <select class="country" name="country">
                <option value="">Select country</option>
                <?php
                   $country = $form->get('country');
                if (!$country) {
                $country = 'us';
                }
                echo regionsAsOptions($lang, $country);
                ?>
              </select>
            </div>

            <div class="field format-field">
              <?php
                 $html_format = 'checked="checked"';
                 $text_format = '';
                 if ($form->get('format') == 'text') {
              $text_format = 'checked="checked"';
              $html_format = '';
              }
              ?>
              <div class="field-radios">
                <label for="inline-html-format">
                  <input type="radio" name="format" class="html-format" id="inline-html-format" value="html" <?= $html_format?>>
                  HTML
                </label>
                <label for="inline-text-format">
                  <input type="radio" name="format" class="text-format" id="inline-text-format" value="text" <?= $text_format?>>
                  Text</label>
              </div>
            </div>

            <div class="privacy-field">
              <?php $checked = $form->get('privacy') ? 'checked="checked"' : '' ?>
              <label for="inline-privacy-check" class="privacy-check-label">
                <span class="error-wrapper <?= $form->has_error('privacy') ? 'field-error' : ''; ?>">
                   <input type="checkbox" class="privacy-check" id="inline-privacy-check" name="privacy" <?= $checked ?>>
                </span>
                I agree to the <a href="/en-US/privacy-policy">Privacy Policy</a>
              </label>
            </div>

            <input name="submit" type="submit" value="Sign me up!" class="button" id="subscribe"
                   onclick="dcsMultiTrack('DCS.dcssip', 'www.mozilla.org',
                            'DCS.dcsuri', '/about/mozilla-spaces',
                            'WT.ti', 'Link: Spaces Signup',
                            'WT.dl', 99,
                            'WT.nv', 'Content',
                            'WT.ac', 'Newsletter');">
            <p class="footnote">We will only send you Mozilla-related information.</p>
          </div>

        </li>
        <li class="success-pane">
          <div id="success-msg">Thanks for Subscribing!</div>
        </li>
      </ul>
    </form>
  </div>
</div>




    </div>

    <ul id="contact-links">
        <li><span>Email:</span> <a href="mailto:mozspaces@mozilla.com">mozspaces@mozilla.com</a></li>
        <li><span>Twitter:</span> <a href="http://twitter.com/MozillaSpaces">@MozillaSpaces</a></li>
        <li><span>IRC:</span> <a href="irc://irc.mozilla.org/MozillaSpaces">#MozillaSpaces</a></li>
    </ul>

    </section>

    <p id="extra-links">
        <a href="http://www.mozilla.org/jobs/">We’re hiring</a>
          |  
        <a href="http://www.mozilla.org/contribute/">Get involved</a>
    </p>

    </div><!-- end #doc -->
    </div><!-- end #wrapper -->

    <footer id="footer">
    <div class="section">

        <div id="copyright">
            <p id="footer-links"><a href="/{$lang}/privacy-policy.html">{$l10n->get('Privacy Policy')}</a> &nbsp;|&nbsp;
            <a href="/{$lang}/about/legal.html">{$l10n->get('Legal Notices')}</a> &nbsp;|&nbsp;
                        <a href="/{$lang}/legal/fraud-report/index.html">{$l10n->get('Report Trademark Abuse')}</a></p>
            <p>{$creative_commons}</p>
        </div>

        <form id="lang_form" class="languages"  dir="{$textdir}" method="get" action="{$host_root}includes/l10n/langswitcher.inc.php"><div>
            <label for="flang">{$l10n->get('switch language')}</label>
            {$lang_list}
            <noscript>
                <div><input type="submit" id="lang_submit" value="{$l10n->get('Go')}" /></div>
            </noscript>
        </div></form>

    </div>
    </footer>
    <!-- end #footer -->
    
    <script type="text/javascript" src="/js/newsletter-form.js"></script>

    <?=$stats_js?>
    <?=$extra_footers?>

</body>
</html>
