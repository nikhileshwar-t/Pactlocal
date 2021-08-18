<?php
include('../includes/configure.php');
require_once  '../includes/phpmailer/class.phpmailer.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = false;
$mail->SMTPAuth = TRUE;
$mail->Host     = SMTP_HOST;
$mail->SMTPSecure = "tls";
$mail->Port     = SMTP_PORT;  
$mail->Username = SMTP_USERNAME;
$mail->Password = SMTP_PASSWORD;
$mail->Timeout = 60;
$mail->ContentType = 'text/html; charset=utf-8';
// $mail->XMailer = ' ';

$mail->Mailer   = "smtp";
$mail->SetFrom(SMTP_USERNAME, 'PACT Support');
$mail->AddReplyTo($_SESSION['email'], $_SESSION['name']);
$mail->AddAddress(SMTP_SENDTO_EMAIL);	
$mail->Subject = "PACT Feedback: " . $_POST["appselect"];
$mail->WordWrap   = 80;

$bodyContent = "Feedback by: <a href='mailto:".$_SESSION['email']."'>".$_SESSION['name']."</a> <br/>". $_POST["content"];
$mail->MsgHTML($bodyContent);
// $mail->Body = $_POST["content"];
// $mail->MsgHTML = $_POST["content"];
// $mail->AltBody = $_POST["content"];

foreach ($_FILES["attachment"]["name"] as $k => $v) {
    $mail->AddAttachment( $_FILES["attachment"]["tmp_name"][$k], $_FILES["attachment"]["name"][$k] );
}

$mail->IsHTML(true);

if(!$mail->Send()) {
	echo '<div class="alert alert-danger" role="alert">Problem in Sending Mail.</div>';
} else {
	echo '<div class="alert alert-success" role="alert">Mail Sent Successfully.</div>';	
}	
?>