
<?php
	
	if(isset($_GET['form-submit-btn'])){
		$old = $_GET;
		include('contact-form-action.php');
	}
	
?>

<!--contact part--> 
<section id="contact" class="bg-dark">
	<div class="container">
		<div class="text-center">
			 <h6 class="text-primary mb-0 font-weigth-normal">Find me</h6>
			 <h1 class="text-uppercase text-white mb-5">Contact me now</h1> 
			 <h5 class="text-uppercase text-warning"><?php echo $success?? ''; ?></h5> 
		</div>				
	  <form class="row g-2" name="contactForm" method="get">
		   <!--form part 01-->
		   <div class="col-sm-6">
				<!-- name -->
				<div class="form-group mb-3">
				   <input type="text" name="name" class="form-control bg-transparent" value="<?php echo $old['name']?? ''; ?>" placeholder="Enter your name">
				   <span id="name-error" class="small">
				     <?php 
						if(isset($errors['name'])){
							echo $errors['name'];
						}else{
							echo '';
						}
					 ?>
				   </span>
				</div>
				<!-- email -->	
				<div class="form-group mb-3">						
				   <input type="email" name="email" class="form-control bg-transparent" value="<?php echo $old['email']?? ''; ?>" placeholder="Enter your email">
				   <span id="email-error" class="small">
				     <?php echo isset($errors['email']) ? $errors['email'] : '' ?>
				   </span>
				</div> 
				<!-- phone -->
				<div class="form-group mb-3">   						
				   <input type="text" name="phone" class="form-control bg-transparent" value="<?php echo $old['phone']?? ''; ?>" placeholder="Enter your phone">
				   <span id="phone-error" class="small">
				     <?php echo $errors['phone'] ?? '' ?>
				   </span>
				</div>  
		   </div>
		   <!--form part 02-->
		   <div class="col-sm-6">
		      <!-- message -->
			  <div class="form-group">
				  <textarea name="message" class="form-control bg-transparent" placeholder="enter your messamg" style="height:145px;"><?php echo $old['message'] ?? ''; ?></textarea>
				  <span id="message-error" class="small">
				    <?php echo $errors['message'] ?? ''?>
				  </span>
			  </div>	
		   </div>
		   <div class="my-3 text-center w-100">
				<button type="submit" name="form-submit-btn" class="btn btn-lg btn-primary">Submit</button>  
		   </div> 				   				   
	  </form>
	  <!--address part-->
	  <div class="row mt-5 text-white" id="address">
		  <div class="col-sm-4 text-center">  
				  <h1 class="text-primary mb-3"><i class="fas fa-address-card"></i></h1>
				  <p>Address<br>Baganbari,panirtank,tnagail-1990</p>
		  </div>
		  <div class="col-sm-4 text-center col-6">
			  <h1 class="text-primary mb-3"><i class="fas fa-envelope-open-text"></i></h1>
			  <p>Email<br>Email:purnota54321@gmail.com</p>
		  </div>
		  <div class="col-sm-4 text-center col-6">
			  <h1 class="text-primary mb-3"><i class="fas fa-mobile-alt"></i></h1>
			  <p>Phone<br>01875822367</p>				  
		 </div>
	  </div>
	 </div>			  
</section>