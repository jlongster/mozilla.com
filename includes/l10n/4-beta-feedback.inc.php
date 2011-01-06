<?php


$body_id    = 'firefox-beta-feedback';

$email_error_msg        = addslashes(___('Whoops! Be sure to enter a valid email address.'));
$privacy_error_msg      = addslashes(___('Please read the Mozilla Privacy Policy and agree by checking the box.'));
$emailprivacy_error_msg = addslashes(___('Please enter your email address and review the Mozilla Privacy Policy.'));


$extra_headers = <<<EXTRA_HEADERS
<link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/email-form.css">
<link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/firefox/beta/4/main.css">

<script src="/includes/min/min.js?g=js" type="text/javascript"></script>
<script type="text/javascript" src="{$config['static_prefix']}/js/mozilla-input-placeholder.js"></script>
EXTRA_HEADERS;


$extra_css = <<<EXTRA_CSS

    #main-feature {
        padding-top: 0 !important;
    }

    #main-feature h2 {
        padding: 0 !important;
    }

    .rtl #main-feature {
        margin: 0 20px 0 210px !important;
    }
    
    #side-menu {
        width: 200px !important;
    }

    #sidebar {
        top: auto !important;
    }

    li.more h3 {
        font-weight:normal !important;
        margin-top: 10px !important;
    }

    .locale-it #beta-updates .footnote {
        display:inline !important;
    }

EXTRA_CSS;


// RTL support
if(in_array($lang, array('ar', 'fa', 'he'))) {
    $textdir = 'rtl';
    $extra_css .=<<<EXTRA_CSS

    #main-feature p {
        margin-left: auto !important;
        margin-right:auto !important;
    }

EXTRA_CSS;
}











// not sure that the emailing system works, let's hide it at release time by removing TEMP
$extra_cssTEMP  = '';
$extra_cssTEMP .= <<<EXTRA_CSS

div#subscribing {
    display:none;
}
EXTRA_CSS;


$englishpage = '<span class="en">'.___('(in English)').'</span>';
$englishpage = '';


$screencap_local = $_SERVER['DOCUMENT_ROOT'].'/'.$lang.'/img/fxb4-feedback-button-big.png';

if (!file_exists($screencap_local)) {
    $screencap = $config['static_prefix'].'/img/firefox/beta/4/feedback-button.png';
} else {
    $screencap = $config['static_prefix'].'/'.$lang.'/img/fxb4-feedback-button-big.png';
}


$fx4betabugurl ="https://bugzilla.mozilla.org/enter_bug.cgi?alias=&amp;component=General&amp;form_name=enter_bug&amp;keywords=&amp;op_sys=All&amp;product=Firefox&amp;rep_platform=All&amp;status_whiteboard=%5Bfrom-beta-tester%5D&amp;target_milestone=---&amp;version=Trunk";


$surveygizmocode[$lang] = '315792-9Q7XCIU8JXFEU0YBJE6A4RYE6IWP07';
// test:
$surveygizmocode[$lang] = '336318-3BF42SFKNPEO6SFSSIC6HMA42W9XQ1';

$str5 = str_replace("%s", "/en-US/privacy-policy", $str5);





$survey = <<<SURVEY
        <div id="survey">
        <script type="text/javascript" src="http://www.surveygizmo.com/s3/polljs/{$surveygizmocode[$lang]}" ></script>
            <noscript>
            <a href="http://www.surveygizmo.com/s3/pollhtml/{$surveygizmocode[$lang]}">{$str1}</a>
            </noscript>
        </div>
SURVEY;


// hide survey by default
if (!in_array($lang, array('en-US'))) {
    $survey = '';
}

require_once "{$config['file_root']}/includes/email/forms.php";
$form = new ExtraNewsletterForm('MOZILLA_AND_YOU', $_POST);
$status = '';
if ($form->save()) {
    $status = 'success';
} elseif ($form->error) {
    $status = 'error-'. $form->error;
}

$email = $form->get('email');
$privacy = $form->get('privacy') ? 'checked="checked"' : '';
$extra_news = $form->get('extra_news') ? 'checked="checked"' : '';

$html_format = 'checked="checked"';
$text_format = '';
if ($form->get('format') == 'text') {
    $text_format = 'checked="checked"';
    $html_format = '';
}

$extras = <<<SURVEY
<div id="sidebar">
    <div class="sub-feature stripes" id="beta-updates">

      {$survey}

        <div id="subscribing">
        <h3>{$str2}</h3>
        <ul id="email-form" class="{$status}">
            <li id="form-pane">
                <form action="" method="post">
                    <p class="intro">{$str3}</p>
                    <p id="email-error"><span>{$email_error_msg}</span></p>
                    <p id="privacy-error"><span>{$privacy_error_msg}</span></p>
                    <div id="email-field">
                      <span class="error-wrapper">
                        <input name="email" type="email" placeholder="{$str4}" id="email" value="{$email}">
                      </span>
                    </div>
                    <div class="field" id="format-field">
                      <div class="field-radios">
                        <label for="html-format">HTML</label>
                        <input type="radio" name="format" id="html-format" value="html" {$html_format}>
                        <label for="text-format">Text</label>
                        <input type="radio" name="format" id="text-format" value="text" {$text_format}>
                      </div>
                    </div>
                    <div id="privacy-field">
                        <label for="privacy-check" id="privacy-check-label">
                            <span class="error-wrapper input"><input type="checkbox" id="privacy-check" name="privacy" {$privacy}></span>
                            <span class="title">{$str5}</span></span>
                        </label>
                    </div>
                    <div id="extra-news-field">
                        <label for="extra-news-check" id="extra-news-check-label">
                            <span class="input"><input type="checkbox" name="extra_news" id="extra-news-check" {$extra_news}></span>
                            <span class="title">{$str6}</span>
                        </label>
                    </div>
                    <input name="submit" type="submit" value="{$str7}" id="subscribe">
                </form>
            </li>
            <li id="success-pane">
                <h3>{$str8}</h3>
                <p>{$str9}</p>
            </li>
        </ul>
        </div> <!-- end #subscribing -->
    </div>
    <div id="sub-content-footer"></div>
</div>

<script type="text/javascript">
// <![CDATA[
  var uservoiceOptions = {
    key: 'firefox',
    host: 'firefox.uservoice.com',
    forum: '57440',
    lang: '{$lang}',
    showTab: false
  };
  function _loadUserVoice() {
    var s = document.createElement('script');
    s.src = ("https:" == document.location.protocol ? "https://" : "http://") + "cdn.uservoice.com/javascripts/widgets/tab.js";
    document.getElementsByTagName('head')[0].appendChild(s);
  }
  _loadSuper = window.onload;
  window.onload = (typeof window.onload != 'function') ? _loadUserVoice : function() { _loadSuper(); _loadUserVoice(); };
// ]]>
</script>

SURVEY;


    require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
