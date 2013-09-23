<?php
	/*
		Newsletter Subscription
	*/
@session_start();

//Include Configuration
require_once (dirname (__FILE__) . '/../../../../../../wp-config.php');
require_once (dirname (__FILE__) . '/../../../mailchimp/miniMCAPI.class.php');

global $dpMaintenance;

if(stripslashes($_POST['newsletter_email'])!=''){
	$newsletter_email = stripslashes($_POST['newsletter_email']);
	$to_email = stripslashes($dpMaintenance['newsletter_email_address']);
	
	$subject ="Newsletter subscription";
	
	$message = "Newsletter Subscription: ".$newsletter_email;
	
	$headers = 'From: '.$to_email . "\r\n".'Reply-to: '.$newsletter_email."\r\n".'X-Mailer: PHP/'. phpversion();
	
	@mail($to_email,$subject,$message,$headers);
	
	if($dpMaintenance['mailchimp_api'] != "" && $dpMaintenance['mailchimp_active']) {
		$mailchimp_class = new mailchimpSF_MCAPI($dpMaintenance['mailchimp_api']);
		
		$retval = $mailchimp_class->listSubscribe( $dpMaintenance['mailchimp_list'], $newsletter_email );

		if(!$mailchimp_class->errorCode){	
			die('ok');
		}else{
			die('0');
		}
	}
	die('ok');
}
?>