<?php
	
	require_once('db_connection.php');
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$remember = $_POST['remember']??null;
	$errors = [];
	
	/* if(!filter_var($email,FILTER_VALIDATE_EMAIL) || $email != '08wasti@gmail.com'){
		$errors['email'] = 'Email/Password Does Not Match';
	}
	if(empty($password) || strlen($password) < 6 || strlen($password) > 16 
	|| $password != '123456'){
		$errors['email'] = 'Email/Password Does Not Match';
	} */
	$sql_view = "SELECT * FROM users WHERE email= '$email' && password='$password'";
	$result = mysqli_query($db_connect,$sql_view);
	//print_r($result);
	//return true;
	if(mysqli_num_rows($result) == 0){
		$errors['email'] = 'Email/Password Does Not Match';
		//return true;
	}else{
		$success = "Login successfully";
		$_SESSION['auth'] = mysqli_fetch_assoc($result);
		if($remember){
			setcookie('email',$email,(2*60+time()),'/');
			setcookie('password',$password,(2*60+time()),'/');
		}else{
			setcookie('email','',(2*60+time()),'/');
			setcookie('password','',(2*60+time()),'/');
		}
		header('Location:dashboard.php');
	}
	
	
?>