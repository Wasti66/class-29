<?php
	
	function db_connect(){
		$host = "localhost";
		$user = "root";
		$password = "";
		$db = "pfswd_05";
		
		$db_connect = mysqli_connect($host,$user,$password,$db);
		
		if(mysqli_connect_error()){
			die('DB Error'.mysqli_connect_error());
		}
		return $db_connect;
	}
	
?>