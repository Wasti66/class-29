<?php

	require_once('db_connection.php');
	
	//about
	function about_create(){
		$db_connect = db_connect();
		
		$title = mysqli_real_escape_string($db_connect,ucwords($_POST['title']));
		$subtitle = mysqli_real_escape_string($db_connect,ucwords($_POST['subtitle']));
		$details = mysqli_real_escape_string($db_connect,$_POST['details']);
		
		$errors = [];
		
		if(empty($title) || strlen($title) < 2 || strlen($title) > 100){
			$errors['title'] = 'Title will be in 3-32 character';
		}
		if(empty($subtitle) || strlen($subtitle) < 3 || strlen($subtitle) > 100){
			$errors['subtitle'] = 'Subtitle will be in 3-32 character';
		}
		if(empty($details) || strlen($details) < 20 || strlen($details) > 10000){
			$errors['details'] = 'Details will be in 20-10000 character';
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
		
		$sql_view = "SELECT * FROM about_section WHERE type = 'section-title'";
		$result = mysqli_query($db_connect,$sql_view);
		
		if(mysqli_num_rows($result) == 0){
			
			$sql_insert = "INSERT INTO about_section(type,content) 
			VALUES('section-title','$title');";
			
			$sql_insert .= "INSERT INTO about_section(type,content) 
			VALUES('section-subtitle','$subtitle');";
			
			$sql_insert .= "INSERT INTO about_section(type,content) 
			VALUES('section-details','$details')";
			
			$result = mysqli_multi_query($db_connect,$sql_insert);
			
		}else{
			
			$sql_update = "UPDATE about_section SET content='$title' WHERE type='section-title';";
			$sql_update .= "UPDATE about_section SET content='$subtitle' WHERE type='section-subtitle';";
			$sql_update .= "UPDATE about_section SET content='$details' WHERE type='section-details';";
			$result = mysqli_multi_query($db_connect,$sql_update);
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
	//about view
	function about_us(){
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM about_section WHERE type != 'section-content'";
		$result = mysqli_query($db_connect,$sql_view);
		$rows =[
			'title' => null,
			'subtitle' => null,
			'details' => null,
		];
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				if($row['type'] == 'section-title'){
					$rows['title'] = $row['content'];
				}elseif($row['type'] == 'section-subtitle'){
					$rows['subtitle'] = $row['content'];
				}elseif($row['type'] == 'section-details'){
					$rows['details'] = $row['content'];
				}
			}
		}
		return $rows;
	}
	
	
	/* ----- ==== about us progress ==== ---- */
	function progress_creates(){
		$db_connect = db_connect();
		
		$progress_name = mysqli_real_escape_string($db_connect,ucwords($_POST['progress_name']));
		$progress_rate = mysqli_real_escape_string($db_connect,$_POST['progress_rate']);
		$progress_color = mysqli_real_escape_string($db_connect,$_POST['progress_color']);
		
		$errors = [];
		
		if(empty($progress_name) || strlen($progress_name) < 2 || strlen($progress_name) > 100){
			$errors['progress_name'] = 'Progress name will be in 2-32 character';
		}
		if(empty($progress_rate) || strlen($progress_rate) < 2 || strlen($progress_rate) > 100){
			$errors['progress_rate'] = 'Progress rate will be in 20-1000 character';
		}
		if(empty($progress_color) || strlen($progress_color) < 2 || strlen($progress_color) > 100){
			$errors['progress_color'] = 'Progress color will be in 20-1000 character';
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
		$sql_insert = "INSERT INTO  about_section(type,content,rate,color) 
		VALUES('section-content','$progress_name','$progress_rate','$progress_color')";
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
	//about view
	function progress_views(){
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM about_section WHERE type = 'section-content'";
		$result = mysqli_query($db_connect,$sql_view);
		return $result;
	}
	//about status active/inactive function
	function progress_visibility(){
		$db_connect = db_connect();
		
		$id = $_POST['visibility_id'];
		
		$sql_view = "SELECT * FROM about_section WHERE id='$id'";
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
		
		$sql_update = "UPDATE about_section SET status = '$status' WHERE id='$id'";
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
	function progress_updates(){
		$db_connect = db_connect();
		
		$progress_id = $_POST['progress_id'];
		$progress_name = mysqli_real_escape_string($db_connect,ucwords($_POST['progress_name']));
		$progress_rate = mysqli_real_escape_string($db_connect,$_POST['progress_rate']);
		$progress_color = mysqli_real_escape_string($db_connect,$_POST['progress_color']);
		
		$errors = [];
		
		if(empty($progress_name) || strlen($progress_name) < 2 || strlen($progress_name) > 100){
			$errors['progress_name'] = 'Progress name will be in 2-32 character';
		}
		if(empty($progress_rate) || strlen($progress_rate) < 2 || strlen($progress_rate) > 100){
			$errors['progress_rate'] = 'Progress rate will be in 20-1000 character';
		}
		if(empty($progress_color) || strlen($progress_color) < 2 || strlen($progress_color) > 100){
			$errors['progress_color'] = 'Progress color will be in 20-1000 character';
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
		$sql_update = "UPDATE about_section SET content='$progress_name',
		rate='$progress_rate',color='$progress_color' WHERE id='$progress_id'";
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
	function progress_delete(){
		$db_connect = db_connect();
		
		$id = $_POST['progress_delete_id'];
		
		$sql_view = "SELECT * FROM  about_section WHERE id='$id'";
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
		$sql_delete = "DELETE FROM  about_section WHERE id='$id'";
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