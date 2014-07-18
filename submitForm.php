//Sean Eaton
//6-20-10
//PHP file to recieve an e-mail address with a form

<?php
if(isset($_POST['email'])) {
	
	// My e-mail and subject I want for people summitting e-mails
	$email_to = "SS4Gosan@comcast.com";
	$email_subject = "Someone wants Pictures";
	
	
	function died($error) {
		// your error code can go here
		echo "I'm sorry, but there were error(s) found with the form your submitted. ";
		echo "These errors appear below.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		die();
	}
	
	// validation expected data exists
	if(!isset($_POST['first_name']) ||
		!isset($_POST['last_name']) ||
		!isset($_POST['email']) ||
		!isset($_POST['telephone']) ||
		!isset($_POST['comments'])) {
		died('We are sorry, but there appears to be a problem with the form your submitted.');		
	}
	
	$first_name = $_POST['first_name']; // required
	$last_name = $_POST['last_name']; // required
	$email_from = $_POST['email']; // required
	$telephone = $_POST['telephone']; // not required
	$comments = $_POST['comments']; // required
	
	$error_message = "";

//checks each text box and makes sure the correct format was used, gives an errror message if not
	$email_exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
  if(!eregi($email_exp,$email_from)) {
  	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
	$string_exp = "^[a-z .'-]+$";
  if(!eregi($string_exp,$first_name)) {
  	$error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
  if(!eregi($string_exp,$last_name)) {
  	$error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
  	$error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  $string_exp = "^[0-9 .-]+$";
  if(!eregi($string_exp,$telephone)) {
  	$error_message .= 'The Telphone Number you entered does not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
  	died($error_message);
  }
	$email_message = "Form details below.\n\n";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_message .= "First Name: ".clean_string($first_name)."\n";
	$email_message .= "Last Name: ".clean_string($last_name)."\n";
	$email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "Telephone: ".clean_string($telephone)."\n";
	$email_message .= "Comments: ".clean_string($comments)."\n";
	
	
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>

<!-- Prints upon successful submission -->

Thank you for contacting me. I will be in touch with you ASAP.

<?
}
?>
