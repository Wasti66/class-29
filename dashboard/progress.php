<?php 

	include('header.php'); 
	include('../functions/progress_function.php');
	if(isset($_POST['progress_submission'])){
		$old = $_POST;
		$result = progress_create();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	$progress_data = progress_view();
	//print_r($data);
	
	//status active/inactive
	if(isset($_POST['data_visibility'])){
		$result = progress_data_visibility();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	
	if(isset($_POST['progress_update'])){
		$result = progress_update();
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
		$result = progress_data_delete();
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
			   <?php
			   
					if(isset($errors) && isset($errors['overload'])){
						echo '<h6 class="text-danger">'.$errors["overload"].'</h6>';
					}
			   
			   ?>
			   <!-- ==== progress form === -->
			   <form action="" method="post" enctype="multipart/form-data">
				   
				   <!-- === icon === -->
				   <div class="mb-3">
					  <input type="text" name="icon" value="<?php echo $old['icon']?? ''; ?>" class="form-control" placeholder="icon">
					  <span class="text-danger small"><?php echo $errors['icon']?? ''; ?></span>
				   </div>
				   <!-- === number === -->
				   <div class="mb-3">
					  <input type="text" name="progress_num" value="<?php echo $old['progress_num']?? ''; ?>" class="form-control" placeholder="progress number">
					  <span class="text-danger small"><?php echo $errors['progress_num']?? ''; ?></span>
				   </div>
				   <!-- === title === -->
				   <div class="mb-3">
					  <input type="name" name="name" value="<?php echo $old['name']?? ''; ?>" class="form-control" placeholder="Title">
					  <span class="text-danger small"><?php echo $errors['name']?? ''; ?></span>
				   </div>
				   <button type="submit" name="progress_submission" class="btn btn-primary">Save</button>
			    </form>
				<h3 class="my-4 fw-bold">Progress View</h3>
				<div class="table-responsive">
				  <table class="table table-hover table-bordered my-4">
					  <thead>
						<tr>
						  <th>Id</th>
						  <th>Icon</th>
						  <th>Progress number</th>
						  <th>Title</th>
						  <th></th>
						</tr>
					  </thead>
					  <tbody>
					  <?php
						if(mysqli_num_rows($progress_data) > 0){
							$i = 1;
							while($data = mysqli_fetch_assoc($progress_data)){
					  ?> 		
						 
							<tr>
							  <td><?php echo $i++; ?></td>
							  <td>
								<i class="<?php echo $data['icon']; ?>"></i>
							  </td>
							  <td><?php echo $data['number']; ?></td>
							  <td><?php echo ucwords($data['name']); ?></td>
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
										<h5 class="text-success fw-semibold">
										   <?php

												echo $success?? '';	
												
										   ?>
										</h5>
										<form action="" method="post">
										   <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
										   <!-- === icon === -->
										   <div class="mb-3">
											  <input type="text" name="icon" value="<?php echo $old['icon']?? $data['icon'] ?? ''; ?>" class="form-control" placeholder="icon">
											  <span class="text-danger small"><?php echo $errors['icon']?? ''; ?></span>
										   </div>
										   <!-- === number === -->
										   <div class="mb-3">
											  <input type="text" name="progress_num" value="<?php echo $old['progress_num']?? $data['number'] ?? ''; ?>" class="form-control" placeholder="progress number">
											  <span class="text-danger small"><?php echo $errors['progress_num']?? ''; ?></span>
										   </div>
										   <!-- === update title === -->
										   <div class="mb-3">
											  <input type="text" name="name" value="<?php echo $old['name']?? $data['name'] ?? ''; ?>" class="form-control" placeholder="Update Name">
											  <span class="text-danger small"><?php echo $errors['update_name']?? ''; ?></span>
										   </div>
										   
										   <button type="submit" name="progress_update" class="btn btn-primary">Update</button>
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
