<?php include('header.php'); ?>
	<main>
	  <section>
	    <div class="container-fluid">
		  <div class="row">
			<!-- === sideber === -->
			<?php include('sideber.php'); ?>
			<!-- === main content === -->
			<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
			  <h1 class="mt-5">Dashboard</h1>
			  <?php
			    echo '<h1 style="color:green;"> As-salamu alaykum, '.$_SESSION['auth']['name'].'</h1>';
			  ?>
			</div>
		  </div>
		</div>
	  </section>
	</main>
	<?php include('footer.php'); ?>
