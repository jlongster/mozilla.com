<?php
/**
 * Form handler for Firefox mobile beta postcards
 *
 * This is entirely quick and dirty and could do with refactoring, 
 * templatizing, and generally gutting and burning.
 */
include_once 'config.inc.php';
include_once 'functions.inc.php';
require_once 'recaptcha/recaptchalib.php';
require_once 'Mail.php';

$postcard_choices = buildFirefoxMobileBetaPostcardChoices();

// TODO: If ever localized, find a way to jump back to appropriate locale page
$return_url = '/en-US/mobile/beta/gomobile/';

/** 
 * Main driver 
 */
function main() {

    global $config, $return_url, $postcard_choices;
    $errors = array();

    if (!empty($_POST['mode'])) {
        $mode = ( $_POST['mode'] == 'preview' ) ? 'preview' : 'send';
    } else if (!empty($_POST['preview'])) {
        $mode = 'preview';
    } else if (!empty($_POST['send'])) {
        $mode = 'send';
    } else {
        $mode = 'preview';
    }

    $remote_ip = $_SERVER['REMOTE_ADDR']; 
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && 
            !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $remote_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    // Verify the recaptcha before continuing, unless this is a preview...
    if ('preview' != $mode) {
        $challenge = isset($_POST['recaptcha_challenge_field']) ? 
            $_POST['recaptcha_challenge_field'] : '';
        $response = isset($_POST['recaptcha_response_field']) ? 
            $_POST['recaptcha_response_field'] : '';
        $resp = recaptcha_check_answer($config['recaptcha_priv_key'],
            $remote_ip, $challenge, $response);
        if (!$resp->is_valid) {
            $errors[] = array('recaptcha_response_field','invalid','');
        }
    }

    // Quick & dirty form validation
    $vars_def = array(
        'postcard'  => array('required', 'valid_postcard'),
        'message'   => NULL,
        'to_addr'   => array('required', 'email'),
        'to_name'   => array('required',),
        'from_addr' => array('required', 'email'),
        'from_name' => array('required',),
    );
    $vars = array(
        'subject' => "You're Invited! Try Firefox 4 beta for mobile",
    );

    foreach ($vars_def as $name => $validators) {
        $val = empty($_POST[$name]) ? '' : $_POST[$name];
        $all_ok = TRUE;
        if (is_array($validators)) {
            foreach ($validators as $validator) {
               $this_ok = TRUE;
               switch ($validator) {
                   case 'required':
                       if (empty($val)) $this_ok = FALSE; break;
                   case 'valid_postcard':
                       if (!isset($postcard_choices[$val])) $this_ok = FALSE; break;
                   case 'email':
                       if (!email_rfc($val)) $this_ok = FALSE; break;
               }
               if (!$this_ok) {
                   $all_ok = FALSE;
                   $errors[] = array($name, $validator, $val);
               }
            }
        }
        if ($all_ok) $vars[$name] = $val;
    }

    if (!empty($errors)) {
        render_error($errors);
    } else if ('send'==$mode) {
        send_email($vars);
    } else {
        render_preview($vars);
    }
    exit();

}

/** 
 * Text version of the postcard email template 
 */
function email_text_template($vars) {
    global $config, $return_url, $postcard_choices;
    ob_start(); 
    ?>
Greetings <?=$vars['to_name']?>!
Firefox is going mobile! You're invited to download Firefox 4 beta on your
Android phone or Nokia N900. Visit Firefox.com/mobile/beta to download and
learn more.

<?=$vars['message']?>

Go Mobile,

<?=$vars['from_name']?>
<?php
    $result = ob_get_contents(); ob_end_clean();
    return $result;
}

/** 
 * HTML version of the postcard email template 
 */
function email_html_template($vars, $postcard_kind='full') {
    global $config, $return_url, $postcard_choices;
    $h_vars = array_map('htmlspecialchars', $vars);

    $home_url = 'http://firefox.com/m/beta/';

    $postcard_fn = $postcard_choices[$vars['postcard']][$postcard_kind];
    $postcard_img_url = 'http://' . $_SERVER['HTTP_HOST'] .
       '/img/mobile/beta/postcards/' . $postcard_fn;
    
    ob_start(); 
    ?>
<p>Greetings <?=$h_vars['to_name']?>!</p>

<p>Firefox is going mobile! You're invited to download Firefox 4 beta on your
Android phone or Nokia N900. Visit <a href="Firefox.com/mobile/beta">Firefox.com/mobile/beta</a> 
to download and learn more.</p>

<p><?=$h_vars['message']?></p>

<p>Go Mobile,</p>

<p><a href="mailto:<?=$h_vars['from_addr']?>"><?=$h_vars['from_name']?></a></p>

<p><a href="<?=$home_url?>"><img src="<?=$postcard_img_url?>" border="0" /></a></p>

<?php
    $result = ob_get_contents(); ob_end_clean();
    return $result;
}

/** 
 * Render form validation error 
 */
function render_error($errors) {
    global $config, $return_url, $postcard_choices;
    ?><!DOCTYPE html><html><body>
        <h1>Problems in postcard submission:</h1>
        <a href="<?=$return_url?>">Return to form</a>
        <ul>
        <?php foreach ($errors as $error): ?>
            <li><?=htmlspecialchars($error[0])?>: 
                <?=htmlspecialchars($error[1])?></li>
        <?php endforeach ?>
        </ul>
        <script type="text/javascript">
            if (top.Mozilla_Mobile_Beta_GoMobile) {
                top.Mozilla_Mobile_Beta_GoMobile
                    .flagPostcardFormErrors(<?=json_encode($errors)?>);
            }
        </script>
    </body></html>
    <?php
}

/** 
 * Render postcard preview 
 */
function render_preview($vars) {
    global $config, $return_url, $postcard_choices;
    $h_vars = array_map('htmlspecialchars', $vars);
    $j_vars = json_encode($vars);
    $html_ct = email_html_template($vars, 'preview');
    ?><!DOCTYPE html><html>
    <head>
        <style type="text/css">
        table th { text-align: right; padding-right: 0.25em; }
        </style>
    </head>
    <body>
        <table>
            <tr><th>From:</th><td>Mozilla.com &lt;noreply@mozilla.com&gt;</td></tr>
            <tr><th>To:</th><td><?=$h_vars['from_addr']?></td></tr>
            <tr><th>Subject:</th><td><?=$h_vars['subject']?></td></tr>
        </table>
        <?=$html_ct?>
        <script type="text/javascript">
            if (top.Mozilla_Mobile_Beta_GoMobile) {
                top.Mozilla_Mobile_Beta_GoMobile
                    .revealPreview(<?=$j_vars?>);
            }
        </script>
    </body>
    </html>
    <?php
}

/** 
 * Send off email, render confirmation 
 */
function send_email($vars) {
    global $config, $return_url, $postcard_choices;

    $home_url = 'http://firefox.com/m/beta/';

    $postcard_fn = $postcard_choices[$vars['postcard']]['full'];
    $postcard_img_url = 'http://' . $_SERVER['HTTP_HOST'] .
       '/img/mobile/beta/postcards/' . $postcard_fn;

    $boundary = md5(uniqid(time()));

    $bad_client_msg = join(' ', array(
        "This part of the email should never be seen.",
        "If you are reading this, you should consider",
        "upgrading your email client to a MIME compatible",
        "client.",
    ));

    $h_vars = array_map('htmlspecialchars', $vars);

    $html_body = email_html_template($vars, 'full');
    $text_body = email_text_template($vars);   

    if (!isset($config['smtp_host'])) {
        $mailer = Mail::factory('mail');
    } else {
        $params = array(
            'host' => $config['smtp_host'],
            'port' => !isset($config['smtp_port']) ? 25 : $config['smtp_port'],
        );
        if (!empty($config['smtp_auth'])) {
            $params += array(
                'auth' => $config['smtp_auth'],
                'username' => $config['smtp_username'],
                'password' => $config['smtp_password'],
            );
        }
        $mailer = Mail::factory('smtp', $params);
    }

    $headers = array(
        "From" => "Mozilla <noreply@mozilla.com>",
        "Subject" => $vars['subject'],
        "X-Mailer" => "PHP/". phpversion() ."",
        "MIME-Version" => "1.0",
        "Content-Type" => "multipart/alternative; boundary=\"{$boundary}\";", 
        "Content-Transfer-Encoding" => "7bit",
    );

    $body = join("\r\n", array(
        chunk_split($bad_client_msg),
        "--". $boundary ."",
        "Content-Type:  text/plain; charset=\"UTF-8\"",
        "Content-Transfer-Encoding: base64\r\n",
        chunk_split(base64_encode($text_body)) ."",
        "--". $boundary ."",
        "Content-Type:  text/html; charset=\"UTF-8\"",
        "Content-Transfer-Encoding: base64\r\n",
        chunk_split(base64_encode($html_body)) ."",
        "--". $boundary ."--",
    ));

    $sent = $mailer->send($vars['to_addr'], $headers, $body);

    if (PEAR::isError($sent)) {
        ?><!DOCTYPE html><html><body>
            <h1>Problem sending postcard!</h1>
            <a href="<?=$return_url?>">Return to form</a>
            <script type="text/javascript">
                if (top.Mozilla_Mobile_Beta_GoMobile) {
                    top.Mozilla_Mobile_Beta_GoMobile
                        .notifyPostcardError(<?=json_encode($vars)?>);
                }
            </script>
        </body></html><?php
        die;
    }

    ?><!DOCTYPE html><html><body>
        <h1>Postcard sent!</h1>
        <a href="<?=$return_url?>">Return to form</a>
        <script type="text/javascript">
            if (top.Mozilla_Mobile_Beta_GoMobile) {
                top.Mozilla_Mobile_Beta_GoMobile
                    .notifyPostcardSent(<?=json_encode($vars)?>);
            }
        </script>
    </body></html><?php
}

/**
 * Validate email, RFC compliant version
 *
 * @see  Originally by Cal Henderson, modified to fit Kohana syntax standards:
 * @see  http://www.iamcal.com/publish/articles/php/parsing_email/
 * @see  http://www.w3.org/Protocols/rfc822/
 *
 * @param   string   email address
 * @return  boolean
 */
function email_rfc($email)
{
    $qtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
    $dtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
    $atom  = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
    $pair  = '\\x5c[\\x00-\\x7f]';

    $domain_literal = "\\x5b($dtext|$pair)*\\x5d";
    $quoted_string  = "\\x22($qtext|$pair)*\\x22";
    $sub_domain     = "($atom|$domain_literal)";
    $word           = "($atom|$quoted_string)";
    $domain         = "$sub_domain(\\x2e$sub_domain)*";
    $local_part     = "$word(\\x2e$word)*";
    $addr_spec      = "$local_part\\x40$domain";

    return (bool) preg_match('/^'.$addr_spec.'$/D', (string) $email);
}

main();
