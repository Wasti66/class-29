<?php 

	include('header.php'); 
	include('../functions/contact_info_function.php');
	if(isset($_POST['contact_submission'])){
		$old = $_POST;
		$result = contact_create();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	$contact_view = contact_view();
	//print_r($contact_view);
	
	
	// address_create
	if(isset($_POST['address_submission'])){
		$old = $_POST;
		$result = address_create();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	//address data view
	$address_view = address_view();
	
	//status active/inactive
	if(isset($_POST['data_visibility'])){
		$result = address_visibility();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	if(isset($_POST['address_updates'])){
		$result = address_updates();
		$old = $_POST;
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	if(isset($_POST['address_delete'])){
		$result = address_delete();
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
					<li class="breadcrumb-item active h5" aria-current="page">COntact info</li>
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
				   <!-- === title === -->
				   <div class="mb-3">
					  <input type="name" name="title" value="<?php echo $old['title']??$contact_view['title']?? ''; ?>" class="form-control" placeholder="Title">
					  <span class="text-danger small"><?php echo $errors['title']?? ''; ?></span>
				   </div>
				   <!-- === subtitle=== -->
				   <div class="mb-3">
					  <input type="name" name="subtitle" value="<?php echo $old['subtitle']??$contact_view['subtitle']?? ''; ?>" class="form-control" placeholder="Subtitle">
					  <span class="text-danger small"><?php echo $errors['subtitle']?? ''; ?></span>
				   </div>
				   <button type="submit" name="contact_submission" class="btn btn-primary">Save</button>
			    </form>
			</div>
		  </div>
		</div>
	  </section>
	  
	  <section class="pt-5 pb-5">
	    <div class="container-fluid">
		  <div class="row">
			<!-- === main content === -->
			<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
			   <h5 class="text-success fw-semibold">
				   <?php

						echo $success?? '';	
						
				   ?>
			   </h5>
			   <!-- ==== address form === -->
			   <form action="" method="post">
				   <!-- === about us progress name === -->
				   <div class="mb-3">
					  <input type="text" name="icon" value="<?php echo $old['icon']?? ''; ?>" class="form-control" placeholder="Address Icon">
					  <span class="text-danger small"><?php echo $errors['icon']?? ''; ?></span>
				   </div>
				   <!-- === address-title === -->
				   <div class="mb-3">
					  <input type="text" name="address_title" value="<?php echo $old['address_title']?? ''; ?>" class="form-control" placeholder="Address Title">
					  <span class="text-danger small"><?php echo $errors['address_title']?? ''; ?></span>
				   </div>
				   <button type="submit" name="address_submission" class="btn btn-primary">Save</button>
			    </form>
				<h3 class="my-4 fw-bold">Address view</h3>
				<div class="table-responsive">
				  <table class="table table-hover table-bordered my-4">
					  <thead>
						<tr>
						  <th>Id</th>
						  <th>Address Icon</th>
						  <th>Progress Title</th>
						  <th></th>
						</tr>
					  </thead>
					  <tbody>
					  <?php
						if(mysqli_num_rows($address_view) > 0){
							$i = 1;
							while($data = mysqli_fetch_assoc($address_view)){
					  ?> 		
						 
							<tr>
							  <td><?php echo $i++; ?></td>
							  <td><i class="<?php echo $data['icon']; ?>"></i></td>
							  <td><?php echo $data['content']; ?></td>
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
										<input type="hidden" name="address_delete_id" value="<?php echo $data['id']; ?>">
										<button type="submit" name="address_delete" class="btn btn-sm ms-1 btn-danger">
										  <i class="fas fa-trash-alt"></i>
										</button>
									</form>
								</div>
								<!-- Modal -->
								<div class="modal fade" id="update_projetc-<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-scrollable  modal-dialog-centered">
									<div class="modal-content">
									  <div class="modal-header">
										<h1 class="modal-title fs-5" id="exampleModalLabel">Address Update</h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									  </div>
									  <div class="modal-body">
										<form action="" method="post">
										   <input type="hidden" name="address_id" value="<?php echo $data['id']; ?>">
										   <!-- === update progress name === -->
										   <div class="mb-3">
											  <input type="text" name="icon" value="<?php echo $old['icon']?? $data['icon'] ?? ''; ?>" class="form-control">
											  <span class="text-danger small"><?php echo $errors['progress_name']?? ''; ?></span>
										   </div>
										   <!-- === update progress rate === -->
										   <div class="mb-3">
											  <input type="text" name="content" value="<?php echo $old['content']?? $data['content'] ?? ''; ?>" class="form-control" placeholder="">
											  <span class="text-danger small"><?php echo $errors['progress_rate']?? ''; ?></span>
										   </div>
										   <button type="submit" name="address_updates" class="btn btn-primary">Update</button>
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
