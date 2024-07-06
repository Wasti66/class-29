<?php
	
	require_once('db_connection.php');
	
	//projects
	function project_creat(){
		$db_connect = db_connect();
		
		$name = ucfirst($_POST['name']);
		$category = $_POST['category'];
		
		$projects_img_name = $_FILES['projects_image']['name'];
		$projects_img_size = $_FILES['projects_image']['size'];
		$projects_img_tmp = $_FILES['projects_image']['tmp_name'];
		
		$errors = [];
		
		if(empty($category) || !in_array($category,['all','web-design','web-development','ui-ux-design','seo'])){
			$errors['category'] = 'category field required';
		}
		if(empty($name) || strlen($name) < 3 || strlen($name) > 100){
			$errors['name'] = 'Name will be in 3-32 character';
		}
		if(empty($projects_img_tmp) || $projects_img_tmp){
			
			if($projects_img_size > 2097152){
				$errors['projects_image'] = 'Max size 2MB';
			}
			$targeted_extension = array('jpg','png','jpeg','gif');
			$getExtension = strtolower(pathinfo($projects_img_name,PATHINFO_EXTENSION));
			if(!in_array($getExtension,$targeted_extension)){
				$errors['projects_image'] = 'jpg/png/jpeg/gif file required!';
			}
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}else{
			
			$location = 'image/project';
			if(!file_exists('../'.$location)){
				mkdir('../'.$location);
			}
			$path = null;
			if($projects_img_tmp){
				$path = $location.'/'.$projects_img_name;
				move_uploaded_file($projects_img_tmp, '../'.$path);	
			}
			$sql_projects_insert = "INSERT INTO projects(name,category,image) 
			VALUES('$name','$category','$path')";
			$result = mysqli_query($db_connect,$sql_projects_insert);
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
	//projects view
	function projects_view(){
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM projects";
		$result = mysqli_query($db_connect,$sql_view);
		//$sql_project_assoc = mysqli_fetch_assoc($result);
		return $result;
	}
	//projects active view
	function projects_active_view(){
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM projects WHERE status = 1";
		$result = mysqli_query($db_connect,$sql_view);
		//$sql_project_assoc = mysqli_fetch_assoc($result);
		return $result;
	}
	//status active/inactive function
	function data_visibility(){
		$db_connect = db_connect();
		
		$id = $_POST['visibility_id'];
		
		$sql_view = "SELECT * FROM projects WHERE id='$id'";
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
		
		$sql_projects_update = "UPDATE projects SET status = '$status' WHERE id='$id'";
		$result = mysqli_query($db_connect,$sql_projects_update);
		if(mysqli_error($db_connect)){
			die('Table error'.mysqli_error($db_connect));	
		}
		//$success = "Data save successfully";
		return[
			'status' => 'success',
			'message' => 'Data Update Successfully',
		];
		
	}
	
	//project update
	function project_update(){
		$db_connect = db_connect();
		
		$update_id = $_POST['update_id'];
		$update_name = ucfirst($_POST['update_name']);
		$update_category = $_POST['update_category'];
		
		$project_update_img_name = $_FILES['project_update_image']['name'];
		$project_update_img_size = $_FILES['project_update_image']['size'];
		$project_update_img_tmp = $_FILES['project_update_image']['tmp_name'];
		
		$errors = [];
		if(empty($update_name) || strlen($update_name) < 3 || strlen($update_name) > 100){
			$errors['update_name'] = 'Name will be in 3-100 character';
		}
		if(empty($update_category) || !in_array($update_category,['all','web-design','web-development','ui-ux-design','seo'])){
			$errors['update_category'] = 'category field required';
		}
		if($project_update_img_tmp){
			
			if($project_update_img_size > 5242880){
				$errors['project_update_image'] = 'Max size 5MB';
			}
			$targeted_extension = array('jpg','png','jpeg','gif');
			$getExtension = strtolower(pathinfo($project_update_img_name,PATHINFO_EXTENSION));
			if(!in_array($getExtension,$targeted_extension)){
				$errors['project_update_image'] = 'jpg/png/jpeg/gif file required!';
			}
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
			
		$location = 'image/project';
		if(!file_exists('../'.$location)){
			mkdir('../'.$location);
		}
		//$up_img = $_POST['up_img'];
		$path=null;
		if($project_update_img_tmp){
			$sql_view = "SELECT * FROM projects WHERE id='$update_id'";
			$reault_query = mysqli_query($db_connect,$sql_view);
			$image_assoc = mysqli_fetch_assoc($reault_query);
			$image = $image_assoc['image'];
			//return $image;
			if(file_exists('../'.$image)){
				unlink('../'.$image);
			}
			$path = $location.'/'.$project_update_img_name;
			move_uploaded_file($project_update_img_tmp, '../'.$path);	
		}
		$sql_update = "UPDATE projects SET name='$update_name',
		image='$path',category='$update_category' WHERE id='$update_id'";
		$result = mysqli_query($db_connect,$sql_update);
		
		if(mysqli_error($db_connect)){
			die('Table error'.mysqli_error($db_connect));	
		}
		return[
			'status' => 'success',
			'message' => 'Project data update successfully',
		];
		
	}

	//delete project data
	function data_delete(){
		$db_connect = db_connect();
		
		$id = $_POST['delete_id'];
		
		$sql_view = "SELECT * FROM projects WHERE id='$id'";
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
		
		$checkData = mysqli_fetch_assoc($result);
		$path = $checkData['image'];
		if($path && file_exists('../'.$path)){
			unlink('../'.$path);
		}
				
		$sql_delete = "DELETE FROM projects WHERE id='$id'";
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