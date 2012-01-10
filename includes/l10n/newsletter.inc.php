<?php

$body_id = 'newsletter';

$extra_headers = <<<EXTRA_HEADERS
    <style>
    /* MetaWebPro font family licensed from fontshop.com. WOFF-FTW! */
    @font-face {
        font-family: 'MetaBlack';
        src: url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.eot');
        src: local('☺'), url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.woff') format('woff');
        font-weight: bold;
    }

    #newsletter.locale-es-ES #main-feature h2 {
        font-size: 32px;
        line-height: 1.5em;
    }

    #newsletter.locale-fr #main-feature h2 span {
        font-size: 50px;
    }
    </style>

    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/newsletter.css" media="screen">
EXTRA_HEADERS;


// form code
require_once $config['file_root'] . '/includes/regions.php';
require_once $config['file_root'] . '/includes/email/prefs.php';
$form = new EmailPrefs($_POST);
$form->save_new(array('optin' => FALSE));

// text and template
l10n_moz::load($config['file_root'] . '/'. $lang.'/includes/l10n/newsletter.lang');


$errors = '';

require_once $config['file_root'] . '/includes/l10n/header-pages.inc.php';

?>


<div id="main-feature">
  <h2><?=___('Read all about it in our <span>newsletter</span>')?></h2>
  <p><?=___('Subscribe to monthly updates and keep current with Mozilla news, including the latest tips and tricks for getting the most out of your Firefox browser. It’s the perfect way for us to keep in touch!')?></p>
</div>


<div id="content" class="<?= $form->has_success() ? 'success' : '' ?>">

  <div class="success-pane">
    <h3><?=___('Thanks for Subscribing!')?></h3>
    <p><?=___('We just sent you a confirmation message by email. Click on the confirmation link in this email to validate your subscription to this mailing list.')?></p>
  </div>


  <form action="" method="post" id="newsletter-form">
    <input type="hidden" name="mozilla-and-you" value="Y" />

<?php
    if($form->has_non_field_error()) {
        echo '<div class="non-field-errors field-errors">' .
        ___($form->non_field_error) .
        '</div>';
    }

    if($form->has_error()) {
        echo '<ul class="field-errors">';

        foreach($form->errors as $error) {
            if($error == 'email') {
                echo '<li>' . ___('Whoops! Be sure to enter a valid email address.') . '</li>';
            }
            else if($error == 'privacy') {
                echo '<li>' . ___('Please read the Mozilla Privacy Policy and agree by checking the box.') . '</li>';
            }
        }

        echo '</ul>';
    }
?>

        <div class="field required email-field <?= $form->has_error('email') ? 'field-error' : ''; ?>">
          <label for="email"><?=___('Your Email Address')?></label>
          <span class="error-wrapper"><input name="email" type="email" class="email" value="<?= $form->get('email') ?>" autofocus></span>
        </div>

        <div class="field country-field <?= $form->has_error('country') ? 'field-error' : ''; ?>">
          <label for="country"><?=___('Select country')?></label>
          <select class="country" name="country">
            <?php
                $country = $form->get('country');

                if (!$country) {

                    if(in_array($lang, array('fr', 'de', 'it', 'nl', 'pl'))) {
                        $country = $lang;
                    } elseif($lang == 'pt-BR'){
                        $country = 'br';
                    } elseif($lang == 'es-ES'){
                        $country = 'es';
                    } else {
                        $country = 'us';
                    }
                }

                echo regionsAsOptions($lang, $country);
            ?>
          </select>
        </div>

        <div class="field lang-field">
          <span class="field-label"><?=___('Available Languages')?></span>
          <div class="field-language">
            <select class="lang" name="lang">


<?php
    // generate <option> automatically
    $form_lang = $form->get('lang');
    if (!$form_lang) {

        if(in_array($lang, array('de', 'es-ES', 'fr', 'pt-BR'))) {
            $selected = $lang;
        } else {
            $selected = 'en-US';
        }

    } else {
        $selected = $form_lang;
    }

    $supported_lang = array(
        'de'    => 'Deutsch',
        'en-US' => 'English',
        'es-ES' => 'Español',
        'fr'    => 'Français',
        'pt-BR' => 'Português'
        );

    foreach($supported_lang as $key => $val) {
        $is_selected = ($key == $selected) ? " selected='selected'" : "";
        echo "<option value='{$key}'{$is_selected}>{$val}</option>\n";
    }



?>

            </select>
          </div>
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
          <span class="field-label"><?=___('Format')?></span>
          <div class="field-radios">
            <span class="radio-wrapper"><input type="radio" name="format" id="html-format" class="html-format" value="html" <?= $html_format?>></span>
            <label for="html-format">HTML</label>
            <span class="radio-wrapper"><input type="radio" name="format" id="text-format" class="text-format" value="text" <?= $text_format?>></span>
            <label for="text-format"><?=___('Text')?></label>
          </div>
        </div>

        <div class="field privacy-field <?= $form->has_error('privacy') ? 'field-error' : ''; ?>">
          <label for="privacy-check" class="privacy-check-label">
            <? $checked = $form->get('privacy') ? 'checked="checked"' : '' ?>
            <span class="error-wrapper"><input type="checkbox" name="privacy" id="privacy-check" class="privacy-check" <?= $checked ?>></span>
            <span class="title fr-title"><?=sprintf(___('I agree to the <a href="%s">Privacy Policy</a>'), '/privacy-policy')?></span>
          </label>
        </div>

        <div class="text"><?=___('We will only send you Mozilla-related information.')?></div>

        <div class="field submit-field">
          <input name="submit" type="submit" value="<?=___('Sign me up!')?>" id="subscribe" class="button">
        </div>
      </form>


</div><!-- end #content div -->

<?php

// form process
if($form->has_success()) {
  echo "<script>
    dcsMultiTrack('WT.si_n', 'Main Newsletter Subscribe', 'WT.si_x', '1', 'WT.si_cs', '1');
  </script>";
}

echo '<script src="' . $config['static_prefix'] . '/js/autofocus.js"></script>';

//include footer
require_once $config['file_root'] . '/includes/l10n/footer-pages.inc.php';
