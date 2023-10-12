<?php
class General{
	public function header(){
		?>

		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Blog Website</title>
			<!-- <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> -->
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
			<link rel="stylesheet" href="main/main.css">
			<link rel="stylesheet" href="main/sidebars.css">
		    <!--Datatable-->
		    <link rel="stylesheet" type="text/css" href="main/jquery.dataTables.min.css">
    		<script type="text/javascript" src="main/jquery-3.7.0.js"></script>
    		<script type="text/javascript" src="main/jquery.dataTables.min.js" defer></script>
		    <!--Datatable-->
		    <link rel="stylesheet" href="select2/dist/css/select2.min.css">
		</head>
		<body>

		<?php
	}

	public function footer(){
		?>

		<!--Footer Container Start-->
	  <div class="container-fluid px-0 mx-0 mt-2">
	            <!--Footer Start-->		
    	<div class="row bg-warning text-light mx-0 p-2">
        	<div class="col-md-4">
            	<h4>Our Website</h4>
            	<p>We are Blog Website copyright @ HIST, Jamshoro</p>
        	</div>
        	<div class="col-md-4">
            	<h4>Quick Links</h4>
            	<ul class="list-unstyled">
                	<li><a href="index.php" class="text-light">Home</a></li>
                	<li><a href="about-page.php" class="text-light">About Us</a></li>
                	<li><a href="blogs-page.php" class="text-light">Blogs</a></li>
                	<li><a href="contact-page.php" class="text-light">Contact Us</a></li>
                	<?php

                	if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) {
                		?>
                	    <li><a href="admin-dashboard.php" class="text-light">Dashboard</a></li>
                		<?php
                	}

                	 ?>
            	</ul>
        	</div>
        	<div class="col-md-4">
            	<h4>Follow Us</h4>
            	<div class="social-icons">
                	<a href="#"><img src="icons/facebook-icon.png" style="width: 20px; height: 20px;"></a>
                	<a href="#"><img src="icons/twitter-icon.svg" style="width: 20px; height: 20px;"></a>
                	<a href="#"><img src="icons/instagram-icon.svg" style="width: 20px; height: 20px;"></a>
            	</div>
        	</div>
    	</div>
	            <!--Footer End-->		
      </div>
     <!--Footer Container End-->	



	<!-- <script type="text/javascript" src="bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

	<script type="text/javascript" src="main/sidebars.js"></script>
	<script type="text/javascript" src="main/main.js"></script>
	<script type="text/javascript" src="select2/dist/js/select2.min.js"></script>



</body>
</html>

		<?php
	}

	public function footer_fixed(){

		?>

		<!--Footer Container Start-->
	  <div class="container-fluid px-0 mx-0 mt-2 fixed-bottom">
	            <!--Footer Start-->		
    	<div class="row bg-warning text-light mx-0 p-2">
        	<div class="col-md-4">
            	<h4>Our Website</h4>
            	<p>We are Blog Website copyright @ HIST, Jamshoro</p>
        	</div>
        	<div class="col-md-4">
            	<h4>Quick Links</h4>
            	<ul class="list-unstyled">
                	<li><a href="index.php" class="text-light">Home</a></li>
                	<li><a href="about-page.php" class="text-light">About Us</a></li>
                	<li><a href="blogs-page.php" class="text-light">Blogs</a></li>
                	<li><a href="contact-page.php" class="text-light">Contact Us</a></li>
                	<?php

                	if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) {
                		?>
                	    <li><a href="admin-dashboard.php" class="text-light">Dashboard</a></li>
                		<?php
                	}

                	 ?>
            	</ul>
        	</div>
        	<div class="col-md-4">
            	<h4>Follow Us</h4>
            	<div class="social-icons">
                	<a href="#"><img src="icons/facebook-icon.png" style="width: 20px; height: 20px;"></a>
                	<a href="#"><img src="icons/twitter-icon.svg" style="width: 20px; height: 20px;"></a>
                	<a href="#"><img src="icons/instagram-icon.svg" style="width: 20px; height: 20px;"></a>
            	</div>
        	</div>
    	</div>
	            <!--Footer End-->		
      </div>
     <!--Footer Container End-->	



	<!-- <script type="text/javascript" src="bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

	<script type="text/javascript" src="main/sidebars.js"></script>
	<script type="text/javascript" src="main/main.js"></script>


</body>
</html>

		<?php

	}

	public function navbar(){
		?>

		<!--Navbar Container Start-->
		<div class="container-fluid px-0">
			
			<!--Navbar Start-->

			<nav class="navbar navbar-expand-lg bg-warning fixed-top">
	  			<div class="container-fluid">
	    			<a class="navbar-brand" href="index.php">
	    				<img src="images/logo2.jpg" alt="Bootstrap" width="40" height="40" style="border-radius: 50%;">
	    			</a>
	    			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      			<span class="navbar-toggler-icon"></span>
	    			</button>
	    			<div class="collapse navbar-collapse" id="navbarSupportedContent">
	      			 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	       			 <li class="nav-item">
	          			<a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
	        		 </li>
	        		 <li class="nav-item">
	          			<a class="nav-link active text-light" aria-current="page" href="blogs-page.php">Blogs</a>
	        		 </li>
	        			<li class="nav-item">
	          			<a class="nav-link text-light" href="about-page.php">About Us</a>
	        			</li>
	        			
				        <li class="nav-item">
				          <a class="nav-link text-light" href="contact-page.php">Contact Us</a>
				        </li>
				        <?php
				        if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) {
				        	?>
				        	<li class="nav-item">
				          		<a class="nav-link text-light" href="admin-dashboard.php">Dashboard</a>
				        	</li>
				        	<?php
				        }
				         ?>
	      			</ul>
				      <form class="d-flex" role="search">
				      	<?php

				      	if (isset($_SESSION['user'])) {
				      		?>
						    <div class="box" style="display:flex; align-items: center; justify-content: center;">
						      	<img class="rounded-circle" src="Profile_Images/<?php echo $_SESSION['user']['profile_img']; ?>" style="width: 40px; height: 40px;">
						          <label class="text-center text-light m-1">
						            <?php echo $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']; ?>
						          </label>
						    </div>
						            <a class="btn btn-outline-danger m-1" href="edit-profile.php?user_id=<?php echo $_SESSION['user']['user_id']; ?>">Edit Profile</a>
						            <a class="btn btn-outline-danger m-1" href="logout.php">Logout</a>
				      		<?php
				      	}else{
				      	 ?>
				        <a class="btn btn-outline-danger m-1" href="login-page.php">Login</a>
				        <a class="btn btn-outline-danger m-1" href="register-page.php">Register</a>
				    	<?php } ?>
				      </form>
	    			</div>
	  			</div>
			</nav>

			<!--Navbar End-->

		</div>
	<!--Navbar Container End-->


		<?php
	}

	public function admin_main_start(){
		?>
		<div class="container-fluid border mx-0 px-0" style="margin-top: 70px;">

			<div class="row mx-0 px-0">
		<?php
	}

	public function admin_main_end(){
		?>
		</div>
	</div>
		<?php
	}

	public function admin_content_start(){
		?>
		<div class="col-md-9 mt-2 rounded border border-2 border-warning p-1" style="min-height: 80vh">
		<?php
	}

	public function admin_content_end(){
		?>
	</div>
		<?php
	}


	public function admin_sidebar(){
		?>

		<div class="col-md-3 mt-2 border border-2 border-warning rounded">
					<!--Side Bar Start-->
					<div class="flex-shrink-0 p-3" style="width: 280px;">
					    <ul class="list-unstyled ps-0">
					      <li class="mb-1">
					        <button class="text-warning btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#user-collapse" aria-expanded="false">
					          User
					        </button>
					        <div class="collapse" id="user-collapse">
					          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
					            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded text-warning" onclick="user_request()" style="cursor: pointer;">Requests</a></li>
					            <li><a onclick="add_user_form()" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-warning" style="cursor: pointer;">Add User</a></li>
					            <li><a onclick="view_users()" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-warning" style="cursor: pointer;">View Users</a></li>
					            <li><a onclick="rejected_users()" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-warning" style="cursor: pointer;">Rejected Users</a></li>
					          </ul>
					        </div>
					      </li>
					      <li class="mb-1">
					        <button class="text-warning btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#blog-collapse" aria-expanded="false">
					          Blog
					        </button>
					        <div class="collapse" id="blog-collapse">
					          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
					            <li><a onclick="add_blog_form()" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-warning" style="cursor: pointer;">Add Blog</a></li>
					            <li><a onclick="view_blogs()" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-warning" style="cursor: pointer;">View Blogs</a></li>
					          </ul>
					        </div>
					      </li>
					      <li class="mb-1">
					        <button class="text-warning btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#categories-collapse" aria-expanded="false">
					          Category
					        </button>
					        <div class="collapse" id="categories-collapse">
					          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
					            <li><a onclick="add_category_form()" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-warning" style="cursor: pointer;">Add Category</a></li>
					            <li><a onclick="view_categories()" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-warning" style="cursor: pointer;">View Categories</a></li>
					          </ul>
					        </div>
					      </li>
					      <li class="mb-1">
					        <button class="text-warning btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#posts-collapse" aria-expanded="false">
					          Posts
					        </button>
					        <div class="collapse" id="posts-collapse">
					          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
					            <li><a onclick="add_post_form()" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-warning" style="cursor: pointer;">Add Post</a></li>
					            <li><a onclick="view_posts()" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-warning" style="cursor: pointer;">View Posts</a></li>
					          </ul>
					        </div>
					      </li>
					      <li class="mb-1">
					        <button class="text-warning btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#feedback-collapse" aria-expanded="false">
					          Feedback
					        </button>
					        <div class="collapse" id="feedback-collapse">
					          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
					            <li><a onclick="all_feedbacks()" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-warning" style="cursor: pointer;">All Feedbacks</a></li>
					            <li><a onclick="visitors_feedback()" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-warning" style="cursor: pointer;">Visitors Feedback</a></li>
					            <li><a onclick="users_feedback()" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-warning" style="cursor: pointer;">Users Feedback</a></li>
					          </ul>
					        </div>
					      </li>
					      <li class="border-top my-3"></li>
					      <li class="mb-1">
					        <button class="text-danger btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
					          Account
					        </button>
					        <div class="collapse" id="account-collapse">
					          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
					            <li><a href="edit-profile.php?user_id=<?php echo $_SESSION['user']['user_id']; ?>" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-danger">Edit Profile</a></li>
					            <li><a href="logout.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-danger">Logout out</a></li>
					          </ul>
					        </div>
					      </li>
					    </ul>
					</div>
					<!--Side Bar End-->

		</div>

		<?php
	}

	public function feedback_form(){
		?>
		<div class="row mt-2">
			<div class="col-md-2"></div>
			<div class="col-md-8 border border-2 border-warning rounded p-2">
			<form action="user-process.php" method="POST">
				<?php
				if (!isset($_SESSION['user'])) {
				 ?>
				<input type="hidden" name="user_id" value="">
				<div class="mb-3">
				  <label for="feedback_name" class="form-label">Name</label>
				  <input type="text" class="form-control" id="feedback_name" name="feedback_name" placeholder="Zubair Ali">
				</div>
				<div class="mb-3">
				  <label for="feedback_email" class="form-label">Email</label>
				  <input type="email" class="form-control" id="feedback_email" name="feedback_email" placeholder="name@example.com">
				</div>
				<div class="mb-3">
				  <label for="feedback" class="form-label">Feedback</label>
				  <textarea class="form-control" id="feedback" name="feedback" rows="3"></textarea>
				</div>
				<div class="d-grid gap-2">
				  <button class="btn btn-warning text-light" type="submit" name="add_feedback" value="add_feedback">Sumbit</button>
				</div>
				<?php
				 }else{
				 	?>
				 <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id']; ?>">
				  <input type="hidden" class="form-control" id="feedback_name" name="feedback_name" placeholder="Zubair Ali" value="<?php echo $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']; ?>">
				  <input type="hidden" class="form-control" id="feedback_email" name="feedback_email" placeholder="name@example.com" value="<?php echo $_SESSION['user']['email']; ?>">
				<div class="mb-3">
				  <label for="feedback" class="form-label">Feedback</label>
				  <textarea class="form-control" id="feedback" name="feedback" rows="3"></textarea>
				</div>
				<div class="d-grid gap-2">
				  <button class="btn btn-warning text-light" type="submit" name="add_feedback" value="add_feedback">Sumbit</button>
				</div>
				 	<?php
				 } 

				 ?>
			</form>

			</div>
			<div class="col-md-2"></div>
		</div>
		<?php
	}


	public function registeration_form(){
		?>

		<div class="container border border-2 border-warning p-2 rounded" style="margin-top: 70px; min-height: 80vh;">
			<form class="row g-3" method="POST" action="register-process.php" enctype="multipart/form-data">

				<div class="col-md-4"></div>
				<div class="col-md-4 text-center">
					<?php
					if (isset($_GET['msg'])) {
						?>
						<div class="alert <?php echo $_GET['color']; ?> alert-dismissible fade show" role="alert">
							<?php echo $_GET['msg']; ?>
							  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php
					}
					 ?>
				</div>
				<div class="col-md-4"></div>

				<div class="col-md-4"></div>
				<div class="col-md-4 text-center text-danger">
					<ul>
						<?php echo isset($_GET['err_msg'])? $_GET['err_msg']: ''; ?>
					</ul>
				</div>
				<div class="col-md-4"></div>

				<div class="col-md-6">
			     <label for="first_name" class="form-label">First Name</label>
			     <input type="text" class="form-control" name="first_name" id="first_name">
			     <div class="text-danger" id="first_name_msg"></div>
				</div>
				<div class="col-md-6">
				 <label for="last_name" class="form-label">Last Name</label>
				 <input type="text" class="form-control" name="last_name" id="last_name">
			     <div class="text-danger" id="last_name_msg"></div>
				</div>
			  	<div class="col-md-6">
			    <label for="email" class="form-label">Email</label>
			    <input type="email" class="form-control" name="email" id="email" onblur="checksEmail()">
			     <div class="text-danger" id="email_msg"></div>
			  	</div>
			  	<div class="col-md-6">
			    <label for="password" class="form-label">Password</label>
			    <input type="password" class="form-control" name="password" id="password">
			     <div class="text-danger" id="password_msg"></div>
			  	</div>
			  	<div class="col-12">
			    <label for="address" class="form-label">Address</label>
			    <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St">
			     <div class="text-danger" id="address_msg"></div>
			  	</div>
			  	<div class="col-md-6">
			  	<div class="mb-2"><label>Gender</label></div>
				  <input class="form-check-input gender" type="radio" name="gender" value="Male" id="gender_male">
				  <label class="form-check-label" for="gender_male">
				    Male
				  </label>
				  <input class="form-check-input gender" type="radio" name="gender" value="Female" id="gender_female">
				  <label class="form-check-label" for="gender_female">
				    Female
				  </label>
			     <div class="text-danger" id="gender_msg"></div>
			  	</div>
			  	<div class="col-md-6">
			    <label for="date_of_birth" class="form-label">Date of Birth</label>
			    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="YYYY-MM-DD">
			     <div class="text-danger" id="dob_msg"></div>
			  	</div>
			  	<div class="col-12">
			      <label for="profile_image" class="form-label">Profile Image</label>
	  			  <input class="form-control" type="file" id="profile_image" name="profile_image">
			     <div class="text-danger" id="pfp_msg"></div>
			  	</div>
			  	<div class="d-grid gap-2">
			    <button type="submit" class="btn btn-warning text-light" name="register" value="register" onclick="return validate_register()" id="register_btn">Register</button>
			  	</div>
			  	<div class="col-md-6">
			  	<span>Already Have an Account? <a href="login-page.php">Login Here</a></span>
			  	</div>
			</form>
		</div>

		<?php
	}


	public function login_form(){
		?>
		<div class="row mx-0 px-0 p-2" style="margin-top: 70px; min-height: 80vh;">
		 	<div class="col-md-2"></div>
		 	<div class="col-md-8">
			<div class="container border border-2 border-warning p-2 rounded">
				<div class="row mx-0 px-0 mt-1">
				<div class="col-md-4"></div>
				<div class="col-md-4 text-center">
					<?php
					if (isset($_GET['msg'])) {
						?>
						<div class="alert <?php echo $_GET['color']; ?> alert-dismissible fade show" role='alert'>
							<?php echo $_GET['msg']; ?>
							  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php
					}
					 ?>
					
				</div>
				<div class="col-md-4"></div>
				</div>
				<form action="login-process.php" method="POST">
				  <div class="mb-3">
				    <label for="login_email" class="form-label">Email address</label>
				    <input type="email" class="form-control" id="login_email" name="login_email" aria-describedby="emailHelp" required>
				    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
				  </div>
				  <div class="mb-3">
				    <label for="login_password" class="form-label">Password</label>
				    <input type="password" class="form-control" id="login_password" name="login_password" required>
				  </div>
				  <div class="mb-3">
				  	<a href="forgot-password.php">Forgot Password?</a>
				  	<span class="float-end">Don't have any Account? <a href="register-page.php">Register Here!</a></span>
				  </div>
				  <div class="d-grid gap-2">
				  <button type="submit" class="btn btn-warning text-light" name="login" value="login">Login</button>
				  </div>
				</form>
			</div>
			</div>
		 	<div class="col-md-2"></div>
		</div>
		<?php
	}


	public function change_password_form(){
		?>
		<div class="row mx-0 px-0 p-2" style="margin-top: 70px; min-height: 80vh;">
		 	<div class="col-md-2"></div>
		 	<div class="col-md-8">
			<div class="container border border-2 border-warning p-2 rounded">
				<div class="row mx-0 px-0 mt-1">
				<div class="col-md-4"></div>
				<div class="col-md-4 text-center">
					<?php
					if (isset($_GET['msg'])) {
						?>
						<div class="alert <?php echo $_GET['color']; ?> alert-dismissible fade show" role='alert'>
							<?php echo $_GET['msg']; ?>
							  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php
					}
					 ?>
					
				</div>
				<div class="col-md-4"></div>
				</div>
				<form action="register-process.php" method="POST">
				  <div class="mb-3">
				    <label for="login_email" class="form-label">Email address</label>
				    <input type="email" class="form-control" id="login_email" name="checks_email" aria-describedby="emailHelp" required>
				    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
				  </div>
				  <div class="mb-3">
				  	<!-- <a href="forgot-password.php">Forgot Password?</a> -->
				  	<span >Already have an Account? <a href="login-page.php">Login Here!</a></span>
				  	<span class="float-end">Don't have any Account? <a href="register-page.php">Register Here!</a></span>
				  </div>
				  <div class="d-grid gap-2">
				  <button type="submit" class="btn btn-warning text-light" name="change_password" value="change_password">Change Password</button>
				  </div>
				</form>
			</div>
			</div>
		 	<div class="col-md-2"></div>
		</div>
		<?php
	}







}


 ?>