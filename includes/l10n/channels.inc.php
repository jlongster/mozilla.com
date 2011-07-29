<?php

$body_id = 'channel';

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';

// Bug 654158: we hide the newsletter form
$getnotified = '<span style="min-height:1.2em">&nbsp;<span>';


// dl box
require_once $config['file_root'].'/includes/l10n/dlbox.inc.php';
$stable_button = $downloadbox;


// email form
require_once $config['file_root'].'/includes/regions.php';
require_once $config['file_root'].'/includes/email/forms.php';

$form = new ChannelsForm(array('AURORA', 'FIREFOX_BETA_NEWS', 'MOZILLA_AND_YOU'), $_POST);
$status = '';
if($form->save()) {
    $status = 'success';
} elseif ($form->error) {
    $status = 'error error-'. $form->error;
}

$country = $form->get('country');
if(!$country) {
    $country = 'us';
}

ob_start();
echo regionsAsOptions($lang, $country);
$list_countries = ob_get_contents();
ob_end_clean();

$newsletter_form = <<<FORM

    <div id="channel_news" class="{$status}">
          <div id="newsletter-signup">
            <div class="title">
              <h3>{$title}</h3>
              <p>{$subtitle}</p>
            </div>
            <div class="success-pane">
              <h3>{$success}</h3>
            </div>
            <form id="email-form" action="#newsletter-signup" method="post">
              <input id="email" name="email" type="email" value="{$form->get('email')}" placeholder="{$email_field}">
              <div id="email-error">{$email_error}</div>
              <div class="more">
                <div class="row">
                  <select id="country" name="country">
                      <option value="">{$country}</option>
                      {$list_countries}

                  </select>
                </div>
                <ul class="channels_signup">
                  <li><label for="check_aurora"><input type="checkbox" id="check_aurora" name="aurora" value="t" /> {$aurora_list}</label></li>
                  <li><label for="check_beta"><input type="checkbox" id="check_beta" name="beta" value="t" /> {$beta_list}</label></li>
                  <li><label for="check_general"><input type="checkbox" id="check_general" name="general" value="t" /> {$general_list}</label></li>
                </ul>
                <div id="channel-error">{$select_lists}</div>
                <input name="submit" class="button" type="submit" value="{$send_button}" id="subscribe"
                       onclick="dcsMultiTrack('DCS.dcssip', 'www.mozilla.com',
                                'DCS.dcsuri', '/mainstream_newsletter/signup',
                                'WT.ti', 'Link: Sign me up - Second Step',
                                'WT.dl', 99,
                                'WT.nv', 'Content',
                                'WT.ac', 'Newsletter');">
                <p class="footnote">{$privacy_text}</p>
              </div>
            </form>
          </div>

    </div>

FORM;


if($lang != 'en-US') {
    // Bug 654158: we hide the newsletter form
    $newsletter_form = '';
}



$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/l10n/channel.css" media="screen" />
    <style>

    /* Bug 654158: we hide the newsletter form, subtitle description  */
    #channel #main-feature p {
        visibility: hidden;
    }

    /* Bug 654158: we hide the newsletter form, subtitle description, some spacing to make it look better without a form */
    #main-content {
        margin: 0 20px 500px;
    }

    a.download-link em {
        display: block;
        margin: -1em 1em 0;
        text-align:right;
    }

    #channel #download_aurora_button .download-other,
    #channel #download-button .download-other,
    #channel #download .download-other {
        text-align: center;
    }

    .channel ul.channel-list {
        min-height: 13em;
    }

    div.title h3,
    p.footnote {
        max-width:250px;
    }

    div.title {
        width:700px;
    }

    form {
        width:200px;
    }

    body.locale-sq .channel h3 span {
        font-size: 20px;
    }

    body.locale-ru .channel h3 span,
    body.locale-vi .channel h3 span {
        font-size: 25px;
    }

    body.locale-gd .channel h3 span {
        font-size: 24px;
    }

    body.locale-ro .channel h3 span {
        font-size: 28px;
    }



    </style>
EXTRA_HEADERS;

if ($textdir == "rtl") {
    $extra_headers .= <<<RTL
        <style>
        /* {{{  RTL Support */

        [dir="rtl"] a.download-link em {
            text-align:left;
        }

        [dir="rtl"] #main-feature {
            margin: 0 20px 0 210px;
        }

        [dir="rtl"] #main-content {
            margin: 0 20px;
        }

        [dir="rtl"] #channel .channel {
            float: right;
            padding-right: 0;
            padding-left: 10px;
        }

        [dir="rtl"] #download_aurora h3 {
            background-position: right 0;
        }

        [dir="rtl"] #download_beta h3 {
            background-position: right -260px;
        }

        [dir="rtl"] #download_firefox h3 {
            background-position: right -260px;
        }

        [dir="rtl"] .channel h3 span {
            padding: 25px 120px 30px 0;
        }

        [dir="rtl"] .channel ul.channel-list {
            padding: 0 20px 10px 0;
        }

        [dir="rtl"] ul.home-download {
            margin-right: 30px;
            margin-left: 0;
        }

        [dir="rtl"] #channel #download_aurora.channel #download_aurora_button a.download-link span.download-content,
        [dir="rtl"] #channel #download_beta.channel #download-button a.download-link span.download-content,
        [dir="rtl"] #channel #download_firefox.channel #download a.download-link span.download-content {
            background: url("/img/covehead/channel/download-arrow.png") no-repeat scroll 190px 50% transparent;
            padding: 10px 45px 12px 20px;
        }

        [dir="rtl"] #newsletter-signup {
            background: url("/img/covehead/channel/mail.png") no-repeat scroll right 10px transparent;
            margin-right: 20px;
            padding-right: 55px;
            margin-left: 0;
            padding-left: 0;

        }

        [dir="rtl"] #newsletter-signup .title h3 {
            float: right;
            border-right: 0;
            border-left: 1px dotted #CCCCCC;
        }

        [dir="rtl"] #newsletter-signup .title p {
            float: right;
        }
        </style>
RTL;
}
$extra_headers .= <<<EXTRA_HEADERS
    <style>
    #mobile-beta {
        width: 310px !important;
        margin-left: 300px!important;
        text-align:center;
        clear:both !important;
    }

    [dir=rtl] #mobile-beta {
        margin-right:300px;
        margin-left:auto;
    }


    #mobile-beta .download-soon:hover {
        -moz-transition: box-shadow 0.2s ease-in !important;
        box-shadow: 0 3px rgba(90, 90, 90, 0.1), 0 -4px rgb(200,239,255) inset, 0 -10px 30px rgb(200,239,255) inset !important;
    }


    #mobile-beta .download-soon:hover a {
        text-decoration:none;
    }
    </style>

EXTRA_HEADERS;

$newsletter_form .= <<<MOBILEBETA
<div id="mobile-beta" class="channel">
    <p class="download-soon">
    <a href="https://market.android.com/details?id=org.mozilla.firefox_beta">
    <span>{$l10n->get('Firefox Beta for mobile')}</span>
    <img src="/img/mobile/beta/beta-install-inset.png">
    <span>{$l10n->get('Download')}</span>
    </a>
    </p>
</div>
MOBILEBETA;


require_once $config['file_root'].'/includes/l10n/header-pages.inc.php';
require_once $config['file_root'].'/'.$lang.'/firefox/channel/content.inc.html';
require_once $config['file_root'].'/includes/l10n/footer-pages.inc.php';
