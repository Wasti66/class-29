<?php
	
	require_once('db_connection.php');
	
	//home
	function home_create(){
		$db_connect = db_connect();
		
		$title = mysqli_real_escape_string($db_connect,strtoupper($_POST['title']));
		$subtitle = mysqli_real_escape_string($db_connect,strtoupper($_POST['subtitle']));
		$details = mysqli_real_escape_string($db_connect,strtoupper($_POST['details']));
		
		$home_img_name = $_FILES['images']['name'];
		$home_img_size = $_FILES['images']['size'];
		$home_img_tmp = $_FILES['images']['tmp_name'];
		
		$errors = [];
		
		if(empty($title) || strlen($title) < 2 || strlen($title) > 100){
			$errors['title'] = 'Title will be in 3-32 character';
		}
		if(empty($subtitle) || strlen($subtitle) < 3 || strlen($subtitle) > 100){
			$errors['subtitle'] = 'Subtitle will be in 3-32 character';
		}
		if(empty($details) || strlen($details) < 10 || strlen($details) > 200){
			$errors['details'] = 'Details will be in 10-200 character';
		}
		
		$sql_view = "SELECT * FROM home_section WHERE type = 'section-images'";
		$result = mysqli_query($db_connect,$sql_view);
		
		if((mysqli_num_rows($result) == 0 && empty($home_img_tmp)) || (mysqli_num_rows($result) > 0 && $home_img_tmp)){
			
			if($home_img_tmp > 5242880){
				$errors['home_image'] = 'Max size 5MB';
			}
			$targeted_extension = array('jpg','png','jpeg','gif');
			$getExtension = strtolower(pathinfo($home_img_name,PATHINFO_EXTENSION));
			if(!in_array($getExtension,$targeted_extension)){
				$errors['home_image'] = 'jpg/png/jpeg/gif file required!';
			}
			
		}
		
		if(count($errors) > 0){
			return[
				'status' => 'error',
				'message' => $errors,
			];
			
		}
		
		$sql_view = "SELECT * FROM home_section WHERE type = 'section-title'";
		$result = mysqli_query($db_connect,$sql_view);
		
		if(mysqli_num_rows($result) == 0){
			
			$location = 'image/home';
			if(!file_exists('../'.$location)){
				mkdir('../'.$location);
			}
			$path = null;
			if($home_img_tmp){
				$path = $location.'/'.$home_img_name;
				move_uploaded_file($home_img_tmp, '../'.$path);	
			}
			
			$sql_insert = "INSERT INTO home_section(type,content) 
			VALUES('section-title','$title');";
			
			$sql_insert .= "INSERT INTO home_section(type,content) 
			VALUES('section-subtitle','$subtitle');";
			
			$sql_insert .= "INSERT INTO home_section(type,content) 
			VALUES('section-details','$details');";
			
			$sql_insert .= "INSERT INTO home_section(type,content) 
			VALUES('section-images','$path');";
			
			$result = mysqli_multi_query($db_connect,$sql_insert);
			
		}else{
			
			$sql_view = "SELECT * FROM home_section WHERE type = 'section-images'";
			$result = mysqli_query($db_connect,$sql_view);
			
			$location = 'image/home';
			
			if(mysqli_num_rows($result) == 1){
				$path = mysqli_fetch_assoc($result)['content'];
				if($home_img_tmp && file_exists('../'.$path)){
					unlink('../'.$path);
				}
			}	
			
			if($home_img_tmp){
				$path = $location.'/'.$home_img_name;
				move_uploaded_file($home_img_tmp, '../'.$path);	
			}
			
			$sql_update = "UPDATE home_section SET content='$title' WHERE type='section-title';";
			$sql_update .= "UPDATE home_section SET content='$subtitle' WHERE type='section-subtitle';";
			$sql_update .= "UPDATE home_section SET content='$details' WHERE type='section-details';";
			$sql_update .= "UPDATE home_section SET content='$path' WHERE type='section-images';";
			
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
	function home(){
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM home_section WHERE type != 'section-content'";
		$result = mysqli_query($db_connect,$sql_view);
		$rows =[
			'title' => null,
			'subtitle' => null,
			'details' => null,
			'images' => null,
		];
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				if($row['type'] == 'section-title'){
					$rows['title'] = $row['content'];
				}elseif($row['type'] == 'section-subtitle'){
					$rows['subtitle'] = $row['content'];
				}elseif($row['type'] == 'section-details'){
					$rows['details'] = $row['content'];
				}elseif($row['type'] == 'section-images'){
					$rows['images'] = $row['content'];
				}
			}
		}
		return $rows;
	}
	
	
?>