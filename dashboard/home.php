<?php 

	include('header.php'); 
	include('../functions/home_function.php');
	if(isset($_POST['home_submission'])){
		$old = $_POST;
		$result = home_create();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	$home = home();
	//print_r($data);
	
	
?>
	<main>
	  <section>
	    <div class="container-fluid">
		  <div class="row">
			<!-- === sideber === -->
			<?php include('sideber.php'); ?>
			<!-- === main content === -->
			<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
			   <div class="card bg-secondary-subtle p-3 my-5 border-0 shadow-sm"> 
				 <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0">
					<li class="breadcrumb-item"><a href="dashboard.php" class="h5">Dashboard</a></li>
					<li class="breadcrumb-item active h5" aria-current="page">Home</li>
				  </ol>
				 </nav>
			   </div>
			   <h5 class="text-success fw-semibold">
				   <?php

						echo $success?? '';	
						
				   ?>
			   </h5>
			   <!-- ==== progress form === -->
			   <form action="" method="post" enctype="multipart/form-data">
				   <!-- === images === -->
				   <div class="mb-3">
					  <lable>Images</lable>
					  <input type="file" name="images" value="<?php echo $old['images']??$home['images']?? ''; ?>" class="form-control" placeholder="Images">
					  <span class="text-danger small"><?php echo $errors['home_image']?? ''; ?></span>
					  <img src="../<?php echo $home['images']; ?>" style="height:120px;width:120px;" class="mt-4">
				   </div>
				   <!-- === title === -->
				   <div class="mb-3">
					  <input type="name" name="title" value="<?php echo $old['title']??$home['title']?? ''; ?>" class="form-control" placeholder="Title">
					  <span class="text-danger small"><?php echo $errors['title']?? ''; ?></span>
				   </div>
				   <!-- === subtitle=== -->
				   <div class="mb-3">
					  <input type="name" name="subtitle" value="<?php echo $old['subtitle']??$home['subtitle']?? ''; ?>" class="form-control" placeholder="Subtitle">
					  <span class="text-danger small"><?php echo $errors['subtitle']?? ''; ?></span>
				   </div>
				   <!-- === details === -->
				   <div class="mb-3">
					  <textarea class="form-control" 
					  placeholder="Details" type="text" name="details" rows="5"><?php echo $old['details']??$home['details']?? ''; ?></textarea>
					  <span class="text-danger small"><?php echo $errors['details']?? ''; ?></span>
				   </div>
				   <button type="submit" name="home_submission" class="btn btn-primary">Save</button>
			    </form>
			</div>
		  </div>
		</div>
	  </section>
	  
	</main>
	<?php include('footer.php'); ?>
