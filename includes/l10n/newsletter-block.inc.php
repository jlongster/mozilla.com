<?php
    require_once $config['file_root'] . '/includes/regions.php';
    require_once $config['file_root'] . '/includes/email/forms.php';

    $newsletter_class        = empty($newsletter_class)         ? '' : $newsletter_class;
    $newsletter_snippet      = empty($newsletter_snippet)       ? '' : $newsletter_snippet;
    $newsletter_form_snippet = empty($newsletter_form_snippet)  ? '' : $newsletter_form_snippet;

    $status = '';

    if (isset($_POST['target']) && $_POST['target'] == 'inline') {

        $form   = new LocalizedNewsletterForm('MOZILLA_AND_YOU', $_POST, FALSE);
        $status = '';

        if ($form->save()) {
            $status = 'success';
        } elseif ($form->error) {
            $status = 'error error-'. $form->error;
        }

    } else {
        $form = new NewsletterForm('MOZILLA_AND_YOU', array());
    }

    l10n_moz::load($config['file_root'] . '/'. $lang.'/includes/l10n/newsletter.lang');
?>



<div class="newsletter-signup <?= $newsletter_class ?> <?= $status ?> " id="newsletter">
  <div class="container">

    <form class="email-form inline-email-form" action="#subscribe-form" method="post">
      <input type="hidden" name="target" value="inline" />

      <ul class="<?= $status ?>">
        <li class="open-pane" data-wt_uri="<?= $newsletter_wt_blade_uri ?>" data-wt_ti="<?= $newsletter_wt_blade_ti ?>">
          <h3><?=___('Get Monthly News')?></h3>
          <?= $newsletter_snippet ?>
          <div class="email-field field">
            <span class="error-wrapper">
              <input
                 name="email"
                 type="email"
                 placeholder="<?=___('Your Email Address')?>"
                 value="<?= $form->get('email') ?>"
                 class="email <?= ($form->get('email') == '') ? ' placeholder' : '' ?>">
            </span>
            <a class="email-open"
               href="/<?= $lang; ?>/newsletter/"
               onclick="dcsMultiTrack('DCS.dcssip', 'www.mozilla.com',
                        'DCS.dcsuri', '/mainstream_newsletter/step1',
                        'WT.ti', 'Link: Monthly News - First Step',
                        'WT.dl', 99,
                        'WT.nv', 'Content',
                        'WT.ac', 'Newsletter');">»</a>
          </div>
        </li>
        <li class="form-pane">
          <?= $newsletter_form_snippet ?>
          <p class="form-error email-error"><span><?=___('Whoops! Be sure to enter a valid email address.')?></span></p>
          <p class="form-error privacy-error"><span><?=___('Please read the Mozilla Privacy Policy and agree by checking the box.')?></span></p>
          <div class="form-details">

            <div class="field country-field">
              <select class="country" name="country">
                <option value=""><?=___('Select country')?></option>
                <?php
                   $country = $form->get('country');
                    if (!$country) {

                        if(in_array($lang, array('fr', 'de', 'it', 'nl', 'pl'))) {
                            $country = $lang;
                        } else {
                            $country = 'us';
                        }
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
                <span class="radio-wrapper"><input type="radio" name="format" class="html-format" id="inline-html-format" value="html" <?= $html_format?>></span>
                <label for="inline-html-format">HTML</label>
                <span class="radio-wrapper"><input type="radio" name="format" class="text-format" id="inline-text-format" value="text" <?= $text_format?>></span>
                <label for="inline-text-format"><?=___('Text')?></label>&nbsp;
              </div>
            </div>

            <div class="privacy-field">
              <?php $checked = $form->get('privacy') ? 'checked="checked"' : '' ?>
              <label for="inline-privacy-check" class="privacy-check-label">
                <span class="error-wrapper"><input type="checkbox" class="privacy-check" id="inline-privacy-check" name="privacy" <?= $checked ?>></span> <?=sprintf(___('I agree to the <a href="%s">Privacy Policy</a>'), '/privacy-policy')?>
              </label>
            </div>

            <input name="submit" type="submit" value="<?=___('Sign me up!')?>" class="subscribe"
                   onclick="dcsMultiTrack('DCS.dcssip', 'www.mozilla.com',
                            'DCS.dcsuri', '/mainstream_newsletter/signup',
                            'WT.ti', 'Link: Sign me up - Second Step',
                            'WT.dl', 99,
                            'WT.nv', 'Content',
                            'WT.ac', 'Newsletter');">
            <p class="footnote"><?=___('We will only send you Mozilla-related information.')?></p>
          </div>

        </li>
        <li class="success-pane">
          <h3><?=___('Thanks for Subscribing!')?></h3>
          <p><?=___('We look forward to soon begin sharing tips &amp; tricks on getting the most out of Firefox, as well as exciting news about Mozilla and how we’re working to create a better Web.')?></p>
        </li>
      </ul>
    </form>
  </div>
</div>

<?php
   $newsletter_class = '';
   $newsletter_snippet = '';
   $newsletter_form_snippet = '';
?>
