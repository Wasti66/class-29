<?php
	include('header.php');
	if(isset($_POST['profile-update'])){
		$old = $_POST;
		include('../functions/authentication_function.php');
		$result = profile_update();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:0');
		}
	}
	
?>
	<main>
	  <section>
	    <div class="container-fluid">
		  <div class="row">
			<!-- === sideber === -->
			<?php include('sideber.php'); ?>
			<!-- === main content === -->
			<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
			  <h1 class="mt-5">Profiles</h1>
			  <?php
			    echo '<h1 style="color:green;"> As-salamu alaykum, '.$_SESSION['auth']['email'].'</h1>';
			  ?>
			  <div class="card card-body py-5 shadow-sm border-0">
				   <h5 class="text-success fw-semibold">
				   <?php

						echo $success?? '';	
						
				   ?>
				   </h5>
				   <form action="" method="post" enctype="multipart/form-data">
					   <!-- === profile images === -->
					   <div class="col-md-6">
					      <label for="profile_image"><img src=../<?php echo ($_SESSION['auth']['image'] && ! empty($_SESSION['auth']['image']) ? $_SESSION['auth']['image'] : 'image/profile_image.jpg') ?> height="150px" width="150px;" class="border border-2 rounded-circle mb-3" alt="profile_images"></label>
						  <div class="input-group mb-3">
							 <input type="file" name="profile_image" class="form-control" id="profile_image" for="profile_image">
						  </div>
						  <span class="text-danger small"><?php echo $errors['profile_image']?? ''; ?></span>
					   </div>
					   <!-- === name === -->
					   <div class="mb-3">
						  <input type="text" name="name" value="<?php echo $old['name']?? $_SESSION['auth']['name'] ?? ''; ?>" class="form-control" placeholder="Name">
						  <span class="text-danger small"><?php echo $errors['name']?? ''; ?></span>
					   </div>
					   <!-- === phone === -->
					   <div class="mb-3">
						  <input type="text" name="phone" value="<?php echo $old['phone']?? $_SESSION['auth']['phone'] ?? ''; ?>" class="form-control" placeholder="Phone">
						  <span class="text-danger small"><?php echo $errors['phone']?? ''; ?></span>
					   </div>
					   <!-- === gender === -->
					   <div class="mb-3">
						  <label class="form-label">Gender</label>
						  <input class="form-check-input" type="radio" name="gender"
						  value="male" <?php echo (isset($old) && isset($old['gender']) ? ($old['gender'] == 'male' ? 'checked' : '') : ($_SESSION['auth']['gender'] == 'male' ? 'checked' : '')); ?> >
						  <label class="form-check-label">Male</label>
							
						  <input class="form-check-input" type="radio" name="gender"
						  value="female" <?php echo (isset($old) && isset($old['gender']) && $old['gender'] == 'female' ? 'checked' : ($_SESSION['auth']['gender'] == 'female' ? 'checked' : '')); ?> >
						  <label class="form-check-label" for="inlineRadio1">Female</label>
							
						  <span class="text-danger small"><?php echo $errors['gender']?? ''; ?></span>
					   </div>
					   <!-- === date of birth === -->
					   <div class="mb-3">
						  <label class="form-label">Date of Birth</label>
						  <input type="date" name="dob" value="<?php echo $old['dob']?? $_SESSION['auth']['dob'] ?? ''; ?>" class="form-control">
						  <span class="text-danger small"><?php echo $errors['dob']?? ''; ?></span>
					   </div>
					   <button type="submit" name="profile-update" class="btn btn-primary">Save</button>
					</form>
				 </div>
			</div>
		  </div>
		</div>
	  </section>
	</main>
	<?php include('footer.php'); ?>
