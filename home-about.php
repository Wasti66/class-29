<?php
	include('functions/about_us_function.php');
	$about_us = about_us();
	$progress_view = progress_views();

?>
<!-- About me part--> 
<section id="about">
   <div class="container">
	  <div class="text-center">
		 <h6 class="text-info mb-0 font-weigth-normal"><?php echo $about_us['title']?? 'section-title'; ?></h6>
		<h1 class="text-uppercase mb-4 pb-3"><?php echo $about_us['subtitle']?? 'section-subtitle'; ?></h1>
		<p class="text-secondary mb-5"><?php echo $about_us['details']?? 'section-details'; ?></p>
	  </div>
	  <!--progress par-->
	  <div class="row justify-content-center mb-5" id="progress">
		 <?php
			if(mysqli_num_rows($progress_view) > 0){
				
				while($progress_data = mysqli_fetch_assoc($progress_view)){
				?>
					 <!--progress contant-->  
					 <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
						 <h6 class="mb-1"><?php echo $progress_data['content']; ?></h6>
						 <div class="progress">
						  <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $progress_data['color']; ?>" role=
						  "progressbar" style="width: <?php echo $progress_data['rate']; ?>"></div>
						 </div>
					 </div>
				<?php	
				}
				
			}else{
				echo 'Data not found';
			}
		 ?>
	  </div> 
	</div> 			  
</section>