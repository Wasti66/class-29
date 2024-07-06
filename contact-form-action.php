<?php

	$name = $_GET['name'];
	$email = $_GET['email'];
	$phone = $_GET['phone'];
	$message = $_GET['message'];
	
	$errors = [];
	
	if(empty($name) || strlen($name) < 3 || strlen($name) > 32){
		$errors['name'] = "Name will be in 3-32 character";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$errors['email'] = "Invalid email";
	}
	if(empty($phone) || strlen($phone) < 11 || strlen($name) > 17){
		$errors['phone'] = "Invalid phone number";
	}
	if(empty($message) || strlen($message) < 10 || strlen($message) > 500){
		$errors['message'] = "Message will be in 10-500 character";
	}
	
	if(count($errors) == 0){
		$to = '08wasti@gmail.com';
		$subject = 'Portfolio website conatct message';
		$message = $message."\n";
		$message .= $name."\n";
		$message .= $email."\n";
		$message .= $phone."\n";
		$form = $email;
		
		$mailsending = mail($to,$subject,$message,"From:".$form);
		if($mailsending){
			$success = 'Message send successfully';
		}else{
			$success = 'Email sending server error';
		}
		
	}

?>