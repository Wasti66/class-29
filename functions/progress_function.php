<?php

	require_once('db_connection.php');
	
	//progress
	function progress_create(){
		$db_connect = db_connect();
		
		$sql_view = "SELECT * FROM progress";
		$result = mysqli_query($db_connect,$sql_view);
		if(mysqli_num_rows($result) >= 6){
			return[
				'status' => 'error',
				'message' => ['overload' => 'Sorry! Only 6 review data allow. Please delete one to store new one'],
			];
		}
		
		$icon = $_POST['icon'];
		$progress_num = $_POST['progress_num'];
		$name = ucfirst($_POST['name']);
		
		$errors = [];
		
		if(empty($icon) || strlen($icon) < 2 || strlen($icon) > 100){
			$errors['icon'] = 'Icon will be in 2-100 character';
		}
		if(empty($progress_num) || strlen($progress_num) < 1 || 
		!is_numeric($progress_num)){
			$errors['progress_num'] = 'Progress number must be required';
		}
		if(empty($name) || strlen($name) < 3 || strlen($name) > 100){
			$errors['name'] = 'Name will be in 3-32 character';
		}
		
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
			
		$sql_insert = "INSERT INTO progress(icon,number,name) 
		VALUES('$icon','$progress_num','$name')";
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
	//progress view
	function progress_view(){
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM progress";
		$result = mysqli_query($db_connect,$sql_view);
		//$sql_project_assoc = mysqli_fetch_assoc($result);
		return $result;
	}
	//progress status active/inactive function
	function progress_data_visibility(){
		$db_connect = db_connect();
		
		$id = $_POST['visibility_id'];
		
		$sql_view = "SELECT * FROM progress WHERE id='$id'";
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
		
		$sql_update = "UPDATE progress SET status = '$status' WHERE id='$id'";
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
	//progress update
	function progress_update(){
		$db_connect = db_connect();
		
		$id = $_POST['id'];
		$icon = $_POST['icon'];
		$progress_num = $_POST['progress_num'];
		$name = ucfirst($_POST['name']);
	
		$errors = [];
		
		if(empty($icon) || strlen($icon) < 2 || strlen($icon) > 100){
			$errors['icon'] = 'Icon will be in 2-100 character';
		}
		if(empty($progress_num) || strlen($progress_num) < 1 || 
		!is_numeric($progress_num)){
			$errors['progress_num'] = 'Progress number must be required';
		}
		if(empty($name) || strlen($name) < 3 || strlen($name) > 100){
			$errors['name'] = 'Name will be in 3-32 character';
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
		$sql_update = "UPDATE progress SET icon='$icon',
		number='$progress_num',name='$name' WHERE id='$id'";
		$result = mysqli_query($db_connect,$sql_update);
		
		if(mysqli_error($db_connect)){
			die('Table error'.mysqli_error($db_connect));	
		}
		return[
			'status' => 'success',
			'message' => 'Progress data update successfully',
		];
		
	}
	//delete progress data
	function progress_data_delete(){
		$db_connect = db_connect();
		
		$id = $_POST['delete_id'];
		
		$sql_view = "SELECT * FROM progress WHERE id='$id'";
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
		$sql_delete = "DELETE FROM progress WHERE id='$id'";
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