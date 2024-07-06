<?php

	include('functions/service_function.php');
	$service_data = active_service_view();

?>
<!--Services part--> 
<section id="service">
   <div class="container-md container-fluid">
	   <div class="text-center">
			<h6 class="text-primary mb-0 font-weigth-normal">My service</h6>
			<h1 class="text-uppercase text-white mb-4">What I Do</h1>
	   </div>
	 <!--service contact-->
	 <div class="row g-3">
		 <!--service 01-->
		 <?php
				if(mysqli_num_rows($service_data) > 0){
					
					while($data = mysqli_fetch_assoc($service_data)){
					?>
						<div class="col-lg-4 col-sm-6 mb-2">
							  <div class="card p-5 text-dark bg-light bg-opacity-75 border-0 shadow-sm text-center h-100 btn-outline-primary">
								  <h2 class="text-primary mb-4"><i class="<?php echo $data['service_icon']; ?>"></i></h2>
								  <h3 class="mb-4"><?php echo $data['service_name']; ?></h3>
								  <p class="px-2"><?php echo $data['service_dis']; ?></p>
							  </div> 
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