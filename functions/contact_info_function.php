<?php

	require_once('db_connection.php');
	
	//about
	function contact_create(){
		$db_connect = db_connect();
		
		$title = mysqli_real_escape_string($db_connect,ucwords($_POST['title']));
		$subtitle = mysqli_real_escape_string($db_connect,ucwords($_POST['subtitle']));
		
		$errors = [];
		
		if(empty($title) || strlen($title) < 2 || strlen($title) > 100){
			$errors['title'] = 'Title will be in 3-32 character';
		}
		if(empty($subtitle) || strlen($subtitle) < 3 || strlen($subtitle) > 100){
			$errors['subtitle'] = 'Subtitle will be in 3-32 character';
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
		
		$sql_view = "SELECT * FROM contact_info WHERE type = 'section-title'";
		$result = mysqli_query($db_connect,$sql_view);
		
		if(mysqli_num_rows($result) == 0){
			
			$sql_insert = "INSERT INTO contact_info(type,content) 
			VALUES('section-title','$title');";
			
			$sql_insert .= "INSERT INTO contact_info(type,content) 
			VALUES('section-subtitle','$subtitle');";
			
			$result = mysqli_multi_query($db_connect,$sql_insert);
			
		}else{
			
			$sql_update = "UPDATE contact_info SET content='$title' WHERE type='section-title';";
			$sql_update .= "UPDATE contact_info SET content='$subtitle' WHERE type='section-subtitle';";
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
	function contact_view(){
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM contact_info WHERE type != 'section-content'";
		$result = mysqli_query($db_connect,$sql_view);
		$rows =[
			'title' => null,
			'subtitle' => null,
		];
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				if($row['type'] == 'section-title'){
					$rows['title'] = $row['content'];
				}elseif($row['type'] == 'section-subtitle'){
					$rows['subtitle'] = $row['content'];
				}
			}
		}
		return $rows;
	}
	
	
	/* ----- ==== address create ==== ---- */
	function address_create(){
		$db_connect = db_connect();
		
		$icon = mysqli_real_escape_string($db_connect,$_POST['icon']);
		$address_title = mysqli_real_escape_string($db_connect,$_POST['address_title']);
		
		$errors = [];
		
		if(empty($icon) || strlen($icon) < 2 || strlen($icon) > 100){
			$errors['icon'] = 'Address icon will be in 2-32 character';
		}
		if(empty($address_title) || strlen($address_title) < 2 || strlen($address_title) > 100){
			$errors['address_title'] = 'Address title will be in 20-1000 character';
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
		
		$sql_insert = "INSERT INTO contact_info(type,content,icon) 
		VALUES('section-content','$address_title','$icon')";
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
	function address_view(){
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM contact_info WHERE type = 'section-content'";
		$result = mysqli_query($db_connect,$sql_view);
		return $result;
	}
	//address status active/inactive function
	function address_visibility(){
		$db_connect = db_connect();
		
		$id = $_POST['visibility_id'];
		
		$sql_view = "SELECT * FROM contact_info WHERE id='$id'";
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
		
		$sql_update = "UPDATE contact_info SET status = '$status' WHERE id='$id'";
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
	function address_updates(){
		$db_connect = db_connect();
		
		$address_id = $_POST['address_id'];
		$icon = mysqli_real_escape_string($db_connect,$_POST['icon']);
		$content = mysqli_real_escape_string($db_connect,$_POST['content']);
		
		$errors = [];
		
		if(empty($icon) || strlen($icon) < 2 || strlen($icon) > 100){
			$errors['icon'] = 'Address icon will be in 2-100 character';
		}
		if(empty($content) || strlen($content) < 2 || strlen($content) > 100){
			$errors['content'] = 'Address title will be in 20-1000 character';
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
		$sql_update = "UPDATE contact_info SET content='$content',
		icon='$icon' WHERE id='$address_id'";
		$result = mysqli_query($db_connect,$sql_update);
		
		if(mysqli_error($db_connect)){
			die('Table error'.mysqli_error($db_connect));	
		}
		return[
			'status' => 'success',
			'message' => 'Address update successfully',
		];
		
	}
	//address delete
	function address_delete(){
		$db_connect = db_connect();
		
		$id = $_POST['address_delete_id'];
		
		$sql_view = "SELECT * FROM  contact_info WHERE id='$id'";
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
		$sql_delete = "DELETE FROM  contact_info WHERE id='$id'";
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