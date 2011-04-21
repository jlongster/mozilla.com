<?php

$body_id = 'channel';
$html5   = true;

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';

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




$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/channel.css" media="screen" />
    <style>
    a.download-link em {
        display: block;
        margin: -1em 1em 0;
        text-align:right;
    }


    .rtl a.download-link em {
        text-align:left;
    }

    #channel #download_aurora_button .download-other,
    #channel #download .download-other {
        text-align: center;
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

    </style>
EXTRA_HEADERS;

if ($textdir == "rtl") {
    $extra_headers .= <<<RTL
        <style>
        /* {{{  RTL Support */

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

        [dir="rtl"] ul.home-download {
            margin-right: 30px;
            margin-left: 0;
        }

        [dir="rtl"] #channel #download_aurora.channel #download_aurora_button a.download-link span.download-content, 
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

require_once $config['file_root'].'/includes/l10n/header-pages.inc.php';
require_once $config['file_root'].'/'.$lang.'/firefox/channel/content.inc.html';
require_once $config['file_root'].'/includes/l10n/footer-pages.inc.php';
