<?php
	include('functions/footer_section_function.php');
	$footer_title_view = footer_title_view();
	$footer_view = footer_view();
?>
<div class="container">
 <div class="row">
   <!-- social media part-->
   <nav class="col-md-4 align-self-center order-md-12" id="social-link">
	   <ul class="nav justify-content-md-end justify-content-center">
		 <?php
			if(mysqli_num_rows($footer_view) > 0){
				while($data = mysqli_fetch_assoc($footer_view)){
				?>
					<li><a href="<?php echo $data['content']; ?>" class="btn btn-light btn-outline-primary rounded-circle" ><i class="<?php echo $data['social_icon']; ?>"></i></a></li>
				<?php	
				}
			}
		 ?>
	   </ul> 			   
   </nav>			 
   <!--copyright part-->
   <div class="col-md-8 align-self-center py-3 text-md-left text-center">
	  <?php echo $footer_title_view['footer_title']??'footer-title'?? '';?>
   </div>
  </div>  
</div>
<div class="upper text-end me-4">
   <i class="fas fa-chevron-up bg-primary text-white p-3 rounded-circle"></i>
</div>