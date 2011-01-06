
<div id="sms-form" class="<?= $sms_error ?>">
  <div class="sms-step sms-start">
    <h4><a href="#" class="sms-next"><?= ___('Send the download link to your phone') ?></a></h4>

    <? if ($sms_error): ?>
      <p class="fail">
          <?= ___('We could not send a text message to you. Please make sure your number includes a country code (e.g. +1 555-123-4567) and that you answered the captcha correctly.') ?>
      </p>
    <? else: ?>
      <p><?= ___('Enter your mobile number and get a text containing a link to download Firefox to your phone.') ?></p>
      <p><?= ___('Standard text rates apply') ?></p>
    <? endif ?>

  </div>

  <form 
    method="post" 
    accept-charset="utf-8" 
    id="mobile-feature-form">

        <input type="hidden" name="sms_submit" value="1" />

      <div class="sms-step">
        <select title="<?= ___('Choose your location') ?>" id="prefix" name="prefix">
          <option value=""><?= ___('Choose your location') ?></option>
          <? foreach (sms::locations() as $name => $code): ?>
            <option value="<?= $code ?>"><?= $name ?></option>
          <? endforeach ?>
        </select>
        <input type="text" name="phone" value="" id="phone" />
        <button class="sms-button green-button sms-next" style="display:none;"><span class="outer">
          <span><?= ___('Send Text') ?></span>
        </span></button>
      </div>

      <div class="sms-step">
        <script type="text/javascript">
          var RecaptchaOptions = {
          theme: 'white',
          }; 
        </script>
        <script type="text/javascript"
          src="http://api.recaptcha.net/challenge?k=<?= $config['recaptcha_pub_key'] ?>">
        </script>
        <noscript>
          <iframe src="http://api.recaptcha.net/noscript?k=<?= $config['recaptcha_pub_key'] ?>"
          height="300" width="500"></iframe><br>
          <textarea name="recaptcha_challenge_field" rows="3" cols="40">
          </textarea>
          <input type="hidden" name="recaptcha_response_field" value="manual_challenge">
        </noscript>
        <button class="sms-button green-button"><span class="outer">
          <span>
          <?= ___('Send Text') ?>
          </span>
        </span></button>
      </div>
  </form>

  <script src="/js/jquery/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
        // gather the steps
        var sms_steps = $('.sms-step');
        // current step tracker
        var sms_cur_step = 0;
        // hide next steps
        sms_steps.slice(1).hide();
        // handle next button click
        $('.sms-next').click(function() {
            // get the current step
            var cur = $(sms_steps[sms_cur_step]);
            // block next step, if phone field is empty
            if (cur.find('#phone').val() == '')
                return false;
            // hide current step
            cur.hide();
            // increment current step
            sms_cur_step++;
            // show next step
            var next = $(sms_steps[sms_cur_step])
            next.show()
            // show the next button
            next.find('.sms-next').show();
            return false;
        });
    });
  </script>
</div>
