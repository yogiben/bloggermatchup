<?php
	/*
		MailChimp GetLists
	*/
@session_start();

require_once (dirname (__FILE__) . '/../mailchimp/miniMCAPI.class.php');

if($_POST['mailchimp_api']!=''){
	
	$return = '';
	$mailchimp_class = new mailchimpSF_MCAPI($_POST['mailchimp_api']);
											
	$retval = $mailchimp_class->lists();
	
	if (!$mailchimp_class->errorCode){
		$return .= '<select name="dpMaintenance_options[mailchimp_list]">';
		foreach ($retval['data'] as $list){
	
			$return .= '<option value="'.$list['id'].'">'.$list['name'].'</option>';
	
		}	
		$return .= '</select>';
	} else {
		$return = "Error: ".$mailchimp_class->errorMessage;
	}
	
	die($return);
}
?>