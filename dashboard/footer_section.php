<?php 

	include('header.php'); 
	include('../functions/footer_section_function.php');
	if(isset($_POST['footer_title_submission'])){
		$old = $_POST;
		$result = footer_title_create();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	$footer_title_view = footer_title_view();
	//print_r($footer_title_view);
	
	
	// footer
	if(isset($_POST['footer_submission'])){
		$old = $_POST;
		$result = footer_create();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	//footer data view
	$footer_view = footer_view();
	
	//status active/inactive
	if(isset($_POST['data_visibility'])){
		$result = footer_visibility();
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	if(isset($_POST['footer_update'])){
		$result = footer_update();
		$old = $_POST;
		//print_r($result);
		if($result['status'] == 'error'){
			$errors = $result['message'];
		}else{
			$success = $result['message'];
			header('refresh:1');
		}
		
	}
	if(isset($_POST['footer_delete'])){
		$result = footer_delete();
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
					<li class="breadcrumb-item active h5" aria-current="page">Footer</li>
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
				   <!-- === footer title === -->
				   <div class="mb-3">
					  <input type="name" name="footer_title" value="<?php echo $old['title']??$footer_title_view['footer_title']?? ''; ?>" class="form-control" placeholder="Footer Title">
					  <span class="text-danger small"><?php echo $errors['footer_title']?? ''; ?></span>
				   </div>
				   <button type="submit" name="footer_title_submission" class="btn btn-primary">Save</button>
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
			   <!-- ==== progress form === -->
			   <form action="" method="post">
				   <!-- === social_icon === -->
				   <div class="mb-3">
					  <input type="text" name="social_icon" value="<?php echo $old['social_icon']?? ''; ?>" class="form-control" placeholder="Social Icon">
					  <span class="text-danger small"><?php echo $errors['social_icon']?? ''; ?></span>
				   </div>
				   <!-- === social_url === -->
				   <div class="mb-3">
					  <input type="text" name="social_url" value="<?php echo $old['social_url']?? ''; ?>" class="form-control" placeholder="Social Url">
					  <span class="text-danger small"><?php echo $errors['social_url']?? ''; ?></span>
				   </div>
				   <button type="submit" name="footer_submission" class="btn btn-primary">Save</button>
			    </form>
				<h3 class="my-4 fw-bold">About us View</h3>
				<div class="table-responsive">
				  <table class="table table-hover table-bordered my-4">
					  <thead>
						<tr>
						  <th>Id</th>
						  <th>Social Icon</th>
						  <th>Sociale Url</th>
						  <th></th>
						</tr>
					  </thead>
					  <tbody>
					  <?php
						if(mysqli_num_rows($footer_view) > 0){
							$i = 1;
							while($data = mysqli_fetch_assoc($footer_view)){
					  ?> 		
						 
							<tr>
							  <td><?php echo $i++; ?></td>
							  <td><i class="<?php echo $data['social_icon']; ?>"></i></td>
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
										<input type="hidden" name="footer_delete_id" value="<?php echo $data['id']; ?>">
										<button type="submit" name="footer_delete" class="btn btn-sm ms-1 btn-danger">
										  <i class="fas fa-trash-alt"></i>
										</button>
									</form>
								</div>
								<!-- Modal -->
								<div class="modal fade" id="update_projetc-<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-scrollable  modal-dialog-centered">
									<div class="modal-content">
									  <div class="modal-header">
										<h1 class="modal-title fs-5" id="exampleModalLabel">About us Update</h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									  </div>
									  <div class="modal-body">
										<form action="" method="post">
										   <input type="hidden" name="footer_id" value="<?php echo $data['id']; ?>">
										   <!-- === social icon === -->
										   <div class="mb-3">
											  <input type="text" name="social_icon" value="<?php echo $old['social_icon']?? $data['social_icon'] ?? ''; ?>" class="form-control">
											  <span class="text-danger small"><?php echo $errors['social_icon']?? ''; ?></span>
										   </div>
										   <!-- === content === -->
										   <div class="mb-3">
											  <input type="text" name="url_content" value="<?php echo $old['url_content']?? $data['content'] ?? ''; ?>" class="form-control" placeholder="">
											  <span class="text-danger small"><?php echo $errors['url_content']?? ''; ?></span>
										   </div>
										   <button type="submit" name="footer_update" class="btn btn-primary">Update</button>
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
