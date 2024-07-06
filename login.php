<?php
	session_start();
	if(isset($_SESSION['auth'])){
		header('Location:dashboard/dashboard.php');	
	} 
	if(isset($_POST['login-submission'])){
		$old = $_POST;
		include('functions/authentication_function.php');
		$result = login();
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}
	}
							
?>
<!DOCTYPE HTML>
<html>
  <head>
	 <?php include('head.php'); ?>	  
  </head>
  
  <body data-bs-spy="scroll" data-bs-target="#main-nav" data-bs-offset="100">
     <header>
		<?php include('header.php'); ?>
     </header>	 
     <main>
	    <!-- slider part-->  
		<section id="home">
		   <div class="container text-cneter">
			 <h1 class="text-white fw-bold text-capitalize text-center">Login</h1>
		   </div>  		      		 
		</section>
		<!-- registration -->  
		<section class="bg-light">
		   	<div class="container">
				 <div class="row justify-content-center">
				   <div class="col-md-5">
					 <div class="card card-body py-5 shadow-sm border-0">
					   <h5 class="text-success fw-semibold">
					   <?php
							
							
							echo $success?? '';
							/* if(isset($success)){
								header('Location:registration.php');
							} */	
							
					   ?>
					   </h5>
					   <?php
						  if(isset($errors['email'])){
							  echo '<h6 class="px-1 py-2 border border-2 mb-4 bg-danger bg-opacity-75 text-white">'.$errors['email'].'</h6>';
						  }else{
							  echo '';
						  }
					   ?>
					   <form action="" method="post">
						  <!-- === email === -->
						  <div class="mb-3">
							<input type="text" name="email" 
							value="<?php echo $old['email']??$_COOKIE['email']?? ''; ?>" 
							class="form-control" placeholder="Email">
						  </div>
						  <!-- === password === -->
						  <div class="mb-3">
							<input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $_COOKIE['password']?? ''; ?>">
						  </div>
						  <!-- === remember me === -->
						  <div class="form-check mb-3">
							 <input class="form-check-input" type="checkbox" name="remember" value="remember" id="remember"
							 <?php echo (isset($_COOKIE['email']) && $_COOKIE['email']? 'checked' : '') ?> >
							 <label class="form-check-label" for="remember">
								Remember Me
							 </label>
						  </div>
						  <button type="submit" name="login-submission" class="btn btn-primary">Login</button>
						</form>
					 </div>
				   </div>
				 </div>
			</div>	      		 
		</section>
	 </main>
	 <footer class="my-md-3 py-5">
	     <?php include('footer.php'); ?>
	 </footer>
	 
	 <script src="js/bootstrap.bundle.min.js"></script>
	 <script src="js/pkgd.min.js"></script>
	 <!-- Optional JavaScript -->
     <!-- jQuery first, then Popper.js, then Bootstrap JS	  		
     <script src="js/jquery-3.5.1.js"></script>
     <script src="js/popper.min.js"></script>
	 <script rel="script" src="js/custom.js"></script>-->
	 
	<script>
		var elem = document.querySelector('.prid');
		var iso = new Isotope( elem, {
		  // options
		  itemSelector: '.prid-elm',
		  layoutMode: 'fitRows'
		});

		// bind filter button click
		var filtersElem = document.querySelector('.filters-button-group');
		filtersElem.addEventListener( 'click', function( event ) {
		  // only work with buttons
		  if ( !matchesSelector( event.target, 'button' ) ) {
			return;
		  }
		  var filterValue = event.target.getAttribute('data-filter');
		  // use matching filter function
		  //filterValue = filterFns[ filterValue ] || filterValue;
		  iso.arrange({ filter: filterValue });
		  filtersElem.querySelector('.active').classList.remove('active');
		  event.target.classList.add('active');
		});
		// change is-checked class on buttons
		/* var buttonGroups = document.querySelectorAll('.filters-button-group');
		for ( var i=0, len = buttonGroups.length; i < len; i++ ) {
		  var buttonGroup = buttonGroups[i];
		  radioButtonGroup( buttonGroup );
		}

		function radioButtonGroup( buttonGroup ) {
		  buttonGroup.addEventListener( 'click', function( event ) {
			// only work with buttons
			if ( !matchesSelector( event.target, 'button' ) ) {
			  return;
			}
			buttonGroup.querySelector('.active').classList.remove('active');
			event.target.classList.add('is-checked');
		  });
		} */

	</script>
	
  </body>

</html>