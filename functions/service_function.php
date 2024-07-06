<?php

	require_once('db_connection.php');
	
	//service
	function service_create(){
		$db_connect = db_connect();
		
		$service_icon = mysqli_real_escape_string($db_connect,$_POST['service_icon']);
		$service_name = mysqli_real_escape_string($db_connect,ucwords($_POST['service_name']));
		$service_dis = mysqli_real_escape_string($db_connect,$_POST['service_dis']);
		
		$errors = [];
		
		if(empty($service_icon) || strlen($service_icon) < 2 || strlen($service_icon) > 100){
			$errors['service_icon'] = 'Icon will be in 2-100 character';
		}
		if(empty($service_name) || strlen($service_name) < 3 || strlen($service_name) > 100){
			$errors['service_name'] = 'Name will be in 3-32 character';
		}
		if(empty($service_dis) || strlen($service_dis) < 20 || strlen($service_dis) > 1000){
			$errors['service_dis'] = 'Discreption will be in 20-1000 character';
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}	
		$sql_insert = "INSERT INTO service(service_icon,service_name,service_dis) 
		VALUES('$service_icon','$service_name','$service_dis')";
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
	//service view
	function service_view(){
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM service";
		$result = mysqli_query($db_connect,$sql_view);
		//$sql_project_assoc = mysqli_fetch_assoc($result);
		return $result;
	}
	//service view
	function active_service_view(){
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM service WHERE status = 1";
		$result = mysqli_query($db_connect,$sql_view);
		//$sql_project_assoc = mysqli_fetch_assoc($result);
		return $result;
	}
	//service status active/inactive function
	function service_data_visibility(){
		$db_connect = db_connect();
		
		$id = $_POST['visibility_id'];
		
		$sql_view = "SELECT * FROM service WHERE id='$id'";
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
		
		$sql_update = "UPDATE service SET status = '$status' WHERE id='$id'";
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
	//service update
	function service_update(){
		$db_connect = db_connect();
		
		$id = $_POST['id'];
		$up_service_icon = mysqli_real_escape_string($db_connect,$_POST['up_service_icon']);
		$up_service_name = mysqli_real_escape_string($db_connect,ucwords($_POST['up_service_name']));
		$up_service_dis = mysqli_real_escape_string($db_connect,$_POST['up_service_dis']);
		
		$errors = [];
		
		if(empty($up_service_icon) || strlen($up_service_icon) < 2 || strlen($up_service_icon) > 100){
			$errors['up_service_icon'] = 'Icon will be in 2-100 character';
		}
		if(empty($up_service_name) || strlen($up_service_name) < 3 || strlen($up_service_name) > 100){
			$errors['up_service_name'] = 'Name will be in 3-32 character';
		}
		if(empty($up_service_dis) || strlen($up_service_dis) < 20 || strlen($up_service_dis) > 1000){
			$errors['up_service_dis'] = 'Discreption will be in 20-1000 character';
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
		$sql_update = "UPDATE service SET service_icon='$up_service_icon',
		service_name='$up_service_name',service_dis='$up_service_dis' WHERE id='$id'";
		$result = mysqli_query($db_connect,$sql_update);
		
		if(mysqli_error($db_connect)){
			die('Table error'.mysqli_error($db_connect));	
		}
		return[
			'status' => 'success',
			'message' => 'Service data update successfully',
		];
		
	}
	//delete progress data
	function service_data_delete(){
		$db_connect = db_connect();
		
		$id = $_POST['delete_id'];
		
		$sql_view = "SELECT * FROM service WHERE id='$id'";
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
		$sql_delete = "DELETE FROM service WHERE id='$id'";
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