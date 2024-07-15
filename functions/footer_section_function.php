<?php

	require_once('db_connection.php');
	
	//footer title create
	function footer_title_create(){
		$db_connect = db_connect();
		
		$footer_title = mysqli_real_escape_string($db_connect,ucwords($_POST['footer_title']));
		
		$errors = [];
		
		if(empty($footer_title) || strlen($footer_title) < 2 || strlen($footer_title) > 300){
			$errors['footer_title'] = 'Footer title will be in 2-300 character';
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
		
		$select_view = "SELECT * FROM footer_section WHERE type='footer-title'";
		$result = mysqli_query($db_connect,$select_view);
		
		if(mysqli_num_rows($result) == 0){
			$insert_sql = "INSERT INTO footer_section(type,content) VALUES('footer-title','$footer_title');";
			$result = mysqli_multi_query($db_connect,$insert_sql);
		}else{
			$update_sql = "UPDATE footer_section SET content='$footer_title' WHERE type='footer-title';";
			$result = mysqli_multi_query($db_connect,$update_sql);
		}
		
		if(mysqli_error($db_connect)){
			die('Table error'.mysqli_error($db_connect));	
		}
		//$success = "Data save successfully";
		return[
			'status' => 'success',
			'message' => 'Data save successfully',
		];
			
		
	}
	//footer titlr view
	function footer_title_view(){
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM footer_section WHERE type != 'footer-content'";
		$result = mysqli_query($db_connect,$sql_view);
		$rows =[
			'footer_title' => null,
		];
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				if($row['type'] == 'footer-title'){
					$rows['footer_title'] = $row['content'];
				}
			}
		}
		return $rows;
	}
	
	
	/* ----- ==== footer create ==== ---- */
	function footer_create(){
		$db_connect = db_connect();
		
		$social_icon = mysqli_real_escape_string($db_connect,$_POST['social_icon']);
		$social_url = mysqli_real_escape_string($db_connect,$_POST['social_url']);
		
		$errors = [];
		
		if(empty($social_icon) || strlen($social_icon) < 2 || strlen($social_icon) > 100){
			$errors['social_icon'] = 'Social icon will be in 2-100 character';
		}
		if(empty($social_url) || strlen($social_url) < 2 || strlen($social_url) > 500){
			$errors['social_url'] = 'Social url will be in 2-5000 character';
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
		$sql_insert = "INSERT INTO  footer_section(type,content,social_icon) 
		VALUES('footer-content','$social_url','$social_icon')";
		$result = mysqli_query($db_connect,$sql_insert);
		if(mysqli_error($db_connect)){
			die('Table error'.mysqli_error($db_connect));	
		}
		//$success = "Data save successfully";
		return[
			'status' => 'success',
			'message' => 'Data save successfully',
		];
			
		
	}
	
	//footer view
	function footer_view(){
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM footer_section WHERE type = 'footer-content'";
		$result = mysqli_query($db_connect,$sql_view);
		return $result;
	}
	//footer status active/inactive function
	function footer_visibility(){
		$db_connect = db_connect();
		
		$id = $_POST['visibility_id'];
		
		$sql_view = "SELECT * FROM footer_section WHERE id='$id'";
		$result = mysqli_query($db_connect,$sql_view);
		if(mysqli_num_rows($result) == 0){
			$errors['visibility'] = 'Unknown Data..';
		}
		$errors = [];
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
		
		$checkData = mysqli_fetch_assoc($result);
		$status = $checkData['status'] == 1 ? 0 : 1;
		
		$sql_update = "UPDATE footer_section SET status = '$status' WHERE id='$id'";
		$result = mysqli_query($db_connect,$sql_update);
		if(mysqli_error($db_connect)){
			die('Table error'.mysqli_error($db_connect));	
		}
		//$success = "Data save successfully";
		return[
			'status' => 'success',
			'message' => 'Data Update Successfully',
		];
		
	}
	//about us progress update
	function footer_update(){
		$db_connect = db_connect();
		
		$footer_id = $_POST['footer_id'];
		$social_icon = mysqli_real_escape_string($db_connect,$_POST['social_icon']);
		$url_content = mysqli_real_escape_string($db_connect,$_POST['url_content']);
		
		$errors = [];
		
		if(empty($social_icon) || strlen($social_icon) < 2 || strlen($social_icon) > 100){
			$errors['social_icon'] = 'Social icon will be in 2-100 character';
		}
		if(empty($url_content) || strlen($url_content) < 2 || strlen($url_content) > 1000){
			$errors['url_content'] = 'Social url will be in 20-1000 character';
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
		$sql_update = "UPDATE footer_section SET content='$url_content',
		social_icon='$social_icon' WHERE id='$footer_id'";
		$result = mysqli_query($db_connect,$sql_update);
		
		if(mysqli_error($db_connect)){
			die('Table error'.mysqli_error($db_connect));	
		}
		return[
			'status' => 'success',
			'message' => 'About us update successfully',
		];
		
	}
	//delete about us progress
	function footer_delete(){
		$db_connect = db_connect();
		
		$id = $_POST['footer_delete_id'];
		
		$sql_view = "SELECT * FROM footer_section WHERE id='$id'";
		$result = mysqli_query($db_connect,$sql_view);
		if(mysqli_num_rows($result) == 0){
			$errors['data_delete'] = 'Unknown Data..';
		}
		$errors = [];
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}	
		$sql_delete = "DELETE FROM footer_section WHERE id='$id'";
		$result = mysqli_query($db_connect,$sql_delete);
		if(mysqli_error($db_connect)){
			die('Table error'.mysqli_error($db_connect));	
		}
		//$success = "Data save successfully";
		return[
			'status' => 'success',
			'message' => 'Data Delete Successfully',
		];
		
	}
	
?>