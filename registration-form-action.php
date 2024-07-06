<?php
	
	require_once('db_connection.php');
	
	$name = ucfirst($_POST['name']);
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	
	$errors = [];
	if(empty($name) || strlen($name) < 3 || strlen($name) > 32){
		$errors['name'] = 'Name will be in 3-32 character';
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$errors['email'] = 'Invalid Email';
	}else{
		$sql_view = "SELECT * FROM users WHERE email = '$email'";
		$result = mysqli_query($db_connect,$sql_view);
		if(mysqli_num_rows($result) == 1){
			$errors['email'] = 'This email already exists';
		}
		//print_r($result);
		//return true;
	}
	if(empty($phone) || strlen($phone) < 11 || strlen($phone) > 17 || !is_numeric($phone)){
		$errors['phone'] = 'Invalid Phone Number';
	}else{
		$sql_phone_view = "SELECT * FROM users WHERE phone = '$phone'";
		$result_phone = mysqli_query($db_connect,$sql_phone_view);
		if(mysqli_num_rows($result_phone) == 1){
			$errors['phone'] = 'This phone number already exists';
		}
	}
	if(empty($dob)){
		$errors['dob'] = 'Date of Birth required';
	}
	if(empty($gender) || !in_array($gender,['male','female'])){
		$errors['gender'] = 'Gender required';
	}
	if(empty($password) || strlen($password) < 6 || strlen($password) > 16){
		$errors['password'] = 'Password must be in 6-16 character';
	}
	if($password != $confirm_password){
		$errors['password'] = 'Password & confirm password not match';
	}
	if(count($errors) == 0){
		
		$sql_insert = "INSERT INTO users(name,email,phone,dob,gender,password) VALUES('$name','$email','$phone','$dob','$gender','$password')";
		$result = mysqli_query($db_connect,$sql_insert);
		if(mysqli_error($db_connect)){
			die('Table error'.mysqli_error($db_connect));	
		}
		$success = "Data save successfully";
	}
	
	
	
?>