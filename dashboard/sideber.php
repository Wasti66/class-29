<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary top-0 start-0 end-0 bottom-0">
  <div class="offcanvas-md offcanvas-start bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
	<div class="offcanvas-header">
	  <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
	  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
	  <ul class="nav flex-column">
		<li class="nav-item">
		  <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="dashboard.php">
			<i class="fas fa-home"></i>
			Dashboard
		  </a>
		</li>
	  </ul>

	  <hr class="my-3">

	  <ul class="nav flex-column mb-auto">
		<!-- === about us === -->
		<li class="nav-item">
		  <a class="nav-link d-flex align-items-center gap-2" href="about_us.php">
			<i class="far fa-address-card"></i>
			About us
		  </a>
		</li>
		<!-- === Service === -->
		<li class="nav-item">
		  <a class="nav-link d-flex align-items-center gap-2" href="service.php">
			<i class="fab fa-servicestack"></i>
			Service
		  </a>
		</li>
		<!-- === projects === -->
		<li class="nav-item">
		  <a class="nav-link d-flex align-items-center gap-2" href="projects.php">
			<i class="fas fa-tasks"></i>
			Projects
		  </a>
		</li>
		<!-- === status === -->
		<li class="nav-item">
		  <a class="nav-link d-flex align-items-center gap-2" href="progress.php">
			<i class="fas fa-trophy"></i>
			Progress
		  </a>
		</li>
		<!-- === Settings/profile === -->
		<li class="nav-item">
		  <a class="nav-link d-flex align-items-center gap-2" href="profiles.php">
			<i class="fas fa-cog"></i>
			Settings
		  </a>
		</li>
		<li class="nav-item">
		  <a class="nav-link d-flex align-items-center gap-2" href="#">
			<i class="fas fa-sign-out-alt"></i>
			<form method="post">
			  <input type="submit" class="btn px-0 py-0 border-0 nav-link" value="Sing Out" name="logout_submission">
			</form>
		  </a>
		</li>
	  </ul>
	</div>
  </div>
</div>