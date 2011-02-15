<?php
    $newsletter_wt_subscribe_uri = '/button/firstrun/newsletter_subscribe.html';
    $newsletter_wt_subscribe_ti = 'First%20Run%20Newsletter%20Subscribe';
    $newsletter_wt_blade_uri = '/button/firstrun/newsletter_blade.html';
    $newsletter_wt_blade_ti = 'First%20Run%20Newsletter%20Blade';

    require_once "{$config['file_root']}/includes/regions.php";
    require_once "{$config['file_root']}/includes/email/forms.php";

    $newsletter_wt_subscribe_uri = isset($newsletter_wt_subscribe_uri) ? $newsletter_wt_subscribe_uri : '';
    $newsletter_wt_subscribe_ti = isset($newsletter_wt_subscribe_ti) ? $newsletter_wt_subscribe_ti : '';
    $newsletter_wt_blade_uri = isset($newsletter_wt_blade_uri) ? $newsletter_wt_blade_uri : '';
    $newsletter_wt_blade_ti = isset($newsletter_wt_blade_ti) ? $newsletter_wt_blade_ti : '';

    $form = new NewsletterForm('MOZILLA_AND_YOU', $_POST);
    $status = '';
    if ($form->save()) {
        $status = 'success';
    } elseif ($form->error) {
        $status = 'error error-'. $form->error;
    }
?>
    <div class="sub-feature <?= $status ?>" id="newsletter"><div class="container">

        <form id="email-form" action="#email-form" method="post">
        <ul class="<?= $status ?>">
            <li id="open-pane" data-wt_uri="<?= $newsletter_wt_blade_uri ?>" data-wt_ti="<?= $newsletter_wt_blade_ti ?>">
                <h3>Get Monthly News</h3>
                <p>Product info, tips &amp; tricks and much more.</p>
                <div id="email-field" class="field">
                    <span class="error-wrapper">
                        <input
                            id="email"
                            name="email"
                            type="email"
                            placeholder="Your Email Address"
                            value="<?= $form->get('email') ?>"
                            class="<?= ($form->get('email') == '') ? 'placeholder' : '' ?>">
                    </span>
                    <a id="email-open"
                        href="/<?php echo $lang; ?>/newsletter/"
                        onclick="dcsMultiTrack('DCS.dcssip', 'www.mozilla.com',
                                               'DCS.dcsuri', '/mainstream_newsletter/step1', 
                                               'WT.ti', 'Link: Monthly News - First Step',
                                               'WT.dl', 99,
                                               'WT.nv', 'Content',
                                               'WT.ac', 'Newsletter');">»</a>
                </div>
            </li>
            <li id="form-pane">
                <p class="form-error" id="email-error"><span>Whoops! Be sure to enter a valid email address.</span></p>
                <p class="form-error" id="privacy-error"><span>Please read the Mozilla Privacy Policy and agree by checking the box.</span></p>
                <div id="form-details">

                    <div class="field" id="country-field">
                        <select id="country" name="country">
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

                    <div class="field" id="format-field">
                        <?php
                            $html_format = 'checked="checked"';
                            $text_format = '';
                            if ($form->get('format') == 'text') {
                                $text_format = 'checked="checked"';
                                $html_format = '';
                            }
                        ?>
                        <div class="field-radios">
                            <span class="radio-wrapper"><input type="radio" name="format" id="html-format" value="html" <?= $html_format?>></span>
                            <label for="html-format">HTML</label>
                            <span class="radio-wrapper"><input type="radio" name="format" id="text-format" value="text" <?= $text_format?>></span>
                            <label for="text-format">Text</label>&nbsp;
                        </div>
                    </div>

                    <div id="privacy-field">
                        <?php $checked = $form->get('privacy') ? 'checked="checked"' : '' ?>
                        <label for="privacy-check" id="privacy-check-label">
                            <span class="error-wrapper"><input type="checkbox" id="privacy-check" name="privacy" <?= $checked ?>></span> I agree to the <a href="/en-US/privacy-policy">Privacy Policy</a>
                        </label>
                    </div>

                    <input name="submit" type="submit" value="Sign me up!" id="subscribe"
                           onclick="dcsMultiTrack('DCS.dcssip', 'www.mozilla.com',
                                                  'DCS.dcsuri', '/mainstream_newsletter/signup',
                                                  'WT.ti', 'Link: Sign me up - Second Step',
                                                  'WT.dl', 99,
                                                  'WT.nv', 'Content',
                                                  'WT.ac', 'Newsletter');">
                    <p class="footnote">We will only send you Mozilla-related information.</p>
                </div>

            </li>
            <li id="success-pane">
                <h3>Thanks for Subscribing!</h3>
                <p>We look forward to soon begin sharing tips &amp; tricks on getting the most out of Firefox, as well as exciting news about Mozilla and how we’re working to create a better Web.</p>
            </li>
        </ul>
        </form>
    </div>