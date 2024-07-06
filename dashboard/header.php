<?php
	session_start();
	if(!$_SESSION['auth']){
		header('Location:../login.php');
	}
	
	if(isset($_POST['logout_submission'])){
		include('../functions/authentication_function.php');
		logout();
	}
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
		<meta name="generator" content="Hugo 0.122.0">
		<title>Dashboard Template</title>						
		<!-- Bootstrap CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="../css/dashboard.css" rel="stylesheet">
		<!--Fontawesome-->
		<link rel="stylesheet"type="text/css"href="../css/all.css"> 
    </head>
    <body>
	<!-- === dashboard header === -->
	<nav class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
	  <div class="container-fluid">
		  <a class="navbar-brand me-0 fs-5 text-white" href="dashboard.php">Wasti</a>

		  <div class="d-flex align-items-center">
			<!-- === profile dropdown === -->
			<div class="dropdown">
			  <a href="#" class="d-block text-decoration-none dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
				<img src="../<?php echo ($_SESSION['auth']['image'] && ! empty($_SESSION['auth']['image']) ? $_SESSION['auth']['image'] : 'image/profile_image.jpg') ?>" alt="profile_image" width="40" height="40" class="rounded-circle">
			  </a>
			  <ul class="dropdown-menu text-small bg-body-tertiary" style="inset: 35px -7px auto auto;">
			    <li><a class="dropdown-item" href="profiles.php">Profile</a></li>
				<li><a class="dropdown-item" href="profiles.php">Settings</a></li>
				<li><hr class="dropdown-divider"></li>
				<li>
				  <form method="post">
				    <input type="submit" class="btn dropdown-item border-0" value="Sing Out" name="logout_submission">
				  </form>
				</li>
			  </ul>
			</div>
			<ul class="navbar-nav flex-row d-md-none">
				<li class="nav-item text-nowrap">
				  <button class="nav-link text-white btn mx-4" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
					<i class="fas fa-search"></i>
				  </button>
				</li>
				<li class="nav-item text-nowrap">
				  <button class="nav-link text-white btn" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fas fa-bars"></i>
				  </button>
				</li>
			</ul>
		  </div>
		  <!-- === search input === -->	
		  <div id="navbarSearch" class="navbar-search w-100 collapse">
			<input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
		  </div>
	  </div>
	</nav>
	