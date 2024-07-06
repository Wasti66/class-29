<?php
	
	if(isset($_POST['form-reg-btn'])){
		$old = $_POST;
		include('functions/authentication_function.php');
		$result = registration();
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:2;url=login.php');
		}
	}
	
?>
<div class="container">
	 <div class="row justify-content-center">
	   <div class="col-md-5">
		 <div class="card card-body py-5 shadow-sm border-0">
		   <h5 class="text-success fw-semibold">
		   <?php

				echo $success?? '';	
				
		   ?>
		   </h5>
		   <form action="" method="post">
		      <div class="row row-gap-3">
			    
				<div class="col-md-6">
				  <!-- === name === -->
				  <div class="mb-3">
					<input type="text" name="name" value="<?php echo $old['name']?? ''; ?>" class="form-control" placeholder="Name">
					<span class="text-danger small"><?php echo $errors['name']?? ''; ?></span>
				  </div>
				  <!-- === phone === -->
				  <div class="mb-3">
					<input type="text" name="phone" value="<?php echo $old['phone']?? ''; ?>" class="form-control" placeholder="Phone">
					<span class="text-danger small"><?php echo $errors['phone']?? ''; ?></span>
				  </div>
				</div>
				
				<div class="col-md-6">
				  <!-- === email === -->
				  <div class="mb-3">
					<input type="text" name="email" value="<?php echo $old['email']?? ''; ?>" class="form-control" placeholder="Email">
					<span class="text-danger small"><?php echo $errors['email']?? ''; ?></span>
				  </div>
				  <!-- === gender === -->
				  <div class="mb-3">
					<label class="form-label">Gender</label><br>
					<input class="form-check-input" type="radio" name="gender"
					value="male" <?php echo (isset($old) && isset($old['gender']) ? ($old['gender'] == 'male' ? 'checked' : '') : 'checked'); ?> >
					<label class="form-check-label">Male</label>
					
					<input class="form-check-input" type="radio" name="gender"
					value="female" <?php echo (isset($old) && isset($old['gender']) && $old['gender'] == 'female' ? 'checked' : ''); ?> >
					<label class="form-check-label" for="inlineRadio1">Female</label>
					
					<span class="text-danger small"><?php echo $errors['gender']?? ''; ?></span>
				  </div>
				</div>
			  </div>
			  <!-- === date of birth === -->
			  <div class="mb-3">
				<label class="form-label">Date of Birth</label>
				<input type="date" name="dob" value="<?php echo $old['dob']?? ''; ?>" class="form-control">
				<span class="text-danger small"><?php echo $errors['dob']?? ''; ?></span>
			  </div>
			  <!-- === password === -->
			  <div class="mb-3">
				<input type="password" name="password" class="form-control" placeholder="Password">
				<span class="text-danger small"><?php echo $errors['password']?? ''; ?></span>
			  </div>
			  <!-- === confirm password === -->
			  <div class="mb-3">
				<input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
				<span class="text-danger small"><?php echo $errors['confirm_password']?? ''; ?></span>
			  </div>
			  <button type="submit" name="form-reg-btn" class="btn btn-primary">Submit</button>
			</form>
		 </div>
	   </div>
	 </div>
</div>