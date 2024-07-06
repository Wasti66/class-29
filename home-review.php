<?php

	include('functions/progress_function.php');
	$progress_data = progress_view();
	
?>
<!--review part--> 
<section id="review">
	 <div class="container">
		 <!--review contant-->
		 <div class="row">
			<?php
				if(mysqli_num_rows($progress_data) > 0){
					
					while($data = mysqli_fetch_assoc($progress_data)){
					?>
						<div class="col-6 col-md-6 col-lg-2 text-center">
							 <h2 class="text-primary mb-4"><i class="<?php echo $data['icon']; ?>"></i></h2>
							 <h3 class="font-weigth-bold text-primary counter"><?php echo $data['number']; ?></h3>
							 <h6 class="text-primary"><?php echo $data['name']; ?></h6>
						</div>
					<?php	
						
					}
					
				}else{
					echo 'Data not found..';
				}
			?>
		 </div>
	 </div> 
</section>