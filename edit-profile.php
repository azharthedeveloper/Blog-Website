<?php
session_start();
require_once('require/general-library.php');
require_once('require/database-library.php');
$obj = new General();

if (isset($_SESSION['user'])) {
	# code...
if (isset($_GET['user_id'])) {
	$user_id = $_GET['user_id'];
	$obj->header();
	$obj->navbar();

	$db = new Database();
	$result = $db->user_by_user_id($user_id);

	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
?>
	<div class="container border border-2 border-warning p-2 rounded" style="margin-top: 70px; min-height: 80vh;">
		<form class="row g-3" method="POST" action="user-process.php" enctype="multipart/form-data">

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

			<div class="col-md-6">
		     <label for="first_name" class="form-label">First Name</label>
		     <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $row['first_name']; ?>" required>
			</div>
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<div class="col-md-6">
			 <label for="last_name" class="form-label">Last Name</label>
			 <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $row['last_name'] ?>" required>
			</div>
		  <div class="col-md-6">
		    <label for="email" class="form-label">Email</label>
		    <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>" required>
		  </div>
		  <div class="col-md-6">
		    <label for="password" class="form-label">Password</label>
		    <input type="text" class="form-control" name="password" id="password" value="<?php echo $row['password'] ?>" required>
		  </div>
		  <div class="col-12">
		    <label for="address" class="form-label">Address</label>
		    <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" value="<?php echo $row['home_town']; ?>" required>
		  </div>
		  <div class="col-md-6">
		  	<div class="mb-2"><label>Gender</label></div>
			  <input class="form-check-input gender" type="radio" name="gender" value="Male" id="gender_male" <?php echo ($row['gender'] == 'Male')?'checked': ''; ?>>
			  <label class="form-check-label" for="gender_male">
			    Male
			  </label>
			  <input class="form-check-input gender" type="radio" name="gender" value="Female" id="gender_female" <?php echo ($row['gender'] == 'Female')?'checked': ''; ?> >
			  <label class="form-check-label" for="gender_female">
			    Female
			  </label>
		  </div>
		  <div class="col-md-6">
		    <label for="date_of_birth" class="form-label">Date of Birth</label>
		    <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="YYYY-MM-DD" value="<?php echo $row['date_of_birth']; ?>" required>
		  </div>
		  <div class="col-12">
		      <label for="profile_image" class="form-label">Profile Image</label>
		      <div class="m-1 p-1">
		      	<img src="Profile_Images/<?php echo $row['profile_img']; ?>" style="width: 40px; height: 40px;">
		      </div>
  			  <input class="form-control" type="file" id="profile_image" name="profile_image">
  			  <div class="text-danger" id="pfp_msg"></div>
		  </div>
		  <div class="d-grid gap-2">
		    <button type="submit" class="btn btn-warning text-light" name="update_profile" value="update_profile">Update Profile</button>
		  </div>
		</form>
	</div>




<?php
	}
	$obj->footer();
}else{
	header("location: index.php");
}
}else{
	header("location: index.php");
}

 ?>