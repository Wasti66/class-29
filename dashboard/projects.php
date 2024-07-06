<?php 

	include('header.php'); 
	include('../functions/projects_function.php');
	if(isset($_POST['projects_submission'])){
		$old = $_POST;
		$result = project_creat();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	$project_data = projects_view();
	//print_r($data);
	
	//status active/inactive
	if(isset($_POST['data_visibility'])){
		$result = data_visibility();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	
	if(isset($_POST['project_update'])){
		$result = project_update();
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
		$result = data_delete();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	// category array
	$categorys =[
						
		'all',
		'web-design',
		'web-development',
		'ui-ux-design',
		'seo'
	
	];
	
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
					<li class="breadcrumb-item active h5" aria-current="page">Projects</li>
				  </ol>
				 </nav>
			   </div>
			   <h5 class="text-success fw-semibold">
				   <?php

						echo $success?? '';	
						
				   ?>
			   </h5>
			   <!-- ==== projects form === -->
			   <form action="" method="post" enctype="multipart/form-data">
				   
				   <!-- === category === -->
				   <div class="mb-3">
					  <select class="form-select" type="text" name="category" aria-label="Default select example">
						 <option value="">category</option>
						 <?php
							foreach($categorys as $category){
						 ?>
							<option value="<?php echo $category; ?>" <?php echo(isset($old['category']) && $old['category'] == $category ? 'selected' : ''); ?>><?php echo ucwords(str_replace('-',' ',$category)); ?></option>
						 <?php	
							}
						 ?>
					  </select>
					  <span class="text-danger small"><?php echo $errors['category']?? ''; ?></span>
				   </div>
				   <!-- === name === -->
				   <div class="mb-3">
					  <input type="text" name="name" value="<?php echo $old['name']?? ''; ?>" class="form-control" placeholder="Name">
					  <span class="text-danger small"><?php echo $errors['name']?? ''; ?></span>
				   </div>
				   <!-- === images === -->
				   <div class="mb-3">
					  <label for="" class="form-label">Projects Images</label>
					  <input type="file" name="projects_image" value="<?php echo $old['projects_image']?? ''; ?>" class="form-control">
					  <span class="text-danger small"><?php echo $errors['projects_image']?? ''; ?></span>
				   </div>
				   <button type="submit" name="projects_submission" class="btn btn-primary">Save</button>
			    </form>
				<h3 class="my-4 fw-bold">Projects View</h3>
				<div class="table-responsive">
				  <table class="table table-hover table-bordered my-4">
					  <thead>
						<tr>
						  <th>Id</th>
						  <th>Name</th>
						  <th>Category</th>
						  <th>Images</th>
						  <th></th>
						</tr>
					  </thead>
					  <tbody>
					  <?php
						if(mysqli_num_rows($project_data) > 0){
							$i = 1;
							while($data = mysqli_fetch_assoc($project_data)){
					  ?> 		
						 
							<tr>
							  <td><?php echo $i++; ?></td>
							  <td><?php echo $data['name']; ?></td>
							  <td><?php echo ucwords($data['category']); ?></td>
							  <td><img src="../<?php echo $data['image']; ?>" height="60px" width="60px"></td>
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
										<form action="" method="post" enctype="multipart/form-data">
										   <input type="hidden" name="update_id" value="<?php echo $data['id']; ?>">
										   <!-- === projects images === -->
										   <div class="mb-3">
											  <label for="project_update_image"><img src="../<?php echo $data['image']; ?>" height="150px" width="150px;" class="border border-2 rounded-circle mb-3"></label>
											  <div class="input-group mb-3">
												 <input type="file" name="project_update_image" class="form-control" id="project_update_image" for="project_update_image">
											  </div>
											  <span class="text-danger small"><?php echo $errors['project_update_image']?? ''; ?></span>
										   </div>
										   <!-- === update name === -->
										   <div class="mb-3">
											  <input type="text" name="update_name" value="<?php echo $old['update_name']?? $data['name'] ?? ''; ?>" class="form-control" placeholder="Update Name">
											  <span class="text-danger small"><?php echo $errors['update_name']?? ''; ?></span>
										   </div>
										   <!-- === category === -->
										   <div class="mb-3">
											  <select class="form-select" type="text" name="update_category" aria-label="Default select example">
											    
												 <option value="">category</option>
												 <?php
													foreach($categorys as $category){
												  ?>
													<option value="<?php echo $category; ?>" <?php echo((isset($old['update_category']) && $old['update_category'] == $category) || $data['category'] == $category? 'selected' : ''); ?>><?php echo ucfirst(str_replace('-',' ',$category));?></option>
												  <?php	
														
													}
												  ?>
											  </select>
											  <span class="text-danger small"><?php echo $errors['update_category']?? ''; ?></span>
										   </div>
										   <button type="submit" name="project_update" class="btn btn-primary">Update</button>
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
