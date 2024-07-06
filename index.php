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
	    <?php include('home-slider.php'); ?>
		
		<!-- About me part--> 
	    <?php include('home-about.php'); ?>
		
		<!--Services part--> 
	    <?php include('home-service.php'); ?>
		
		<!-- portfilou part--> 
	    <?php include('home-portfilo.php'); ?>
		
		<!--review part--> 
	    <?php include('home-review.php'); ?>
		
		<!--contact part--> 
	    <?php include('home-contact.php'); ?>
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