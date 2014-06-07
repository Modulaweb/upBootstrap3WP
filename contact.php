<?php

require dirname(__FILE__) . '/../../../wp-blog-header.php' ;
header('HTTP/1.1 200 Ok', true, '200');

function Bootsy_format_phone($phone, $format='2by2') {
	$phone = trim(preg_replace('/\-|\.|\/| /','',$phone));
	switch ($format) {
		case '2by2':
			$pattern = '/(^0[12345689]{1})(\d{2})(\d{2})(\d{2})(\d{2})/';
			$replace = '$1 $2 $3 $4 $5';
			break;
		case 'int2by2':
			$pattern = '/^0([12345689]{1})(\d{2})(\d{2})(\d{2})(\d{2})/';
			$replace = '+33 $1 $2 $3 $4 $5';
			break;
		case 'int3by3':
			$pattern = '/^0([12345689]{3})(\d{3})(\d{3})/';
			$replace = '+33 $1 $2 $3';
			break;
	}
	return preg_replace($pattern, $replace, $phone);
}

function Bootsy_checkEmail($email) {
	if (ereg("^[^@ ]+@[^@ ]+\.[^@ \.]+$", $email, $trash)) {
		return true;
	} else {
		return false;
	}
}

function Bootsy_sendMail($t,$s,$m,$f='Robot Modulaweb <noreply@modulaweb.fr>',$mailer='Modulaweb/Organic') {
	$h = "From: {$f}" . "\r\n" .
	"Reply-To: {$f}" . "\r\n" .
	"Return-Path: {$f}" . "\r\n" .
	"X-Mailer: {$mailer}\n" .
	"MIME-Version: 1.0\n" .
	"Content-Type: multipart/mixed; boundary=\"------------001\"\n";
	$m = "This is a multi-part message in MIME format.
--------------001
Content-Type: multipart/alternative; boundary=\"------------002\"


--------------002
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit

" . trim(strip_tags($m)) . "
	
--------------002
Content-Type: text/html; charset=UTF-8
Content-Transfer-Encoding: 8bit

{$m}

--------------002--
--------------001--
";
	if (mail($t, $s, $m, $h)) {
		return true;
	} else {
		return false;
	}
}

$post = array (
	'persona' => array (
			'fullname' => ucwords(strtolower(trim($_POST['name']))),
			'email' => strtolower(trim($_POST['email'])),
			'phone' => Bootsy_format_phone(trim($_POST['phone'])),
			),
	'entity' => array (
			'name' => ucwords(strtolower(trim($_POST['struct']))),
			'url' => strtolower(trim($_POST['url'])),
			),
	'message' => array (
			'subject' => ucfirst(trim($_POST['subject1'])).' - '.ucfirst(trim($_POST['subject2'])),
			'content' => nl2br(stripslashes(trim(strip_tags($_POST['msg'])))),
			),
	'infos' => array (
			'IP' => $_SERVER['REMOTE_ADDR'],
			'host' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
			'IP lookup' => 'http://ip-lookup.net/index.php?ip='.$_SERVER['REMOTE_ADDR'],
			'time' => date('d/m/Y à H\hi'),
			),
);
// test the infos validity
$errorMessages = array();
if (!Bootsy_checkEmail($post['persona']['email'])) $errorMessages[] = array( __('Your email address', 'upbootwp') ,'email');
if (trim($_POST['name']) == '') $errorMessages[] = array( __('Your name', 'upbootwp') ,'name');
if (trim($_POST['subject1']) == '') $errorMessages[] = array( __('Your message category', 'upbootwp') ,'subject1');
if (trim($_POST['subject2']) == '') $errorMessages[] = array( __('Your message subject', 'upbootwp') ,'subject2');
if ($post['message']['content'] == '') $errorMessages[] = array( __('Your message', 'upbootwp') ,'msg');

if (count($errorMessages)>0) {
	$message = "<p>".__('Please verify or fill the following fields:', 'upbootwp')."</p><ul>";
	foreach ($errorMessages as $errorMessage) {
		$message .= "<li>{$errorMessage[0]}</li>\n";
	}
	$message .= '</ul>';
	exit ($message);
}

// testing from against akismet
$data = array('blog' => get_option( 'home' ),
              'user_ip' => preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] ),
              'user_agent' => $_SERVER['HTTP_USER_AGENT'],
              'referrer' => $_POST['ref'],
              'permalink' => $_SERVER['HTTP_REFERER'],
              'comment_type' => 'contact_form',
              'comment_author' => $post['persona']['fullname'],
              'comment_author_email' => $post['persona']['email'],
              'comment_author_url' => $post['entity']['url'],
              'comment_content' => $post['message']['subject']."\n\n".$post['message']['content']);

$query_string = http_build_query( $data );

$response = akismet_http_post( $query_string, $akismet_api_host, '/1.1/comment-check', $akismet_api_port );
$spam = false;
if ( isset( $response[1] ) && 'true' == trim( $response[1] ) ) // 'true' is spam
	$spam = true;

$subject_prefix = $message_spam = '';
if ($spam) {
	$subject_prefix='[Probably SPAM] ';
	$message_spam = '<p>'.__('Askismet think its spam.', 'upbootwp').'</p>';
}

// email body construction
$message = "<html><body style=\"font-family: Helvetica, Verdana, Arial, sans-serif; font-size: 12px;\">
<h1>".sprintf( __('Message sent from the %1$s website contact form', 'upbootwp') , get_option( 'blogname' ))."</h1>
<p>".sprintf( __('Message sent at %1$s from <a href=\"%2$s\">%3$s</a> (<a href=\"http://%1$s\">%1$s</a>)', 'upbootwp') , $post['infos']['time'], $post['infos']['IP lookup'], $post['infos']['IP'], $post['infos']['host'], $post['infos']['host'])."</p>
{$message_spam}
<h2>".__('Message author', 'upbootwp')."</h2>
<p>{$post['persona']['fullname']}<br />
<strong>". __('Phone:', 'upbootwp') ." </strong> {$post['persona']['phone']}<br />
<strong>". __('Mail:', 'upbootwp') ." </strong> <a href=\"mailto:{$post['persona']['email']}\">{$post['persona']['email']}</a><br />
</p>
<h2>". __('Company:', 'upbootwp') ."</h2>
<p>{$post['entity']['name']}<br />
<strong>". __('Website:', 'upbootwp') ." </strong> <a href=\"{$post['entity']['website']}\">{$post['entity']['website']}</a>
</p>
<h2>". __('Message:', 'upbootwp') ."</h2>
<h3>{$post['message']['subject']}</h3>
<blockquote>{$post['message']['content']}</blockquote>
</body>
</html>";

$bo = Bootsy_sendMail("contact-site@modulaweb.fr",$subject_prefix.$post['message']['subject'],$message,"{$post['persona']['fullname']} <{$post['persona']['email']}>",'Modulaweb/organic/Contact');
if ($bo) {
    echo 'ok';
	$location = $_SERVER['HTTP_REFERER'].'message-envoye/';
} else {
    echo 'nok';
	$location = $_SERVER['HTTP_REFERER'].'message-non-envoye/';
}
header('HTTP/1.1 200 Ok', true, '200');
?>