<?php 

	include('header.php'); 
	include('../functions/service_function.php');
	if(isset($_POST['service_submission'])){
		$old = $_POST;
		$result = service_create();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	$service_data = service_view();
	//print_r($data);
	
	//status active/inactive
	if(isset($_POST['data_visibility'])){
		$result = service_data_visibility();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	
	if(isset($_POST['service_update'])){
		$result = service_update();
		$old = $_POST;
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	if(isset($_POST['data_delete'])){
		$result = service_data_delete();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
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
			   <div class="card bg-secondary-subtle p-3 my-5 border-0 shadow-sm"> 
				 <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0">
					<li class="breadcrumb-item"><a href="dashboard.php" class="h5">Home</a></li>
					<li class="breadcrumb-item active h5" aria-current="page">Progress</li>
				  </ol>
				 </nav>
			   </div>
			   <h5 class="text-success fw-semibold">
				   <?php

						echo $success?? '';	
						
				   ?>
			   </h5>
			   <!-- ==== progress form === -->
			   <form action="" method="post">
				   
				   <!-- === icon === -->
				   <div class="mb-3">
					  <input type="text" name="service_icon" value="<?php echo $old['service_icon']?? ''; ?>" class="form-control" placeholder="Service icon">
					  <span class="text-danger small"><?php echo $errors['service_icon']?? ''; ?></span>
				   </div>
				   <!-- === service name === -->
				   <div class="mb-3">
					  <input type="name" name="service_name" value="<?php echo $old['service_name']?? ''; ?>" class="form-control" placeholder="Service title">
					  <span class="text-danger small"><?php echo $errors['service_name']?? ''; ?></span>
				   </div>
				   <!-- === service discreption === -->
				   <div class="mb-3">
					  <textarea class="form-control" 
					  placeholder="Service discreption" type="text" name="service_dis" rows="5"><?php echo $old['service_dis']?? ''; ?></textarea>
					  <span class="text-danger small"><?php echo $errors['service_dis']?? ''; ?></span>
				   </div>
				   <button type="submit" name="service_submission" class="btn btn-primary">Save</button>
			    </form>
				<h3 class="my-4 fw-bold">Progress View</h3>
				<div class="table-responsive">
				  <table class="table table-hover table-bordered my-4">
					  <thead>
						<tr>
						  <th>Id</th>
						  <th>Icon</th>
						  <th>Service Title</th>
						  <th>Service discreption</th>
						  <th></th>
						</tr>
					  </thead>
					  <tbody>
					  <?php
						if(mysqli_num_rows($service_data) > 0){
							$i = 1;
							while($data = mysqli_fetch_assoc($service_data)){
					  ?> 		
						 
							<tr>
							  <td><?php echo $i++; ?></td>
							  <td>
								<i class="<?php echo $data['service_icon']; ?>"></i>
							  </td>
							  <td><?php echo ucwords($data['service_name']); ?></td>
							  <td><?php echo $data['service_dis']; ?></td>
							  <td>
							    <div class="d-flex justify-content-center aligh-items-center">
									<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update_projetc-<?php echo $data['id']; ?>">Edit</button>
									<form method="post">
										<input type="hidden" name="visibility_id" value="<?php echo $data['id']; ?>">
										<button type="submit" name="data_visibility" class="btn btn-sm ms-1 btn-<?php echo ($data['status'] == 0 ? 'warning' : 'success'); ?>">
										  <i class="fa fa-eye <?php echo ($data['status'] == 0 ? 'fa-eye-slash' : ''); ?>"></i>
										</button>
									</form>
									<!-- === delete btn === -->
									<form method="post" onsubmit="if(!confirm('Do you want to delete data ?')){return false;}">
										<input type="hidden" name="delete_id" value="<?php echo $data['id']; ?>">
										<button type="submit" name="data_delete" class="btn btn-sm ms-1 btn-danger">
										  <i class="fas fa-trash-alt"></i>
										</button>
									</form>
								</div>
								<!-- Modal -->
								<div class="modal fade" id="update_projetc-<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-scrollable  modal-dialog-centered">
									<div class="modal-content">
									  <div class="modal-header">
										<h1 class="modal-title fs-5" id="exampleModalLabel">Projects Update</h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									  </div>
									  <div class="modal-body">
										
										<form action="" method="post">
										   <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
										   <!-- === icon === -->
										   <div class="mb-3">
											  <input type="text" name="up_service_icon" value="<?php echo $old['up_service_icon']?? $data['service_icon'] ?? ''; ?>" class="form-control" placeholder="icon">
											  <span class="text-danger small"><?php echo $errors['up_service_icon']?? ''; ?></span>
										   </div>
										   <!-- === title === -->
										   <div class="mb-3">
											  <input type="text" name="up_service_name" value="<?php echo $old['up_service_name']?? $data['service_name'] ?? ''; ?>" class="form-control" placeholder="progress number">
											  <span class="text-danger small"><?php echo $errors['up_service_name']?? ''; ?></span>
										   </div>
										   <!-- === update discreption === -->
										   <div class="mb-3">
										      <textarea class="form-control" 
											  placeholder="Service discreption" type="text" name="up_service_dis" rows="5"><?php echo $old['up_service_dis']?? $data['service_dis'] ?? ''; ?></textarea>
											  <span class="text-danger small"><?php echo $errors['up_service_dis']?? ''; ?></span>
										   </div>
										   
										   <button type="submit" name="service_update" class="btn btn-primary">Update</button>
										</form>
										
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									  </div>
									</div>
								  </div>
								</div>
							  </td>
							</tr>
						  
						<?php
							}
						}else{
						?> 
							<tr>
							  <td colspan="5" class="text-danger">No data found</td>	
							</tr>
							
						<?php	
							
						}
						 
					  ?>
					  </tbody>
				  </table>
			    </div>
			</div>
		  </div>
		</div>
	  </section>
	</main>
	<?php include('footer.php'); ?>
