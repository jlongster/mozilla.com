<?php
if (!isset($_POST['submit_form'])) {
    exit();
}

include_once 'config.inc.php';
require_once 'recaptcha/recaptchalib.php';

$recipients = array('press@mozilla.com');

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
    header('Location: /press/speakerrequest/error-recaptcha.html');
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

$form_fields = array(
	'event_name' => ' + None',
	'event_url' => ' + None',
	'speaker_1' => ' + None',
	'speaker_2' => ' + None',
	'contact_name' => ' + None',
	'contact_title' => ' + None',
	'contact_company' => ' + None',
	'contact_phone' => ' + None',
	'contact_email' => ' + None',
	'contact_url' => ' + None',
	'event_venue' => ' + None',
	'event_date_time' => ' + None',
	'event_theme' => ' + None',
	'event_goal' => ' + None',
	'event_format' => ' + None',
	'event_audience_size' => ' + None',
	'event_audience_demographics' => ' + None',
	'event_confirmed_speakers' => ' + None',
	'event_invited_speakers' => ' + None',
	'event_past_speakers' => ' + None',
	'event_media_coverage' => ' + None',
	'event_sponsors' => ' + None',
	'event_confirmation_deadline' => ' + None',
	'presentation_type' => '+ None',
	'presentation_panelists' => '+ None',
	'presentation_topic' => ' + None',
	'presentation_length' => ' + None',
);

foreach ($form_fields as $k => &$v) {
	if (isset($_POST[$k]) && !empty($_POST[$k])) {
		$v = trim(htmlentities($_POST[$k]));
	}
}

$presentation_types = array(
	'presentation_keynote' => 'Keynote',
	'presentation_presentation' => 'Presentation',
	'presentation_chat' => 'Fireside Chat',
	'presentation_panel' => 'Panel',
	'presentation_other' => 'Other',
);

$types = array();
if (isset($_POST['presentation_type']) && is_array($_POST['presentation_type']) && !empty($_POST['presentation_type'])) {
    foreach ($_POST['presentation_type'] as $k) {
		if (isset($presentation_types[$k])) {
	        $types[] = $presentation_types[$k];
		}
    }
}

if (count($types) > 0) {
	$form_fields['presentation_type'] = implode(', ', $types);
}

if (isset($_POST['event_month'])
	&& isset($_POST['event_day'])
	&& isset($_POST['event_year'])) {

	$form_fields['event_date_time'] =
		$_POST['event_month'].' '.$_POST['event_day'].', '.$_POST['event_year'];

	if (isset($_POST['event_hour'])
		&& isset($_POST['event_minute'])
		&& isset($_POST['event_meridiem'])) {

		$form_fields['event_date_time'].= ' '.
			$_POST['event_hour'].':'.$_POST['event_minute'].' '.$_POST['event_meridiem'];
	}
}

$attachment = null;
$form_fields['attachment'] = "+ None";

if (is_uploaded_file($_FILES['attachment']['tmp_name'])) {
    $attachment = $_FILES['attachment'];
    $form_fields['attachment'] = $attachment['name'];
} else {
    switch ($_FILES['attachment']['error']) {
        //No file was uploaded, that's OK
        case UPLOAD_ERR_NO_FILE:
            break;
        //File was too big
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            header('Location: /press/speakerrequest/error-upload-size.html');
            exit();
        //Unknown, most likely server error
        //to be more specific, var_dump($_FILES['attachment']['error']
        default:
            header('Location: /press/speakerrequest/error-upload-unknown.html');
            exit();
    }
}

/** Form values gathered, now set up the email **/
$to = implode(', ', $recipients);

//email template
$email_body = <<<EMAIL_TPL
A new speaker request form has been submitted with the following information:

+ Event Name
{$form_fields['event_name']}

+ Event URL
{$form_fields['event_url']}

+ Date/Time
{$form_fields['event_date_time']}

------------------------------------
Guest Speaker

+ Choice 1
{$form_fields['speaker_1']}

+ Choice 2
{$form_fields['speaker_2']}

------------------------------------
Contact Information

+ Name
{$form_fields['contact_name']}

+ Title
{$form_fields['contact_title']}

+ Company
{$form_fields['contact_company']}

+ Phone
{$form_fields['contact_phone']}

+ Email
{$form_fields['contact_email']}

+ URL
{$form_fields['contact_url']}

------------------------------------
Event Details

+ Venue
{$form_fields['event_venue']}

+ Theme
{$form_fields['event_theme']}

+ Goal
{$form_fields['event_goal']}

+ Format
{$form_fields['event_format']}

+ Expected Audience Size
{$form_fields['event_audience_size']}

+ Audience Demographics
{$form_fields['event_audience_demographics']}

+ Confirmed Speakers
{$form_fields['event_confirmed_speakers']}

+ Invited Speakers
{$form_fields['event_invited_speakers']}

+ Past Speakers
{$form_fields['event_past_speakers']}

+ Media Coverage
{$form_fields['event_media_coverage']}

+ Event Sponsors
{$form_fields['event_sponsors']}

+ Confirmation Deadline
{$form_fields['event_confirmation_deadline']}

------------------------------------
Presentation Details

+ Type of Presentation
{$form_fields['presentation_type']}

+ Other Panelists
{$form_fields['presentation_panelists']}

+ Topic of Presentation
{$form_fields['presentation_topic']}

+ Expected Length
{$form_fields['presentation_length']}

------------------------------------

+ Attachment
{$form_fields['attachment']}

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

$sent = mail($to, 'New speaker request form submission', '', $headers);

header('Location: /press/speakerrequest/sent.html');
exit();
