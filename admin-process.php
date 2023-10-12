<?php
session_start();
date_default_timezone_set("Asia/Karachi");
require_once('require/database-library.php');
$db = new Database();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = 'as3614851@gmail.com';
$mail->Password = 'hwovosllckbgwqxd';



if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'user_request') {
	?>
		<div class="row mx-0 px-0 mt-1">
			<div class="col-md-3"></div>
			<div class="col-md-6 bg-warning text-light text-center rounded p-1">
				<p class="display-6">Requests</p>
			</div>
			<div class="col-md-3"></div>
		</div>

		<div class="row mx-0 px-0 mt-1">
			<div class="row mx-0 px-0 mt-1">
				<div class="col-md-4"></div>
				<div class="col-md-4" id="user_msg">
					
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>

		<div class="col-md-12 mx-1 table-responsive">
				<table id="example" class="display" style="width: 100%;">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Profile Image</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Gender</th>
							<th>Request At</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$result = $db->pending_user();
						if ($result->num_rows>0) {
							$count = 1;
							while ($row = mysqli_fetch_assoc($result)) {
								?>
								<tr>
									<td><?php echo $count++; ?></td>
									<td><img src="Profile_Images/<?php echo $row['profile_img']; ?>" alt="" style="width: 40px; height: 40px;" ></td>
									<td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['gender']; ?></td>
									<td><?php $db->date_format($row['created_at']); ?></td>
									<td>
										<button class="btn btn-outline-success" onclick="approve(<?php echo $row['user_id'];?>)">Approve</button>
										<button class="btn btn-outline-danger" onclick="reject(<?php echo $row['user_id'];?>)">Reject</button>
									</td>
								</tr>
								<?php
							}
						}
						 ?>
					</tbody>
				</table>
		</div>

	<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_user_form'){
	?>

	<div class="row mx-0 px-0">
		<div class="row mx-0 px-">
			<div class="col-md-2"></div>
			<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
				<p class="display-6">Add User</p>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row mx-0 px-0">
			<div class="col-md-2"></div>
			<div class="col-md-8 border border-2 border-warning mt-2 p-2 rounded">

		<form id="userForm" class="row g-3" method="POST" action="admin-proess.php?action=add_user" enctype="multipart/form-data">
			<div class="row mx-0 px-0 mt-1">
				<div class="col-md-3"></div>
				<div class="col-md-6 text center" id="add_user_msg"></div>
				<div class="col-md-3"></div>
			</div>
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
		    <input type="email" class="form-control" name="email" id="email">
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
		  	<div class="col-md-6">
		  		<label class="mb-2">Role Type</label>
		  		<select class="form-select" aria-label="Default select example" name="role_id" id="role_id">
		  			<option disabled value="">--Select Role--</option>
		  			<?php 
		  			$result = $db->roles();
		  			if ($result->num_rows>0) {
		  			 	while ($row = mysqli_fetch_assoc($result)) {
		  			 		if ($row['role_type'] == 'User') {
		  			 			?>
		  			 			<option value="<?php echo $row['role_id']; ?>" selected><?php echo $row['role_type']; ?></option>
		  			 			<?php
		  			 		}else{
		  			 		?>
		  			 		<option value="<?php echo $row['role_id']; ?>"><?php echo $row['role_type']; ?></option>
		  			 		<?php
		  			 		}
		  			 	}
		  			 } 
		  			?>
				</select>
			</div>
			<div class="col-md-7">
				<div class="mb-1">
					<label>Approval</label>
				</div>
					<input class="form-check-input approval" type="radio" name="approval" value="Pending" id="approval_pending" checked>
			  		<label class="form-check-label" for="approval_pending">
			    		Pending
			  		</label>
			  		<input class="form-check-input approval" type="radio" name="approval" value="Approved" id="approval_approved">
			  		<label class="form-check-label" for="approval_approved">
			   			Approve
			  		</label>
			  		<input class="form-check-input approval" type="radio" name="approval" value="Rejected" id="approval_rejected">
			  		<label class="form-check-label" for="approval_rejected">
			   			Rejected
			  		</label>	
			</div>
			<div class="col-md-5">
				<div class="mb-1"><label>Status</label></div>
				<input class="form-check-input status" type="radio" name="status" value="Active" id="status_active">
			  		<label class="form-check-label" for="status_active">
			    		Active
			  		</label>
			  	<input class="form-check-input status" type="radio" name="status" value="Inactive" id="status_inactive" checked>
			  		<label class="form-check-label" for="status_inactive">
			    		Inactive
			  		</label>
			</div>
		  	<div class="col-12">
		      <label for="profile_image" class="form-label">Profile Image</label>
  			  <input class="form-control" type="file" id="profile_image" name="profile_image">
		     <div class="text-danger" id="pfp_msg"></div>
		  	</div>
		  	<div class="d-grid gap-2">
		    <button type="button" class="btn btn-warning text-light" onclick="add_user()">Add User</button>
		  	</div>
		</form>

			<div class="col-md-2"></div>
		</div>
	</div>

	<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'view_users'){
?>

	<div class="row mx-0 px-0">
		<div class="col-md-2"></div>
		<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
			<p class="display-6">View Users</p>
		</div>
		<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0">
		<div class="col-md-3"></div>
		<div class="col-md-6" id="view_user_msg"></div>
		<div class="col-md-3"></div>
	</div>

	<div class="row mx-0 px-0 mt-1 table-responsive">
		<table id="example" class="display" style="width: 100%">
			<thead>
				<tr>
					<th>S.No</th>
					<th>Profile Image</th>
					<th>Full Name</th>
					<th>Email</th>
					<th>Gender</th>
					<th>Role Type</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>

			<?php
				$result = $db->view_user($_SESSION['user']['user_id']);
				if ($result->num_rows>0) {
					$count = 1;
					while ($row = mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><img src="Profile_Images/<?php echo $row['profile_img']; ?>" alt="" style="width: 40px; height: 40px;"></td>
							<td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['gender']; ?></td>
							<td><?php echo $row['role_type']; ?></td>
							<td>
								<button class="btn btn-info" onclick="user_info(<?php echo $row['user_id']; ?>)">Info</button>
								<?php
								if($row['status'] == 'Active'){
									?>
									<button class="btn btn-danger" onclick="inactive_user(<?php echo $row['user_id']; ?>)">Inactive</button>
									<?php
								}elseif($row['status'] == 'Inactive'){

									?>
									<button class="btn btn-success" onclick="active_user(<?php echo $row['user_id']; ?>)">Active</button>
									<?php

								}

								 ?>
							</td>
						</tr>
						<?php
					}
				}
	 		?>
				
			</tbody>
		</table>
	</div>

		
<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_blog_form'){
?>

	<div class="row mx-0 px-0">
	 	<div class="col-md-2"></div>
	 	<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
	 		<p class="display-6">Add Blog</p>
	 	</div>
	 	<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0">
		<div class="col-md-3"></div>
		<div class="col-md-6" id="add_blog_msg"></div>
		<div class="col-md-3"></div>
	</div>

	<div class="row mx-0 px-0 mt-2">
	 	<div class="col-md-2"></div>
	 	<div class="col-md-8 border border-warning rounded p-2">
	 		<form class="row g-3" id="blogForm" action="admin-proess.php?action=add_blog" method="POST">
	 			<div class="col-md-6">
			     <label for="blog_title" class="form-label">Blog Title</label>
			     <input type="text" class="form-control" name="blog_title" id="blog_title">
				<div id="blog_title_msg" class="text-danger"></div>
				</div>
				<div class="col-md-6">
				 <label for="post_per_page" class="form-label">Post Per Page</label>
				 <input type="number" class="form-control" name="post_per_page" id="post_per_page">
				<div id="post_per_page_msg" class="text-danger"></div>
				</div>
				<div class="col-12">
			      <label for="blog_background_image" class="form-label">Blog Background Image</label>
	  			  <input class="form-control" type="file" id="blog_background_image" name="blog_background_image">
			    <div id="blog_background_image_msg" class="text-danger"></div>
			    </div>
			    <div class="col-md-5">
					<div class="mb-1"><label>Status</label></div>
					<input class="form-check-input status" type="radio" name="status" value="Active" id="status_active" checked>
				  		<label class="form-check-label" for="status_active">
				    		Active
				  		</label>
				  	<input class="form-check-input status" type="radio" name="status" value="Inactive" id="status_inactive">
				  		<label class="form-check-label" for="status_inactive">
				    		Inactive
				  		</label>
				</div>
			    <div class="d-grid gap-2">
			      <button type="button" class="btn btn-warning text-light" name="add_blog" onclick="addBlog()">Add Blog</button>
			    </div>
			</form>
	 	</div>
	 	<div class="col-md-2"></div>
	</div>

<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'view_blogs'){
?>
	<div class="row mx-0 px-0 mt-1">
		<div class="col-md-2"></div>
		<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
			<p class="display-6">View Blogs</p>
		</div>
		<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0">
		<div class="col-md-3"></div>
		<div class="col-md-6" id="view_blog_msg"></div>
		<div class="col-md-3"></div>
	</div>

	<div class="row mx-0 px-0 mt-1 table-responsive">
		<table id="example" class="display" style="width: 100%;">
			<thead>
				<tr>
					<th>S.NO</th>
					<th>Blog Background Image</th>
					<th>Blog Title</th>
					<th>Blog Author</th>
					<th>Posts Per Page</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php

				$result = $db->view_blogs();

				if($result->num_rows>0){
					$count = 1;
					while ($row = mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><img src="Blog_Background_Images/<?php echo $row['blog_background_image']; ?>" style="width: 100px; height: 50px;"></td>
							<td><?php echo $row['blog_title']; ?></td>
							<td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
							<td><?php echo $row['posts_per_page']; ?></td>
							<?php
							if($row['user_id'] == $_SESSION['user']['user_id']){

								?>
								<td>
									<a class="btn btn-info" onclick="blog_info(<?php echo $row['blog_id']; ?>)">Info</a>
									<?php
									if ($row['blog_status'] == 'Active') {
										?>
										<a class="btn btn-danger" onclick="inactive_blog(<?php echo $row['blog_id']; ?>)">Inactive</a>
										<?php
									}elseif($row['blog_status'] == 'Inactive'){
										?>
										<a class="btn btn-success" onclick="active_blog(<?php echo $row['blog_id']; ?>)">Active</a>
										<?php
									}

									 ?>
								</td>
								<?php

							}else{
								?>
								<td></td>
								<?php
							}

							 ?>
						</tr>
						<?php
					}
				}
				 ?>
			</tbody>
		</table>
	</div>
<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_category_form'){
?>

	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-2"></div>
	 	<div class="col-md-8 bg-warning text-light text-center p-1 rounded">
	 		<p class="display-6">Add Category</p>
	 	</div>
	 	<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0 mt-1">
		<div class="col-md-3"></div>
		<div class="col-md-6" id="add_category_form_msg"></div>
		<div class="col-md-3"></div>
	</div>

	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-2"></div>
	 	<div class="col-md-8 border border-warning rounded p-2">
	 		<form class="row g-3" action="">
	 			<div class="mb-3">
				  <label for="category_title" class="form-label">Category Title</label>
				  <input type="text" class="form-control" id="category_title" name="category_title" >
					<div id="category_title_msg" class="text-danger"></div>
				</div>
				<div class="mb-3">
				  <label for="category_description" class="form-label">Category Description</label>
				  <textarea class="form-control" id="category_description" name="category_description" rows="3"></textarea>
					<div id="category_description_msg" class="text-danger"></div>
				</div>
				<div class="mb-3">
					<div class="mb-1"><label>Status</label></div>
					<input class="form-check-input status" type="radio" name="status" value="Active" id="status_active" checked>
				  		<label class="form-check-label" for="status_active">
				    		Active
				  		</label>
				  	<input class="form-check-input status" type="radio" name="status" value="Inactive" id="status_inactive">
				  		<label class="form-check-label" for="status_inactive">
				    		Inactive
				  		</label>
				</div>
				<div class="d-grid gap-2">
			    	<button type="button" class="btn btn-warning text-light" onclick="addCategory()">Add Category</button>
			    </div>
	 	</div>
	 	<div class="col-md-2"></div>
	</div>

<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'view_categories'){
?>

	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-2"></div>
	 	<div class="col-md-8 bg-warning text-light text-center rounded p-1">
	 		<p class="display-6">View Categories</p>
	 	</div>
	 	<div class="col-md-2"></div>
	</div>
	<div class="row mx-0 px-0 mt-1">
		<div class="col-md-3"></div>
		<div class="col-md-6" id="view_categories_msg"></div>
		<div class="col-md-3"></div>
	</div>
	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-12 table-responsive">
	 		<table style="width: 100%;" class="display" id="example">
	 			<thead>
	 				<tr>
	 					<th>S.No</th>
	 					<th>Category Title</th>
	 					<th>Category Description</th>
	 					<th>Actions</th>
	 				</tr>
	 			</thead>
	 			<tbody>
	 				<?php
	 				$result = $db->view_categories();
	 				if($result->num_rows>0){
	 					$count = 1;
	 					while ($row = mysqli_fetch_assoc($result)) {
	 						?>
	 						<tr>
	 							<td><?php echo $count++; ?></td>
	 							<td><?php echo $row['category_title']; ?></td>
	 							<td style="width:60%"><?php echo $row['category_description']; ?></td>
	 							<td>
	 								<a class="btn btn-info" onclick="category_info(<?php echo $row['category_id']; ?>)">Info</a>
	 								<?php
	 								if($row['status'] == 'Active'){
	 									?>
	 									<a class="btn btn-danger text-light" onclick="inactive_category(<?php echo $row['category_id']; ?>)">Inactive</a>
	 									<?php
	 								}else{
	 									?>
	 									<a class="btn btn-success text-light" onclick="active_category(<?php echo $row['category_id']; ?>)">Active</a>
	 									<?php
	 								}

	 								 ?>
	 							</td>
	 						</tr>
	 						<?php
	 					}
	 				}

	 				 ?>
	 			</tbody>
	 		</table>
	 	</div>
	</div>

<?php
}elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_post_form') {
?>

	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-2"></div>
	 	<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
	 		<p class="display-6">Add Post</p>
	 	</div>
	 	<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-2"></div>
	 	<div class="col-md-8" id="add_post_form_msg">
	 	</div>
	 	<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-2"></div>
	 	<div class="col-md-8 border border-warning rounded p-2">
	 		<form class="row g-3" id="addPostForm" method="POST" action="admin-process.php?action=add_post" enctype="multipart/form-data">

	 			<div class="mb-3">
	  				<label for="post_title" class="form-label">Post Title</label>
	  				<input type="text" class="form-control" id="post_title" name="post_title">
	  				<div id="post_title_msg" class="text-danger"></div>
				</div>
				<div class="mb-3">
	  				<label for="post_summary" class="form-label">Post Summary</label>
	  				<input type="text" class="form-control" id="post_summary" name="post_summary">
	  				<div id="post_summary_msg" class="text-danger"></div>
				</div>
				<div class="mb-3">
	  				<label for="post_description" class="form-label">Post Description</label>
	  				<textarea class="form-control" id="post_description" name="post_description" rows="3"></textarea>
	  				<div id="post_description_msg" class="text-danger"></div>
				</div>
				<div class="mb-3">
				  <label for="featured_image" class="form-label">Featured Image</label>
				  <input class="form-control" type="file" name="featured_image" id="featured_image">
				  <div id="featured_image_msg" class="text-danger"></div>
				</div>

				<div class="mb-3">
					<div class="mb-1"><label>Comments Permission</label></div>
					  <input class="form-check-input" type="radio" name="is_comment_allowed" value="Yes" id="yes" checked>
					  <label class="form-check-label" for="yes">
					    Yes
					  </label>
					  <input class="form-check-input" type="radio" name="is_comment_allowed" id="no" value="No">
					  <label class="form-check-label" for="no">
					    No
					  </label>
				</div>
				<div class="mb-3">
					<div class="mb-1"><label>Status</label></div>
					  <input class="form-check-input" type="radio" name="status" value="Active" id="status_active" checked>
					  <label class="form-check-label" for="status_active">
					    Active
					  </label>
					  <input class="form-check-input" type="radio" name="status" id="status_inactive" value="Inactive">
					  <label class="form-check-label" for="status_inactive">
					    Inactive
					  </label>
				</div>
				<div class="mb-3">
					    <label for="post_blog" class="form-label">Select a Blog</label>
	    					<select class="form-select" id="post_blog" name="blog_id" required>
	      					<option  disabled selected value="">--Select your own blog--</option>
	      					<?php
	      					$result = $db->active_blog_by_user_id($_SESSION['user']['user_id']);
	      					if ($result->num_rows>0) {
	      						while ($row = mysqli_fetch_assoc($result)) {
	      							?>
	      							<option value="<?php echo $row['blog_id']; ?>"><?php echo $row['blog_title']; ?></option>
	      							<?php
	      						}
	      					}else{
	      						?>
	      						<option  disabled >--Not any Blog Please Create a one--</option>
	      						<?php
	      					}

	      					 ?>
	    				</select>
					    <div id="blog_msg" class="text-danger">
					    </div>
				</div>
				<div class="mb-3">
					<label>Select Categories</label>
					<select class="js-example-basic-multiple" name="categories[]" id="categories" multiple="multiple" style="width: 100%;">
						<?php
						$result = $db->all_active_categories();
						if ($result->num_rows>0) {
							while ($row = mysqli_fetch_assoc($result)) {
								?>
								<option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_title']; ?></option>
								<?php
							}
						}else{
							?>
							<option disabled>--No Categories Available--</option>
							<?php
						}

						 ?>
					</select>
					<div id="category_msg" class="text-danger"></div>
				</div>
				<div class="mb-3" id="attachments">
					<label for="no_of_attachments" class="form-label">Number of attachments you wants to add(Optional)</label>
	  				<input type="number" class="form-control" id="no_of_attachments">
	  				<div id="attachment_msg" class="text-danger"></div>
	  				<button type="button" class="btn btn-warning text-light mt-1" onclick="add_attachments()">Add Attachments</button>
				</div>
				<div class="d-grid gap-2">
			    	<button type="button" class="btn btn-warning text-light" onclick="add_post()">Add Post</button>
			  	</div>
	 		</form>
	 	</div>
	 	<div class="col-md-2"></div>
	</div>

<?php
}elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'view_posts') {
?>
	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-2"></div>
	 	<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
	 		<p class="display-6">View Posts</p>
	 	</div>
	 	<div class="col-md-2"></div>
	</div>
	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-2"></div>
	 	<div class="col-md-8" id="view_post_msg">
	 	</div>
	 	<div class="col-md-2"></div>
	</div>
	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-12 text-center table-responsive">
	 		<table class="display" id="example" style="width: 100%;">
	 			<thead>
	 			<tr>
	 				<th align='center' style="width:5%;">S.No</th>
	 				<th align='center' style="width:10%;">Blog</th>
	 				<th align='center' style="width:20%;">Featured Image</th>
	 				<th align='center' style="width:10%;">Post Title</th>
	 				<th align='center' style="width:25%;">Post Summary</th>
	 				<th align='center' style="width:30%;">Actions</th>
	 			</tr>
	 			</thead>
	 			<tbody>
	 				<?php
	 				$result = $db->view_posts($_SESSION['user']['user_id']);
	 				if ($result->num_rows>0) {
	 					$count = 1;
	 					while ($row = mysqli_fetch_assoc($result)) {
	 						?>
	 						<tr>
	 							<td style="width:5%;"><?php echo $count++; ?></td>
	 							<td style="width:10%;"><?php echo $row['blog_title']; ?></td>
	 							<td style="width:20%;"><img src="Post_Featured_Images/<?php echo $row['featured_img']; ?>" alt="" style="width: 60px; height: 35px;"></td>
	 							<td style="width:10%;"><?php echo $row['post_title']; ?></td>
	 							<td style="width:25%;"><?php echo $row['post_summary']; ?></td>
	 							<td style="width:30%;">
	 								<a class="btn btn-outline-info" onclick="view_comments(<?php echo $row['post_id']; ?>)">Comments</a>
	 								<a class="btn btn-outline-danger" onclick="edit_post(<?php echo $row['post_id']; ?>)">Edit</a>
	 								<?php
	 								if($row['status'] == 'Active'){
	 									?>
	 									<a class="btn btn-danger" onclick="inactive_post(<?php echo $row['post_id']?>)">Inactive</a>
	 									<?php
	 								}elseif($row['status'] == 'Inactive'){
	 									?>
	 									<a class="btn btn-success" onclick="active_post(<?php echo $row['post_id']?>)">Active</a>
	 									<?php
	 								}
	 								 ?>
	 							</td>

	 						</tr>
	 						<?php
	 					}
	 				}

	 				 ?>
	 			</tbody>
	 		</table>
	 	</div>
	</div>

<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'approve'){

	$user_id = $_REQUEST['user_id'];
	$result = $db->approve_user($user_id);
	if ($result) {
		$result2 = $db->user_by_user_id($user_id);
		if ($result2->num_rows>0) {
			$row = mysqli_fetch_assoc($result2);

				$mail->setFrom('as3614851@gmail.com');
				$mail->addAddress($row['email']);
				$mail->Subject = 'Activation Status for blog website';
				$html = "<h3 style='background-color:green'>Congratulations!</h3><h4 style='color:red'>Your Request is Approved Now you Can Login </h4>";
				$mail->msgHTML($html);

				$mail->send();
					?>
					<div class="alert alert-success text-center" role="alert">
					  User With User ID <?php echo $user_id ?> is Approved
					</div>
					<?php
			
		}

	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'reject'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	$user_id = $_REQUEST['user_id'];
	$result = $db->reject_user($user_id);
	if ($result) {
		$result2 = $db->user_by_user_id($user_id);
		if ($result2->num_rows>0) {
			$row = mysqli_fetch_assoc($result2);

				$mail->setFrom('as3614851@gmail.com');
				$mail->addAddress($row['email']);
				$mail->Subject = 'Activation Status for blog website';
				$html = "<h3 style='background-color:red;color:white;'>Sorry User!</h3><h4 style='color:red'>Your Request for Registeration is Rejected, please try again with Different Email.</h4>";
				$mail->msgHTML($html);

				$mail->send();
				?>
					<div class="alert alert-danger text-center" role="alert">
					  User With User ID <?php echo $user_id ?> is Rejected
					</div>
				<?php	
		}

	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_user'){
	// echo "<pre>";
	// var_dump($_REQUEST);
	// var_dump($_FILES['profile_image']);
	// echo "</pre>";


	extract($_REQUEST);
	$flag = true;

	if (isset($_FILES['profile_image'])) {
	    $fileInfo = pathinfo($_FILES['profile_image']['name']);
	    $extensions = ['jpg', 'jpeg', 'png'];
	    $valid_extension = false;

	    foreach ($extensions as $extension) {
	        if (strtolower($fileInfo['extension']) === $extension) {
	            $valid_extension = true;
	            break;
	        }
	    }

	    if (!$valid_extension) {
	        $flag = false;
        	$error_msg = "Image extensions Should be (jpg, jpeg, png)";
	    }
	}
	if ($flag == false) {
		?>
		<div class="alert alert-danger text-center" role="alert">
		  <?php echo $error_msg; ?>
		</div>
		<?php
	}else{
		if (isset($_FILES['profile_image'])) {
				$image = $_FILES['profile_image'];
				$folder = "Profile_Images";
				if (!is_dir($folder)) {
					mkdir($folder);
				}

				$file_name = time()."_".$image['name'];
				$temp_name = $image['tmp_name'];
				$path = $folder."/".$file_name;

				$handle = move_uploaded_file($temp_name, $path);
				if ($handle) {
					$result = $db->add_user($role_id,$first_name,$last_name,$email,$password,$gender,$date_of_birth,$file_name,$address,$approval,$status);

					if ($result) {

						$mail->setFrom('as3614851@gmail.com');
						$mail->addAddress($email);
						$mail->Subject = 'Credentials for blog website';
						$html = "<h3 style='background-color:green'>Congratulations! You have been Registered. Here is your Credentials</h3> <h4 style='color:red'>Email: $email</h4><h4 style='color:red'>Password: $password</h4>";
						$mail->msgHTML($html);
						$mail->send();
							?>
							<div class="alert alert-success text-center" role="alert">
	  							User Added Successfully!
							</div>
							<?php
					}else{
						?>
						<div class="alert alert-danger text-center" role="alert">
						  Cannot Add User, Email is in Already Use
						</div>

						<?php
					}
				}
			}
	}

}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'inactive_user'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->inactive_user($user_id);

	if ($result) {

		$result2 = $db->user_by_user_id($user_id);
		if ($result2->num_rows>0) {
			$row = mysqli_fetch_assoc($result2);

				$mail->setFrom('as3614851@gmail.com');
				$mail->addAddress($row['email']);
				$mail->Subject = 'Activation Status for blog website';
				$html = "<h3 style='background-color:red;color:white;'>Dear User!</h3><h4 style='color:red'>Your Account is Deactivated for Now, Please Wait.!</h4>";
				$mail->msgHTML($html);

				$mail->send();
					?>
					<div class="alert alert-danger text-center" role="alert">
					 Inactived User with User ID <?php echo  $user_id; ?>
					</div>
					<?php
		}

	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'active_user'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->active_user($user_id);

	if ($result) {
		$result2 = $db->user_by_user_id($user_id);
		if ($result2->num_rows>0) {
			$row = mysqli_fetch_assoc($result2);

				$mail->setFrom('as3614851@gmail.com');
				$mail->addAddress($row['email']);
				$mail->Subject = 'Activation Status for blog website';
				$html = "<h3 style='background-color:green'>Dear User!</h3><h4 style='color:green'>Your Account is Activated You Can now Login</h4>";
				$mail->msgHTML($html);
				$mail->send();
					?>
					<div class="alert alert-success text-center" role="alert">
		  				Actived User with User ID <?php echo  $user_id; ?>
					</div>
					<?php
		}
		
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_blog'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// print_r($_FILES['blog_background_image']);
	// echo "<pre>";

	extract($_REQUEST);

	$flag = true;

	if (isset($_FILES['blog_background_image'])) {
	    $fileInfo = pathinfo($_FILES['blog_background_image']['name']);
	    $extensions = ['jpg', 'jpeg', 'png'];
	    $valid_extension = false;

	    foreach ($extensions as $extension) {
	        if (strtolower($fileInfo['extension']) === $extension) {
	            $valid_extension = true;
	            break;
	        }
	    }

	    if (!$valid_extension) {
	        $flag = false;
        	$error_msg = "Image extensions Should be (jpg, jpeg, png)";
	    }
	}

	if ($flag == false) {
		?>
		<div class="alert alert-danger text-center" role="alert">
		  <?php echo $error_msg ?>
		</div>
		<?php
	}else{
		if (isset($_FILES['blog_background_image'])) {
			$image = $_FILES['blog_background_image'];

			$folder = "Blog_Background_Images";

			if (!is_dir($folder)) {
				mkdir($folder);
			}

			$file_name = time()."_".$image['name'];
			$temp_name = $image['tmp_name'];
			$path = $folder."/".$file_name;

			$handle = move_uploaded_file($temp_name, $path);

			if ($handle) {
				$result = $db->add_blog($_SESSION['user']['user_id'],$blog_title,$post_per_page,$file_name,$status);

				if ($result) {
					?>
					<div class="alert alert-success text-center" role="alert">
					  Blog Added Successfully
					</div>

					<?php
				}
			}
		}
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'inactive_blog'){
	// echo "<pre>";
	// print_r($_REQUEST);

	extract($_REQUEST);

	$result = $db->inactive_blog($blog_id);

	if ($result) {
		?>
		<div class="alert alert-danger text-center" role="alert">
		  Inactived Blog With Blog ID <?php echo $blog_id; ?>
		</div>

		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'active_blog'){
	// echo "<pre>";
	// print_r($_REQUEST);

	extract($_REQUEST);

	$result = $db->active_blog($blog_id);

	if ($result) {
		?>
		<div class="alert alert-success text-center" role="alert">
		  Actived Blog With Blog ID <?php echo $blog_id; ?>
		</div>

		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit_user'){
	// echo "<pre>";
	// print_r($_REQUEST);

	extract($_REQUEST);

	$result = $db->user_by_user_id($user_id);
	if ($result->num_rows>0) {
		$row = mysqli_fetch_assoc($result);
		?>

		<div class="row mx-0 px-0">
		<div class="row mx-0 px-">
			<div class="col-md-2">
				<button class="btn btn-outline-warning" onclick="user_info(<?php echo $row['user_id']; ?>)"><-Back</button>
			</div>
			<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
				<p class="display-6">Update User</p>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row mx-0 px-0">
			<div class="col-md-2"></div>
			<div class="col-md-8 border border-2 border-warning mt-2 p-2 rounded">

		<form id="updateUserForm" class="row g-3" method="POST" action="admin-proess.php?action=update_user&user_id=<?php echo $user_id; ?>" enctype="multipart/form-data">
			<div class="row mx-0 px-0 mt-1">
				<div class="col-md-3"></div>
				<div class="col-md-6 text center" id="update_user_msg"></div>
				<div class="col-md-3"></div>
			</div>
			<div class="col-md-6">
		     <label for="first_name" class="form-label">First Name</label>
		     <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $row['first_name']; ?>">
		     <div class="text-danger" id="first_name_msg"></div>
			</div>
			<div class="col-md-6">
			 <label for="last_name" class="form-label">Last Name</label>
			 <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $row['last_name']; ?>">
		     <div class="text-danger" id="last_name_msg"></div>
			</div>
		  	<div class="col-md-6">
		    <label for="email" class="form-label">Email</label>
		    <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>" readonly disabled>
		     <div class="text-danger" id="email_msg"></div>
		  	</div>
		  	<div class="col-md-6">
		    <label for="password" class="form-label">Password</label>
		    <input type="password" class="form-control" name="password" id="password" value="<?php echo $row['password']; ?>" readonly disabled>
		     <div class="text-danger" id="password_msg"></div>
		  	</div>
		  	<div class="col-12">
		    <label for="address" class="form-label">Address</label>
		    <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" value="<?php echo $row['home_town']; ?>">
		     <div class="text-danger" id="address_msg"></div>
		  	</div>
		  	<div class="col-md-6">
		  	<label>Gender</label>

		  	<?php
		  	if ($row['gender'] == 'Male') {
		  		?>
			  <input class="form-check-input gender" type="radio" name="gender" value="Male" id="gender_male" checked>
			  <label class="form-check-label" for="gender_male">
			    Male
			  </label>
			  <input class="form-check-input gender" type="radio" name="gender" value="Female" id="gender_female">
			  <label class="form-check-label" for="gender_female">
			    Female
			  </label>
		  		<?php
		  	}else{
		  	 ?>
			  <input class="form-check-input gender" type="radio" name="gender" value="Male" id="gender_male">
			  <label class="form-check-label" for="gender_male">
			    Male
			  </label>
			  <input class="form-check-input gender" type="radio" name="gender" value="Female" id="gender_female" checked>
			  <label class="form-check-label" for="gender_female">
			    Female
			  </label>
			<?php
				}
			 ?>
		     <div class="text-danger" id="gender_msg"></div>
		  	</div>
		  	<div class="col-md-6">
		    <label for="date_of_birth" class="form-label">Date of Birth</label>
		    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="YYYY-MM-DD" value="<?php echo $row['date_of_birth']; ?>">
		     <div class="text-danger" id="dob_msg"></div>
		  	</div>
		  	<?php
		  	 $result2 = $db->roles();

		  	 ?>
		  	<div class="col-md-6">
		  		<label>Role Type</label>
		  		<select class="form-select" aria-label="Default select example" name="role_id" id="role_id">
		  			<option disabled value="">--Select Role--</option>
		  			<?php
		  			if ($result2->num_rows>0) {
		  			 	while ($record = mysqli_fetch_assoc($result2)) {
		  			 		if ($row['role_id'] == $record['role_id']) {
		  			 			?>
		  			 			<option value="<?php echo $record['role_id']; ?>" selected><?php echo $record['role_type']; ?></option>
		  			 			<?php
		  			 		}else{
		  			 			?>
		  			 			<option value="<?php echo $record['role_id']; ?>"><?php echo $record['role_type']; ?></option>
		  			 			<?php
		  			 		}
		  			 	}
		  			 } 
		  			 ?>
				</select>
			</div>
		  	<div class="col-12">
		  	<div class="box">
		  		<img src="Profile_Images/<?php echo $row['profile_img']; ?>" style="width: 40px; height: 40px;">
		  	</div>
		      <label for="profile_image" class="form-label">Profile Image</label>
  			  <input class="form-control" type="file" id="profile_image" name="profile_image">
		     <div class="text-danger" id="pfp_msg"></div>
		  	</div>
		  	<div class="d-grid gap-2">
		    <button type="button" class="btn btn-warning text-light" onclick="update_user(<?php echo $row['user_id']; ?>)">Update User</button>
		  	</div>
		</form>

			<div class="col-md-2"></div>
		</div>
	</div>

		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_user'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// print_r($_FILES['profile_image']);
	// echo "</pre>";

	extract($_REQUEST);

	$flag = true;

	if (isset($_FILES['profile_image']) && $_FILES['profile_image']['name'] != "") {
	    $fileInfo = pathinfo($_FILES['profile_image']['name']);
	    $extensions = ['jpg', 'jpeg', 'png'];
	    $valid_extension = false;

	    foreach ($extensions as $extension) {
	        if (strtolower($fileInfo['extension']) === $extension) {
	            $valid_extension = true;
	            break;
	        }
	    }

	    if (!$valid_extension) {
	        $flag = false;
        	$error_msg = "Image extensions Should be (jpg, jpeg, png)";
	    }
	}

	if ($flag == false) {
		?>
		<div class="alert alert-danger text-center" role="alert">
		  <?php echo $error_msg; ?>
		</div>
		<?php
	}else{
		if (isset($_FILES['profile_image'])) {
				$image = $_FILES['profile_image'];
				$folder = "Profile_Images";
				if (!is_dir($folder)) {
					mkdir($folder);
				}

				if ($image['name'] != "") {
					$file_name = time()."_".$image['name'];
					$temp_name = $image['tmp_name'];
					$path = $folder."/".$file_name;
					$handle = move_uploaded_file($temp_name, $path);
				}else{
					$file_name = "";
				}	
		}else{
			$file_name = "";
		}

		$result = $db->update_user($user_id,$role_id,$first_name,$last_name,$gender,$address,$date_of_birth,$file_name);

		if ($result) {
			?>
			<div class="alert alert-success text-center" role="alert">
			  Updated User With User ID: <?php echo $user_id; ?>
			</div>

			<?php
		}else{
			?>
			<div class="alert alert-danger text-center" role="alert">
			  Cannot Updated User
			</div>

			<?php
		}
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit_blog'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->blog_by_blog_id($blog_id);

	if ($result->num_rows>0) {
		$row = mysqli_fetch_assoc($result);
		?>
			<div class="row mx-0 px-0">
			 	<div class="col-md-2">
			 		<button class="btn btn-outline-warning" onclick="blog_info(<?php echo $row['blog_id']; ?>)"><-Back</button>
			 	</div>
			 	<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
			 		<p class="display-6">Update Blog</p>
			 	</div>
			 	<div class="col-md-2"></div>
			</div>

			<div class="row mx-0 px-0">
				<div class="col-md-3"></div>
				<div class="col-md-6" id="update_blog_msg"></div>
				<div class="col-md-3"></div>
			</div>

			<div class="row mx-0 px-0 mt-2">
			 	<div class="col-md-2"></div>
			 	<div class="col-md-8 border border-warning rounded p-2">
			 		<form class="row g-3" id="updateBlogForm" action="admin-proess.php?action=update_blog&blog_id=<?php echo $row['blog_id']; ?>" method="POST">
			 			<div class="col-md-12">
			 				<h4 class="text-warning"><b>Author Name: </b> <?php echo $row['first_name']." ".$row['last_name']; ?></h4>
			 			</div>
			 			<div class="col-md-6">
					     <label for="blog_title" class="form-label">Blog Title</label>
					     <input type="text" class="form-control" name="blog_title" id="blog_title" value="<?php echo $row['blog_title']; ?>">
						<div id="blog_title_msg" class="text-danger"></div>
						</div>
						<div class="col-md-6">
						 <label for="post_per_page" class="form-label">Post Per Page</label>
						 <input type="text" class="form-control" name="post_per_page" id="post_per_page" value="<?php echo $row['posts_per_page']; ?>">
						<div id="post_per_page_msg" class="text-danger"></div>
						</div>
						
						<div class="col-12">
					      <label for="blog_background_image" class="form-label">Blog Background Image</label>
					      <div class="m-1">
							<img src="Blog_Background_Images/<?php echo $row['blog_background_image']; ?>" style="width: 120px; height: 60px;">
						  </div>
			  			  <input class="form-control" type="file" id="blog_background_image" name="blog_background_image">
					    <div id="blog_background_image_msg" class="text-danger"></div>
					    </div>
					    <div class="d-grid gap-2">
					      <button type="button" class="btn btn-warning text-light" name="add_blog" onclick="updateBlog(<?php echo $row['blog_id']; ?>)">Update Blog</button>
					    </div>
					</form>
			 	</div>
			 	<div class="col-md-2"></div>
			</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_blog'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// print_r($_FILES['blog_background_image']);
	// echo "</pre>";


	extract($_REQUEST);

	$flag = true;

	if (isset($_FILES['blog_background_image']) && $_FILES['blog_background_image']['name'] != "") {
	    $fileInfo = pathinfo($_FILES['blog_background_image']['name']);
	    $extensions = ['jpg', 'jpeg', 'png'];
	    $valid_extension = false;

	    foreach ($extensions as $extension) {
	        if (strtolower($fileInfo['extension']) === $extension) {
	            $valid_extension = true;
	            break;
	        }
	    }

	    if (!$valid_extension) {
	        $flag = false;
        	$error_msg = "Image extensions Should be (jpg, jpeg, png)";
	    }
	}

	if ($flag == false) {
		?>
		<div class="alert alert-danger text-center" role="alert">
		  <?php echo $error_msg ?>
		</div>
		<?php
	}else{
		if (isset($_FILES['blog_background_image'])) {
			$image = $_FILES['blog_background_image'];
			$folder = "Blog_Background_Images";

			if (!is_dir($folder)) {
				mkdir($folder);
			}

			if ($image['name'] != "") {
				$file_name = time()."_".$image['name'];
				$temp_name = $image['tmp_name'];
				$path = $folder."/".$file_name;
				$handle = move_uploaded_file($temp_name, $path);
				
			}else{
				$file_name = "";
			}

			$result = $db->update_blog($blog_id,$blog_title,$post_per_page,$file_name);

			if ($result) {
				?>
				<div class="alert alert-success text-center" role="alert">
				  Updated Blog With Blog ID <?php echo $blog_id; ?>
				</div>
				<?php
			}else{
				?>
				<div class="alert alert-danger text-center" role="alert">
				  Cannot Update this Blog
				</div>
				<?php
			}
		}
	}	
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_category'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);
	$result = $db->add_category($category_title,$category_description,$status);

	if ($result) {
		?>
		<div class="alert alert-success text-center" role="alert">
		  Category Added Successfully
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger text-center" role="alert">
		  Category Cannot be Added
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'inactive_category'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->inactive_category($category_id);

	if ($result) {
		?>
		<div class="alert alert-danger text-center" role="alert">
		  Deactivated Category With Category Id <?php echo $category_id; ?>
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger text-center" role="alert">
		  	Cannot Deactivate Category
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'active_category'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->active_category($category_id);

	if ($result) {
		?>
		<div class="alert alert-success text-center" role="alert">
		  Activated Category With Category Id <?php echo $category_id; ?>
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger text-center" role="alert">
		  	Cannot Activate Category
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit_category'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";
	extract($_REQUEST);

	$result = $db->category_by_category_id($category_id);

	if ($result->num_rows>0) {
		$row = mysqli_fetch_assoc($result);
		?>

		<div class="row mx-0 px-0 mt-1">
		 	<div class="col-md-2">
		 		<a class="btn btn-outline-warning" onclick="category_info(<?php echo $row['category_id']; ?>)"><-Back</a>
		 	</div>
		 	<div class="col-md-8 bg-warning text-light text-center p-1 rounded">
		 		<p class="display-6">Update Category</p>
		 	</div>
		 	<div class="col-md-2"></div>
		</div>

		<div class="row mx-0 px-0 mt-1">
			<div class="col-md-3"></div>
			<div class="col-md-6" id="edit_category_form_msg"></div>
			<div class="col-md-3"></div>
		</div>

		<div class="row mx-0 px-0 mt-1">
		 	<div class="col-md-2"></div>
		 	<div class="col-md-8 border border-warning rounded p-2">
		 		<form class="row g-3" action="">
		 			<div class="mb-3">
					  <label for="category_title" class="form-label">Category Title</label>
					  <input type="text" class="form-control" id="category_title" name="category_title" value="<?php echo $row['category_title']; ?>" >
						<div id="category_title_msg" class="text-danger"></div>
					</div>
					<div class="mb-3">
					  <label for="category_description" class="form-label">Category Description</label>
					  <textarea class="form-control" id="category_description" name="category_description" rows="3"><?php echo $row['category_description']; ?></textarea>
						<div id="category_description_msg" class="text-danger"></div>
					</div>
					<div class="d-grid gap-2">
				    	<button type="button" class="btn btn-warning text-light" onclick="updateCategory(<?php echo $row['category_id']; ?>)">Update Category</button>
				    </div>
		 	</div>
		 	<div class="col-md-2"></div>
		</div>

		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_category') {
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->update_category($category_title,$category_description,$category_id);

	if ($result) {
		?>
		<div class="alert alert-success text-center" role="alert">
		  Updated Category With Category Id <?php echo $category_id; ?>
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger text-center" role="alert">
			Cannot Update Category  		
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'rejected_users'){
	// echo "Ok";

	?>

	<div class="row mx-0 px-0">
		<div class="col-md-2"></div>
		<div class="col-md-8 bg-danger text-center text-light p-1 rounded">
			<p class="display-6">Rejected Users</p>
		</div>
		<div class="col-md-2"></div>
	</div>


	<div class="row mx-0 px-0 mt-1 table-responsive">
		<table id="example" class="display" style="width: 100%">
			<thead>
				<tr>
					<th>S.No</th>
					<th>Profile Image</th>
					<th>Full Name</th>
					<th>Email</th>
					<th>Gender</th>
					<th>Address</th>
					<th>Rejected At</th>
				</tr>
			</thead>
			<tbody>

			<?php
				$result = $db->rejected_users();
				if ($result->num_rows>0) {
					$count = 1;
					while ($row = mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td class="text-danger"><?php echo $count++; ?></td>
							<td><img src="Profile_Images/<?php echo $row['profile_img']; ?>" alt="" style="width: 40px; height: 40px;"></td>
							<td class="text-danger"><?php echo $row['first_name']." ".$row['last_name']; ?></td>
							<td class="text-danger"><?php echo $row['email']; ?></td>
							<td class="text-danger"><?php echo $row['gender']; ?></td>
							<td class="text-danger"><?php echo $row['home_town']; ?></td>
							<td class="text-danger"><?php echo $row['updated_at']; ?></td>
						</tr>
						<?php
					}
				}
	 		?>
				
			</tbody>
		</table>
	</div>

	<?php

}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'user_info'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";
	extract($_REQUEST);
	$result = $db->user_by_user_id($user_id);

	?>

	<div class="row mx-0 px-0">
		<div class="col-md-2">
			<a class="btn btn-outline-warning" onclick="view_users()"><-Back</a>
		</div>
		<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
			<p class="display-6">User Information</p>
		</div>
		<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0 mt-1">
		<div class="col-md-3"></div>
		<div class="col-md-6 border border-warning rounded p-2">
			<?php
			if ($result->num_rows>0) {
				$row = mysqli_fetch_assoc($result);
				?>
				<img src="Profile_Images/<?php echo $row['profile_img']; ?>" style="width: 80px;height: 80px;">
				<p class="text-info"><strong >Full Name: </strong><?php echo $row['first_name']." ".$row['last_name']; ?></p>
				<p class="text-info"><strong>Email: </strong><?php echo $row['email']; ?></p>
				<p class="text-info"><strong>Password: </strong><?php echo $row['password']; ?></p>
				<p class="text-info"><strong>Gender: </strong><?php echo $row['gender']; ?></p>
				<p class="text-info"><strong>Date of Birth: </strong><?php echo $row['date_of_birth']; ?></p>
				<p class="text-info"><strong>Address: </strong><?php echo $row['home_town']; ?></p>
				<p class="text-info"><strong>Created At: </strong><?php $db->date_time_format($row['created_at']); ?></p>
				<p class="text-info"><strong>Updated At: </strong><?php $db->date_time_format($row['updated_at']); ?></p>
				<p class="text-info"><strong>Approval: </strong><?php echo $row['approval']; ?></p>
				<p class="text-info"><strong>Status: </strong><?php echo $row['status']; ?></p>
				<p class="text-info"><strong>Role Type: </strong>
				<?php
				if ($row['role_id'] == 1) {
					echo "Admin";
				}elseif($row['role_id'] == 2){
					echo "User";
				}
				 ?>
				</p>
				<a class="btn btn-outline-danger" onclick="edit_user(<?php echo $row['user_id']; ?>)">Edit</a>
				<?php
			}

			 ?>
		</div>
		<div class="col-md-3"></div>
	</div>

	<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'blog_info'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);
	$result = $db->blog_by_blog_id($blog_id);
	?>
	<div class="row mx-0 px-0">
		<div class="col-md-2">
			<a class="btn btn-outline-warning" onclick="view_blogs()"><-Back</a>
		</div>
		<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
			<p class="display-6">Blog Information</p>
		</div>
		<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0 mt-1">
		<div class="col-md-3"></div>
		<div class="col-md-6 border border-warning rounded p-2">
			<?php
			if ($result->num_rows>0) {
				$row = mysqli_fetch_assoc($result);
				?>
				<img src="Blog_Background_Images/<?php echo $row['blog_background_image']; ?>" style="width: 100%;height: 230px;">
				<p class="text-info"><strong >Author Name: </strong><?php echo $row['first_name']." ".$row['last_name']; ?></p>
				<p class="text-info"><strong>Title: </strong><?php echo $row['blog_title']; ?></p>
				<p class="text-info"><strong>Post Per Page: </strong><?php echo $row['posts_per_page']; ?></p>
				<p class="text-info"><strong>Created At: </strong><?php $db->date_time_format($row['created_at']); ?></p>
				<p class="text-info"><strong>Updated At: </strong><?php $db->date_time_format($row['updated_at']); ?></p>
				<p class="text-info"><strong>Status: </strong><?php echo $row['blog_status']; ?></p>
				<a class="btn btn-outline-danger" onclick="edit_blog(<?php echo $row['blog_id']; ?>)">Edit</a>
				<?php
			}

			 ?>
		</div>
		<div class="col-md-3"></div>
	</div>
	<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'category_info'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);
	$result = $db->category_by_category_id($category_id);
	?>
	<div class="row mx-0 px-0">
		<div class="col-md-2">
			<a class="btn btn-outline-warning" onclick="view_categories()"><-Back</a>
		</div>
		<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
			<p class="display-6">Category Information</p>
		</div>
		<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0 mt-1">
		<div class="col-md-3"></div>
		<div class="col-md-6 border border-warning rounded p-2">
			<?php
			if ($result->num_rows>0) {
				$row = mysqli_fetch_assoc($result);
				?>
				<p class="text-info"><strong>Category Title: </strong><?php echo $row['category_title']; ?></p>
				<p class="text-info"><strong>Category Description: </strong><?php echo $row['category_description']; ?></p>
				<p class="text-info"><strong>Created At: </strong><?php $db->date_time_format($row['created_at']); ?></p>
				<p class="text-info"><strong>Updated At: </strong><?php $db->date_time_format($row['updated_at']); ?></p>
				<p class="text-info"><strong>Status: </strong><?php echo $row['status']; ?></p>
				<a class="btn btn-outline-danger" onclick="edit_category(<?php echo $row['category_id']; ?>)">Edit</a>
				<?php
			}

			 ?>
		</div>
		<div class="col-md-3"></div>
	</div>
	<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_attachments'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);
	for ($i=1; $i <= $numbers; $i++) { 
		?>
			<label for="attachment_title_<?php echo $i; ?>" class="form-label">Attachment Title <?php echo $i; ?></label>
  			<input type="text" class="form-control" id="attachment_title_<?php echo $i; ?>" name="attachment_title[]">
  			<label for="attachment_file_<?php echo $i; ?>" class="form-label">Attachment File <?php echo $i; ?></label>
		 	<input class="form-control" type="file" name="attachment_file[]" id="attachment_file_<?php echo $i; ?>">
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_post'){
	extract($_REQUEST);
	if (isset($_FILES['featured_image'])) {
		$image = $_FILES['featured_image'];
		$folder = "Post_Featured_Images";

		if (!is_dir($folder)) {
			mkdir($folder);
		}

		$file_name = time()."_".$image['name'];
		$temp_name = $image['tmp_name'];
		$path = $folder."/".$file_name;

		$result = $db->add_post($blog_id,$post_title,$post_summary,$post_description,$is_comment_allowed,$status,$file_name);

		if ($result) {
			$handle = move_uploaded_file($temp_name, $path);
			if ($handle) {
				$post_id = mysqli_insert_id($db->connection);
				foreach ($categories as $key => $value) {
					$result2 = $db->add_post_category($post_id,$value);
				}
				if ($result2) {
					if (isset($_FILES['attachment_file'])) {
						$file = $_FILES['attachment_file'];
						$folder = "Post_Attachments";
						if (!is_dir($folder)) {
							mkdir($folder);
						}

						foreach ($attachment_title as $key => $title) {
							$file_name = time()."_".$file['name'][$key];
							$temp_name = $file['tmp_name'][$key];
							$path = $folder."/".$file_name;
							$result3 = $db->add_post_attachment($post_id,$title,$path);
							if ($result3) {
								$handle2 = move_uploaded_file($temp_name, $path);	
							}
						}
					}
					$result4 = $db->post_mail($blog_id);
					if ($result4->num_rows>0) {
						while ($record = mysqli_fetch_assoc($result4)) {
						$mail->setFrom('as3614851@gmail.com');
						$mail->addAddress($record['email']);
						$mail->Subject = 'Posts Notification';
						$html = "<h3 style='background-color:green'>Dear User!</h3> <h4 style='color:red'>BLOG: ".$record['blog_title']." has Added a Post</h4>";
						$mail->msgHTML($html);
						$mail->send();
						}//
					}

					?>
					<div class="alert alert-success text-center" role="alert">
					  Added a Post
					</div>
					<?php
				}
			}
		}
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'inactive_post'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->inactive_post($post_id);
	if ($result) {
		?>
		<div class="alert alert-danger text-center" role="alert">
		  Post With Post Id <?php echo $post_id; ?> is Inactive
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger text-center" role="alert">
		  Cannot Inactive the Post
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'active_post'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->active_post($post_id);
	if ($result) {
		?>
		<div class="alert alert-success text-center" role="alert">
		  Post With Post Id <?php echo $post_id; ?> is Active
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger text-center" role="alert">
		  Cannot Active the Post
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit_post'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->post_by_post_id($post_id);
	if ($result->num_rows>0) {
		$row = mysqli_fetch_assoc($result);
		?>
		<div class="row mx-0 px-0 mt-1">
		 	<div class="col-md-2">
		 		<a class="btn btn-outline-warning" onclick="view_posts()"><-Back</a>
		 	</div>
		 	<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
		 		<p class="display-6">Update Post</p>
		 	</div>
		 	<div class="col-md-2"></div>
		</div>

		<div class="row mx-0 px-0 mt-1">
		 	<div class="col-md-2"></div>
		 	<div class="col-md-8" id="update_post_form_msg">
		 	</div>
		 	<div class="col-md-2"></div>
		</div>

		<div class="row mx-0 px-0 mt-1">
		 	<div class="col-md-2"></div>
		 	<div class="col-md-8 border border-warning rounded p-2">
		 		<form class="row g-3" id="updatePostForm" method="POST" action="admin-process.php?action=update_post&post_id=<?php echo $row['post_id']; ?>" enctype="multipart/form-data">

		 			<div class="mb-3">
		  				<label for="post_title" class="form-label">Post Title</label>
		  				<input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $row['post_title']; ?>">
		  				<div id="post_title_msg" class="text-danger"></div>
					</div>
					<div class="mb-3">
		  				<label for="post_summary" class="form-label">Post Summary</label>
		  				<input type="text" class="form-control" id="post_summary" name="post_summary" value="<?php echo $row['post_summary']; ?>">
		  				<div id="post_summary_msg" class="text-danger"></div>
					</div>
					<div class="mb-3">
		  				<label for="post_description" class="form-label">Post Description</label>
		  				<textarea class="form-control" id="post_description" name="post_description" rows="3"><?php echo $row['post_description']; ?></textarea>
		  				<div id="post_description_msg" class="text-danger"></div>
					</div>
					<div class="mb-3">
						<div>
							<img src="Post_Featured_Images/<?php echo $row['featured_img']; ?>" style="width: 120px; hyphens: 70px;">
						</div>
					  <label for="featured_image" class="form-label">Featured Image</label>
					  <input class="form-control" type="file" name="featured_image" id="featured_image">
					  <div id="featured_image_msg" class="text-danger"></div>
					</div>

					<div class="mb-3">
						<div class="mb-1"><label>Comments Permission</label></div>
						<?php
						if ($row['is_comment_allowed'] == 'Yes') {
							?>
							<input class="form-check-input" type="radio" name="is_comment_allowed" value="Yes" id="yes" checked>
						  	<label class="form-check-label" for="yes">
						    	Yes
						  	</label>
						  	<input class="form-check-input" type="radio" name="is_comment_allowed" id="no" value="No">
						  	<label class="form-check-label" for="no">
						    	No
						  	</label>
							<?php
						}elseif($row['is_comment_allowed'] == 'No'){
						 ?>

						  <input class="form-check-input" type="radio" name="is_comment_allowed" value="Yes" id="yes" >
						  <label class="form-check-label" for="yes">
						    Yes
						  </label>
						  <input class="form-check-input" type="radio" name="is_comment_allowed" id="no" value="No" checked>
						  <label class="form-check-label" for="no">
						    No
						  </label>
						<?php } ?>
					</div>
					<div class="mb-3">
						    <label for="post_blog" class="form-label">Select a Blog</label>
		    					<select class="form-select" id="post_blog" name="blog_id" required>
		      					<!-- <option  disabled selected value="">--Select your own blog--</option> -->
		      					<?php
		      					$result2 = $db->active_blog_by_user_id($_SESSION['user']['user_id']);
		      					if ($result2->num_rows>0) {
		      						while ($row2 = mysqli_fetch_assoc($result2)) {
		      							if ($row2['blog_id'] != $row['blog_id']) {
		      							?>
		      							<option value="<?php echo $row2['blog_id']; ?>"><?php echo $row2['blog_title']; ?></option>
		      							<?php
		      							}else{
		      								?>
		      							<option value="<?php echo $row2['blog_id']; ?>" selected><?php echo $row2['blog_title']; ?></option>
		      							<?php
		      							}
		      						}
		      					}else{
		      						?>
		      						<option  disabled >--Not any Blog Please Create a one--</option>
		      						<?php
		      					}

		      					 ?>
		    				</select>
						    <div id="blog_msg" class="text-danger">
						    </div>
					</div>
					<div class="col-md-12">
						<div class="mb-3">
							<a class="btn btn-outline-info m-2" onclick="given_categories(<?php echo $row['post_id']; ?>)">View Categories</a>
							<a class="btn btn-outline-info m-2" onclick="given_attachments(<?php echo $row['post_id']; ?>)">View Attachments</a>
						</div>
					</div>
					<div class="d-grid gap-2">
				    	<button type="button" class="btn btn-warning text-light" onclick="update_post(<?php echo $row['post_id'];?>)">Update Post</button>
				  	</div>
		 		</form>
		 	</div>
		 	<div class="col-md-2"></div>
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_post'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// print_r($_FILES['featured_image']);
	// echo "</pre>";

	extract($_REQUEST);
	if (isset($_FILES['featured_image'])) {
				$image = $_FILES['featured_image'];
				$folder = "Post_Featured_Images";
				if (!is_dir($folder)) {
					mkdir($folder);
				}

				if ($image['name'] != "") {
					$file_name = time()."_".$image['name'];
					$temp_name = $image['tmp_name'];
					$path = $folder."/".$file_name;
					$handle = move_uploaded_file($temp_name, $path);
				}else{
					$file_name = "";
				}	
		}

		$result = $db->update_post($post_id,$blog_id,$post_title,$post_summary,$post_description,$is_comment_allowed,$file_name);

		if ($result) {
			?>
			<div class="alert alert-success text-center" role="alert">
			  Post with Post Id <?php echo $post_id ?> is Updated
			</div>
			<?php
		}else{
			?>
			<div class="alert alert-danger text-center" role="alert">
			  Cannot Update the Post
			</div>
			<?php
		}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'given_categories'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	?>
	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-2">
	 		<a class="btn btn-outline-warning" onclick="edit_post(<?php echo $post_id; ?>)"><-Back</a>
	 	</div>
	 	<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
	 		<p class="display-6">View Given Categories</p>
	 	</div>
	 	<div class="col-md-2"></div>
	</div>
	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-2"></div>
	 	<div class="col-md-8" id="view_given_categories_msg">
	 	</div>
	 	<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0 mt-2">
		<div class="col-md-2"></div>
		<div class="col-md-8 border border-warning rounded">
		<form class="row g-3" id="addPostCategoryForm" method="POST" action="admin-process.php?action=add_post_category&post_id=$post_id">
			<div class="mb-3">
					<label>Select Categories</label>
					<select class="js-example-basic-multiple" name="categories[]" id="categories" multiple="multiple" style="width: 100%;">
						<?php
						$result = $db->all_not_selected_categories($post_id);
						if ($result->num_rows>0) {
							while ($row = mysqli_fetch_assoc($result)) {
								?>
								<option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_title']; ?></option>
								<?php
							}
						}else{
							?>
							<option disabled>--No More Categories Available--</option>
							<?php
						}
						

						 ?>
					</select>
					<div id="category_msg" class="text-danger"></div>
				</div>
				<div class="mb-3">
					<button type="button" class="btn btn-warning" onclick="add_post_category(<?php echo $post_id; ?>)">Add Categories</button>
				</div>
		</form>
		</div>
		<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-12 text-center table-responsive">
	 		<table class="display" id="example" style="width: 100%;">
	 			<thead>
	 			<tr>
	 				<th align='center'>S.No</th>
	 				<th align='center'>Category</th>
	 				<th align='center'>Created At</th>
	 				<th align='center'>Updated At</th>
	 				<th align='center'>Actions</th>
	 			</tr>
	 			</thead>
	 			<tbody>
	 				<?php
	 				$result = $db->given_categories($post_id);
	 				if ($result->num_rows>0) {
	 					$count = 1;
	 					while ($row = mysqli_fetch_assoc($result)) {
	 						?>
	 						<tr>
	 							<td><?php echo $count++; ?></td>
	 							<td><?php echo $row['category_title']; ?></td>
	 							<td><?php $db->date_format($row['created_at']); ?></td>
	 							<td><?php $db->date_format($row['updated_at']); ?></td>
	 							<td><?php
	 							if ($row['status'] == 'Active') {
	 								?>
	 								<a class="btn btn-danger" onclick="inactive_given_category(<?php echo $row['post_id'];?>,<?php echo $row['category_post_id'];?>)">Inactive</a>
	 								<?php
	 							}else{
	 								?>
	 								<a class="btn btn-success" onclick="active_given_category(<?php echo $row['post_id'];?>,<?php echo $row['category_post_id'];?>)">Active</a>
	 								<?php
	 							}
	 							?></td>

	 						</tr>
	 						<?php
	 					}
	 				}

	 				 ?>
	 			</tbody>
	 		</table>
	 	</div>
	</div>
	<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'inactive_given_category'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->inactive_given_category($category_post_id);

	if ($result) {
		?>
		<div class="alert alert-danger text-center" role="alert">
			Deactivated
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger text-center" role="alert">
			Cannot Deactivate
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'active_given_category'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->active_given_category($category_post_id);

	if ($result) {
		?>
		<div class="alert alert-success text-center" role="alert">
			Activated
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger text-center" role="alert">
			Cannot Activate
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_post_category'){

	extract($_REQUEST);

	foreach ($categories as $key => $category_id) {
		$result = $db->add_post_category($post_id,$category_id);
	}

	if ($result) {
		?>
		<div class="alert alert-success text-center" role="alert">
			Added Categories Successfully
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger text-center" role="alert">
			Could not Add Categories
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'given_attachments'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	?>
	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-2">
	 		<a class="btn btn-outline-warning" onclick="edit_post(<?php echo $post_id; ?>)"><-Back</a>
	 	</div>
	 	<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
	 		<p class="display-6">View Given Attachments</p>
	 	</div>
	 	<div class="col-md-2"></div>
	</div>
	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-2"></div>
	 	<div class="col-md-8" id="view_given_attachments_msg">
	 	</div>
	 	<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0 mt-2">
		<div class="col-md-2"></div>
		<div class="col-md-8 border border-warning rounded my-2">
		<form class="row g-3" id="addPostAttachmentForm" method="POST" action="admin-process.php?action=add_post_attachment&post_id=$post_id">
			<div class="mb-3" id="attachments">
				<label for="no_of_attachments" class="form-label">Number of attachments you wants to add</label>
	  			<input type="number" class="form-control" id="no_of_attachments">
	  			<div id="attachment_msg" class="text-danger"></div>
	  			<button type="button" class="btn btn-outline-danger mt-1" onclick="add_attachments()">Add</button>
			</div>
			<div class="mb-3">
				<button type="button" class="btn btn-warning" onclick="add_post_attachment(<?php echo $post_id; ?>)">Add Attachments</button>
			</div>
		</form>
		</div>
		<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0 mt-1">
	 	<div class="col-md-12 text-center table-responsive">
	 		<table class="display" id="example" style="width: 100%;">
	 			<thead>
	 			<tr>
	 				<th align='center'>S.No</th>
	 				<th align='center'>Attachment Title</th>
	 				<th align='center'>Created At</th>
	 				<th align='center'>Updated At</th>
	 				<th align='center'>Actions</th>
	 			</tr>
	 			</thead>
	 			<tbody>
	 				<?php
	 				$result = $db->given_attachments($post_id);
	 				if ($result->num_rows>0) {
	 					$count = 1;
	 					while ($row = mysqli_fetch_assoc($result)) {
	 						?>
	 						<tr>
	 							<td><?php echo $count++; ?></td>
	 							<td><?php echo $row['attachment_title']; ?></td>
	 							<td><?php $db->date_format($row['created_at']); ?></td>
	 							<td><?php $db->date_format($row['updated_at']); ?></td>
	 							<td><?php
	 							if ($row['status'] == 'Active') {
	 								?>
	 								<a class="btn btn-danger" onclick="inactive_given_attachment(<?php echo $row['post_id'];?>,<?php echo $row['post_attachment_id'];?>)">Inactive</a>
	 								<?php
	 							}else{
	 								?>
	 								<a class="btn btn-success" onclick="active_given_attachment(<?php echo $row['post_id'];?>,<?php echo $row['post_attachment_id'];?>)">Active</a>
	 								<?php
	 							}
	 							?></td>

	 						</tr>
	 						<?php
	 					}
	 				}

	 				 ?>
	 			</tbody>
	 		</table>
	 	</div>
	</div>
	<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'inactive_given_attachment'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->inactive_given_attachment($post_attachment_id);

	if ($result) {
		?>
		<div class="alert alert-danger text-center" role="alert">
			Deactivated Attachment
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger text-center" role="alert">
			Could not Deactivate
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'active_given_attachment'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->active_given_attachment($post_attachment_id);

	if ($result) {
		?>
		<div class="alert alert-success text-center" role="alert">
			Activated Attachment
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger text-center" role="alert">
			Could not Activate
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_post_attachment'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// print_r($_FILES['attachment_file']);
	// echo "</pre>";

	extract($_REQUEST);
	if (isset($_FILES['attachment_file'])) {
			$file = $_FILES['attachment_file'];
			$folder = "Post_Attachments";
				if (!is_dir($folder)) {
					mkdir($folder);
					}
				foreach ($attachment_title as $key => $title) {
				$file_name = time()."_".$file['name'][$key];
				$temp_name = $file['tmp_name'][$key];
				$path = $folder."/".$file_name;
				$result3 = $db->add_post_attachment($post_id,$title,$path);
					if ($result3) {
							$handle2 = move_uploaded_file($temp_name, $path);	
						}
					}//
					if ($handle2) {
					?>
						<div class="alert alert-success text-center" role="alert">
							Attachment(s) Added Successfully
						</div>
					<?php
					}else{
					?>
						<div class="alert alert-danger text-center" role="alert">
							Could not Add Attachments
						</div>
					<?php
					}
				}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'view_comments'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";
	extract($_REQUEST);

	?>
	<div class="row mx-0 px-0 mt-1">
		<div class="col-md-2">
			<a class="btn btn-outline-warning" onclick="view_posts()"><-Back</a>
		</div>
		<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
			<p class="display-6">View Given Comments</p>
		</div>
		<div class="col-md-2"></div>
	</div>

	<div class="row mx-0 px-0">
		<div class="col-md-3"></div>
		<div class="col-md-6" id="view_given_comments_msg"></div>
		<div class="col-md-3"></div>
	</div>

	<div class="row mx-0 px-0 mt-1 table-responsive">
		<table id="example" class="display" style="width: 100%;">
			<thead>
				<tr>
					<th>S.NO</th>
					<th>Full Name</th>
					<th>Comment</th>
					<th>Created At</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php

				$result = $db->given_comments($post_id);
				if ($result->num_rows>0) {
					$count = 0;
					while ($row = mysqli_fetch_assoc($result)) {
						?>
						<tr>
						<td><?php echo ++$count; ?></td>
						<td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
						<td><?php echo $row['comment']; ?></td>
						<td><?php $db->date_format($row['created_at']); ?></td>
	 					<td><?php
	 						if ($row['status'] == 'Active') {
	 						?>
	 							<a class="btn btn-danger" onclick="inactive_given_comment(<?php echo $row['post_id'];?>,<?php echo $row['comment_id'];?>)">Inactive</a>
	 						<?php
	 						}else{
	 						?>
	 							<a class="btn btn-success" onclick="active_given_comment(<?php echo $row['post_id'];?>,<?php echo $row['comment_id'];?>)">Active</a>
	 						<?php
	 						}
	 							?></td>
	 					</tr>
						<?php
					}
				}

				 ?>
			</tbody>
		</table>
	</div>
	<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'active_given_comment'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);
	$result = $db->active_given_comment($comment_id);
	if ($result) {
		?>
		<div class="alert alert-success text-center" role="alert">
			Activated Comment
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger text-center" role="alert">
			Could not Activate Comment
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'inactive_given_comment'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);
	$result = $db->inactive_given_comment($comment_id);
	if ($result) {
		?>
		<div class="alert alert-danger text-center" role="alert">
			Deactivated Comment
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger text-center" role="alert">
			Could not Deactivate Comment
		</div>
		<?php
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'all_feedbacks'){
	?>
	<div class="row mx-0 px-0">
		<div class="col-md-2"></div>
		<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
			<p class="display-6">All Feedbacks</p>
		</div>
		<div class="col-md-2"></div>
	</div>


	<div class="row mx-0 px-0 mt-1 table-responsive">
		<table id="example" class="display" style="width: 100%">
			<thead>
				<tr>
					<th>S.No</th>
					<th>Full Name</th>
					<th>Email</th>
					<th>Feedback</th>
					<th>Given At</th>
				</tr>
			</thead>
			<tbody>

			<?php
				$result = $db->all_feedbacks();
				if ($result->num_rows>0) {
					$count = 1;
					while ($row = mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['feedback']; ?></td>
							<td><?php $db->date_format($row['created_at']); ?></td>
						</tr>
						<?php
					}
				}
	 		?>
				
			</tbody>
		</table>
	</div>
	<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'visitors_feedback'){
	?>
	<div class="row mx-0 px-0">
		<div class="col-md-2"></div>
		<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
			<p class="display-6">Visitors Feedbacks</p>
		</div>
		<div class="col-md-2"></div>
	</div>


	<div class="row mx-0 px-0 mt-1 table-responsive">
		<table id="example" class="display" style="width: 100%">
			<thead>
				<tr>
					<th>S.No</th>
					<th>Full Name</th>
					<th>Email</th>
					<th>Feedback</th>
					<th>Given At</th>
				</tr>
			</thead>
			<tbody>

			<?php
				$result = $db->visitors_feedback();
				if ($result->num_rows>0) {
					$count = 1;
					while ($row = mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['feedback']; ?></td>
							<td><?php $db->date_format($row['created_at']); ?></td>
						</tr>
						<?php
					}
				}
	 		?>
				
			</tbody>
		</table>
	</div>
	<?php
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'users_feedback'){
	?>
	<div class="row mx-0 px-0">
		<div class="col-md-2"></div>
		<div class="col-md-8 bg-warning text-center text-light p-1 rounded">
			<p class="display-6">Users Feedbacks</p>
		</div>
		<div class="col-md-2"></div>
	</div>


	<div class="row mx-0 px-0 mt-1 table-responsive">
		<table id="example" class="display" style="width: 100%">
			<thead>
				<tr>
					<th>S.No</th>
					<th>Full Name</th>
					<th>Email</th>
					<th>Feedback</th>
					<th>Given At</th>
				</tr>
			</thead>
			<tbody>

			<?php
				$result = $db->users_feedback();
				if ($result->num_rows>0) {
					$count = 1;
					while ($row = mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['feedback']; ?></td>
							<td><?php $db->date_format($row['created_at']); ?></td>
						</tr>
						<?php
					}
				}
	 		?>
				
			</tbody>
		</table>
	</div>
	<?php
}





 ?>