<?php
if (!isset($_POST['submit_form'])) {
    exit();
}

include_once 'config.inc.php';
require_once 'recaptcha/recaptchalib.php';

$recipients = array('trademarks@mozilla.com', 'mozilla@mofo.com');

ini_set('upload_max_size', '5M');

/** First, check Recaptcha response is valid **/

// get challenge/response from submitted form values
$challenge = isset($_POST['recaptcha_challenge_field']) ? $_POST['recaptcha_challenge_field'] : '';
$response = isset($_POST['recaptcha_response_field']) ? $_POST['recaptcha_response_field'] : '';

$remote_ip = $_SERVER['REMOTE_ADDR']; 

// if we're behind the Moz netscalar, we need to get the remote IP from X-Forwarded-For
if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    $remote_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

if (empty($challenge) || empty($response)) {
    header('Location: /legal/fraud-report/error-recaptcha.html');
    exit();
}

// call Recaptcha servers to verify
$resp = recaptcha_check_answer ($config['recaptcha_priv_key'],
                                $remote_ip,
                                $challenge,
                                $response);

// if the response isn't valid, then forward to a mozilla.com error page
if (!$resp->is_valid) {
    header('Location: /legal/fraud-report/error-recaptcha.html');
    exit();
}

/** Recaptcha is valid, continue to process the form **/

/***** Report form <select> options below *****/

$form_options['categories'] = array(
                    'Charging for software',
                    'Collecting personal information',
                    'Domain name violation',
                    'Logo misuse/modification',
                    'Distributing modified Firefox/malware',
                   );

$form_options['products'] = array(
                  'Firefox', 
                  'Thunderbird', 
                  'SeaMonkey',
                  'specify-1' => 'Other Mozilla Product/Project (specify)',
                 );

$url = trim(htmlentities($_POST['url']));

$category = $form_options['categories'][$_POST['category']];

$product = $form_options['products'][$_POST['product']];

$specific_product = "+ None";
if (isset($_POST['specific_product']) && !empty($_POST['specific_product']))
    $specific_product = trim(htmlentities($_POST['specific_product']));

$details = "+ None";
if (isset($_POST['details']) && !empty($_POST['details']))
    $details = trim(htmlentities($_POST['details']));

$email = "+ None";
if (isset($_POST['email']) && !empty($_POST['email']))
    $email = trim(htmlentities($_POST['email']));

$attachment = null;
$attachment_desc = "+ None";

if (is_uploaded_file($_FILES['attachment']['tmp_name'])) {
    $attachment = $_FILES['attachment'];
    $attachment_desc = $attachment['name'] ." -- ". trim(htmlentities($_POST['attachment_desc']));
} else {
    switch ($_FILES['attachment']['error']) {
        //No file was uploaded, that's OK
        case UPLOAD_ERR_NO_FILE:
            break;
        //File was too big
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            header('Location: /legal/fraud-report/error-upload-size.html');
            exit();
        //Unknown, most likely server error
        //to be more specific, var_dump($_FILES['attachment']['error']
        default:
            header('Location: /legal/fraud-report/error-upload-unknown.html');
            exit();
    }
}

/** Form values gathered, now set up the email **/
$to = implode(', ', $recipients);

//email template
$email_body = <<<EMAIL_TPL
A new violating website report has been submitted with the following information:

+ URL
{$url}

+ Category
{$category}

+ Product
{$product}

+ Specific product
{$specific_product}

+ Other details...
{$details}

+ Attachments...
{$attachment_desc}

+ Email
{$email}

EMAIL_TPL;
//end email template

$boundary = md5(uniqid(time()));
$bad_client_msg = "This part of the email should never be seen.
                   If you are reading this, you should consider
                   upgrading your email client to a MIME compatible
                   client.";

$attachment_sect = '';
if ($attachment) {
    $file = file_get_contents($attachment['tmp_name']);
    $attachment_sect = "--". $boundary ."\r\n".
                       "Content-Type: ". $attachment['type'] ."\r\n".
                       "Content-Transfer-Encoding: base64\r\n".
                       "Content-Disposition:  attachment; filename=\"". $attachment['name'] ."\"\r\n\r\n".
                       chunk_split(base64_encode($file)) ."\r\n";
}

$headers = "From: Mozilla.com <noreply@mozilla.com>\r\n".
           "X-Mailer: PHP/". phpversion() ."\r\n".
           "MIME-Version: 1.0\r\n".
           "Content-Type: multipart/mixed; boundary=\"". $boundary ."\";\r\n". 
           "Content-Transfer-Encoding: 7bit\r\n".
           chunk_split($bad_client_msg) ."\r\n".
           "--". $boundary ."\r\n".
           "Content-Type:  text/plain\r\n".
           "Content-Transfer-Encoding: base64\r\n\r\n".
           chunk_split(base64_encode($email_body)) ."\r\n".
           $attachment_sect.
           "--". $boundary ."--\r\n";

$sent = mail($to, 'New violating website report', '', $headers);

header('Location: /legal/fraud-report/sent.html');
exit();
