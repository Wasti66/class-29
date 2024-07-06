<?php
	
	require_once('db_connection.php');
	
	//login
	function login(){
		$db_connect = db_connect();
		
		$email = mysqli_real_escape_string($db_connect,$_POST['email']);
		$password = $_POST['password'];
		$remember = $_POST['remember']??null;
		$errors = [];
		
		$sql_view = "SELECT * FROM users WHERE email= '$email' && password='$password'";
		$result = mysqli_query($db_connect,$sql_view);
		
		if(mysqli_num_rows($result) == 0){
			$errors['email'] = 'Email/Password Does Not Match';
			
			return [
				'status' => 'error',
				'message' => $errors,
			];
			
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
			header('Location:dashboard/dashboard.php');
		}
	}
	//logout
	function logout(){
		session_destroy();
		session_unset();
		header('Location:../login.php');
	}
	//registration
	function registration(){
		$db_connect = db_connect();
		
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
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}else{
			$sql_insert = "INSERT INTO users(name,email,phone,dob,gender,password) VALUES('$name','$email','$phone','$dob','$gender','$password')";
			$result = mysqli_query($db_connect,$sql_insert);
			if(mysqli_error($db_connect)){
				die('Table error'.mysqli_error($db_connect));	
			}
			//$success = "Data save successfully";
			return[
				'status' => 'success',
				'message' => 'Data save successfully',
			];
			
			//header('location:login.php');
		}
		
	}
	//profile update
	function profile_update(){
		$db_connect = db_connect();
		
		$name = ucfirst($_POST['name']);
		$phone = $_POST['phone'];
		$dob = $_POST['dob'];
		$gender = $_POST['gender'];
		$user_id = $_SESSION['auth']['id'];
		
		$profile_img_name = $_FILES['profile_image']['name'];
		$profile_img_size = $_FILES['profile_image']['size'];
		$profile_img_tmp = $_FILES['profile_image']['tmp_name'];
		
		$errors = [];
		if(empty($name) || strlen($name) < 3 || strlen($name) > 32){
			$errors['name'] = 'Name will be in 3-32 character';
		}
		if(empty($phone) || strlen($phone) < 11 || strlen($phone) > 17 || !is_numeric($phone)){
			$errors['phone'] = 'Invalid Phone Number';
		}else{
			$sql_phone_view = "SELECT * FROM users WHERE phone = '$phone' 
			&& id != '$user_id'";
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
		if($profile_img_tmp){
			
			if($profile_img_size > 5242880){
				$errors['profile_image'] = 'Max size 5MB';
			}
			$targeted_extension = array('jpg','png','jpeg','gif');
			$getExtension = strtolower(pathinfo($profile_img_name,PATHINFO_EXTENSION));
			if(!in_array($getExtension,$targeted_extension)){
				$errors['profile_image'] = 'jpg/png/jpeg/gif file required!';
			}
		}
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}else{
			
			$location = 'image/profile';
			if(!file_exists('../'.$location)){
				mkdir('../'.$location);
			}
			$path = $_SESSION['auth']['image']??null;
			if($profile_img_tmp){
				if($path){
					unlink('../'.$path);
				}
				$path = $location.'/'.$profile_img_name;
				move_uploaded_file($profile_img_tmp, '../'.$path);	
			}
			
			$sql_update = "UPDATE users SET name='$name',
			phone='$phone',dob='$dob',gender='$gender',image='$path' WHERE id='$user_id'";
			$result = mysqli_query($db_connect,$sql_update);
			
			if(mysqli_error($db_connect)){
				die('Table error'.mysqli_error($db_connect));	
			}
			
			$sql_phone_view = "SELECT * FROM users WHERE id='$user_id'";
			$results = mysqli_query($db_connect,$sql_phone_view);
			$_SESSION['auth'] = mysqli_fetch_assoc($results);
			
			//$success = "Data save successfully";
			return[
				'status' => 'success',
				'message' => 'Data save successfully',
			];
			
			//header('location:login.php');
		}
		
	}
	
?>