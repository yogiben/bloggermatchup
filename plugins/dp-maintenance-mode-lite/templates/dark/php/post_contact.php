<?php
	/*
		Newsletter Subscription
	*/

//Include Configuration
require_once (dirname (__FILE__) . '/../../../../../../wp-config.php');

global $dpMaintenance;

if($_POST['name']!='' && $_POST['email']!='' && $_POST['message']!=''){
	$email = stripslashes($_POST['email']);
	$name = stripslashes($_POST['name']);
	$message = stripslashes($_POST['message']);
	$to_email = stripslashes($dpMaintenance['contact_form_email_address']);
	$subject ="Contact Form";
	
	$message_email = "Contact Form: \r\n";
	$message_email .= "Name: ".$name."\r\n";
	$message_email .= "Email: ".$email."\r\n";
	$message_email .= "Message: ".$message."\r\n";
	
	$headers = 'From: '.$to_email . "\r\n".'Reply-to: '.$email."\r\n".'X-Mailer: PHP/'. phpversion();

	if(mail($to_email,$subject,$message_email,$headers)==true){	
		die('ok');
	}else{
		die(0);
	}
}
?>