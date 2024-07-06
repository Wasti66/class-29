<style>
  .btn.active{
	  background-color:#0d6efd!important;
  }
</style>
<?php

	include('functions/projects_function.php');
	$project_data = projects_active_view();
		
	$categories = $rows = [];
	if(mysqli_num_rows($project_data) > 0){
		while($row = mysqli_fetch_assoc($project_data)){
			$categories[] = $row['category'];
			$rows[] = [
				'category' => $row['category'],
				'name' => $row['name'],
				'image' => $row['image'],
				'status' => $row['status'],
			];
		}	
	}
?>
<!-- portfilou part--> 
<section id="project">
	<div class="container">
		<div class="text-center">
			 <h6 class="text-primary mb-0 font-weigth-normal">View all</h6>
			 <h1 class="text-uppercase mb-5">My projects</h1>
			 <div class="btn-group mb-4 filters-button-group">
				<button type="button" class="btn btn-outline-primary btn-sm active" data-filter="*">All</button>
				<?php
					if(count($categories) >0){
						foreach(array_unique($categories) as $category){
					?>
						<button type="button" class="btn btn-outline-primary btn-sm" data-filter=".<?php echo $category; ?>"><?php echo ucwords(str_replace('-',' ',$category)); ?></button>
					<?php	
						}
					}else{
					?>
						<button type="button" class="btn btn-outline-primary btn-sm" data-filter=".web-design">Web Design</button>
						<button type="button" class="btn btn-outline-primary btn-sm" data-filter=".web-development">Web Development</button>
						<button type="button" class="btn btn-outline-primary btn-sm" data-filter=".ui-ux-design">UI UX Design</button>
						<button type="button" class="btn btn-outline-primary btn-sm" data-filter=".seo">SEO</button>
					<?php	
					}
				?>
			 </div>	
		</div>
	  <!--portfolio part-->
	  <div class="row g-3 justify-content-center prid mb-5">
		  <?php
			if(count($rows) > 0){
				
				foreach($rows as $data){
				?>
					<div class="col-lg-4 col-sm-6 mb-2 prid-elm <?php echo $data['category'];?>">
							 <!--photo 01-->
							 <div class="card h-100">
								 <img class="card-img d-block" src="<?php echo $data['image'];?>" alt="<?php echo $data['name'];?>">
								 <div class="card-img-overlay top-auto card-hover-visible p-2">
									<div class="d-grid">
									  <a class="btn btn-dark btn-block" href="image/work-2.jpg" data-lightbox="image-1" data-title="My caption">View all</a>
									</div> 
								 </div>
							 </div>
					    </div>
				<?php
				}
			}else{
				echo 'No Data Found..';
			}
		  ?> 		  
	  </div>
	 </div> 
</section>