<?php
	include('functions/home_function.php');
	$home_view = home();
?>
<!-- slider part--> 
<section id="home" class="bg-dark pb-0 position-relative">
   <div class="container">
	 <div class="row g-0 justify-content-between">
		<div class="col-6 align-self-end pb-sm-5 pb-4 mb-md-5">
		   <!--contact part-->
		   <p class="text-warning text-uppercase mb-1"><?php echo $home_view['title']; ?></p>
		   <h5 class="text-white text-uppercase mb-1 h6-sm"><?php echo $home_view['subtitle']; ?></h5>
		   <h2 class="text-warning h5-sm text-uppercase"><?php echo $home_view['details']; ?></h2>
		   <button class="btn btn-light rounded-pill px-sm-4 py-0 py-sm-2" style="background-color:white;color:#5b98f3;">My work</button>
		   <button class="btn btn-primary rounded-pill px-sm-4 py-0 py-sm-2">Here me</button> 
		</div>
		<div class="col-5">
			<!--personal part-->
			<img class="img-fluid mt-5" src="<?php echo $home_view['images']; ?>" alt="<?php echo $home_view['images']; ?>">
		</div>
	 </div>
   </div>  		      		 
</section>