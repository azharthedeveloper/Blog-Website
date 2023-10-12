<?php
session_start();
require_once('require/database-library.php');
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


$db = new Database();

date_default_timezone_set("Asia/Karachi");

if (isset($_REQUEST['update_profile'])) {
	// echo "<pre>";
	// print_r($_REQUEST);
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
		$color = 'alert-danger';
		header("location: edit-profile.php?user_id=$user_id&msg=$error_msg&color=$color");
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

				$result = $db->update_profile($user_id,$first_name,$last_name,$email,$password,$gender,$address,$date_of_birth,$file_name);

				if ($result) {
					$result2 = $db->user_by_user_id($user_id);

					if ($result2->num_rows>0) {
						$row = mysqli_fetch_assoc($result2);
						$_SESSION['user'] = $row;
						$msg = "Updated Profile Successfully";
						$color = 'alert-success';
						header("location: edit-profile.php?user_id=$user_id&msg=$msg&color=$color");
					}
				}else{
					$msg = "Cannot Update Profile";
					$color = 'alert-danger';
					header("location: edit-profile.php?user_id=$user_id&msg=$msg&color=$color");
				}
		}
	}
}elseif(isset($_REQUEST['add_feedback'])){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->add_feedback($feedback_name,$feedback_email,$feedback,$user_id);
	if ($result) {
		$result2 = $db->all_active_admins();
		if ($result2->num_rows>0) {
			while ($row = mysqli_fetch_assoc($result2)) {
					$mail->setFrom('as3614851@gmail.com');
					$mail->addAddress($row['email']);
					$mail->Subject = 'Feedback Update';
					$html = "<h3 style='background-color:green'>Dear Admin!</h3> <h4 style='color:red'>$feedback_name has given a feedback</h4>";
					$mail->msgHTML($html);
					$mail->send();
			}
		}
		$msg = "Feedback Added Successfully";
		$color = 'alert-success';
		header("location: contact-page.php?msg=$msg&color=$color");
	}else{
		$msg = "Feedback Could not Add";
		$color = 'alert-danger';
		header("location: contact-page.php?msg=$msg&color=$color");
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'unfollow_blog'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->unfollow_blog($follower_id,$blog_following_id);
	if ($result) {
		// echo "Unfollowed";
		$result2 = $db->follower_fullname($follower_id,$blog_following_id);
		if ($result2->num_rows>0) {
			$row = mysqli_fetch_assoc($result2);
			$follower_full_name = $row['first_name']." ".$row['last_name'];
			$result3 = $db->blog_author_email($follower_id,$blog_following_id);
			if ($result3->num_rows>0) {
				$row2 = mysqli_fetch_assoc($result3);
				$author_email = $row2['email'];
				$blog_name = $row2['blog_title'];
					$mail->setFrom('as3614851@gmail.com');
					$mail->addAddress($author_email);
					$mail->Subject = 'Follow Update';
					$html = "<h3 style='background-color:green'>Dear Admin!</h3> <h4 style='color:red'>$follower_full_name has UNFOLLOWED your Blog $blog_name</h4>";
					$mail->msgHTML($html);
					if ($mail->send()) {
						echo "OK";
					}else{
						echo "OK";
					}
			}
		}
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'follow_blog'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->follow_blog($follower_id,$blog_following_id);
	if ($result) {
		// echo "Followed";
		$result2 = $db->follower_fullname($follower_id,$blog_following_id);
		if ($result2->num_rows>0) {
			$row = mysqli_fetch_assoc($result2);
			$follower_full_name = $row['first_name']." ".$row['last_name'];
			$result3 = $db->blog_author_email($follower_id,$blog_following_id);
			if ($result3->num_rows>0) {
				$row2 = mysqli_fetch_assoc($result3);
				$author_email = $row2['email'];
				$blog_name = $row2['blog_title'];
					$mail->setFrom('as3614851@gmail.com');
					$mail->addAddress($author_email);
					$mail->Subject = 'Follow Update';
					$html = "<h3 style='background-color:green'>Dear Admin!</h3> <h4 style='color:red'>$follower_full_name has FOLLOWED your Blog $blog_name</h4>";
					$mail->msgHTML($html);
					if ($mail->send()) {
						echo "OK";
					}else{
						echo "OK";
					}
			}
		}
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_follow_blog'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->add_follow_blog($follower_id,$blog_following_id);
	if ($result) {
		// echo "Followed";
		$result2 = $db->follower_fullname($follower_id,$blog_following_id);
		if ($result2->num_rows>0) {
			$row = mysqli_fetch_assoc($result2);
			$follower_full_name = $row['first_name']." ".$row['last_name'];
			$result3 = $db->blog_author_email($follower_id,$blog_following_id);
			if ($result3->num_rows>0) {
				$row2 = mysqli_fetch_assoc($result3);
				$author_email = $row2['email'];
				$blog_name = $row2['blog_title'];
					$mail->setFrom('as3614851@gmail.com');
					$mail->addAddress($author_email);
					$mail->Subject = 'Follow Update';
					$html = "<h3 style='background-color:green'>Dear Admin!</h3> <h4 style='color:red'>New Follower $follower_full_name has FOLLOWED your Blog $blog_name</h4>";
					$mail->msgHTML($html);
					if ($mail->send()) {
						echo "OK";
					}else{
						echo "OK";
					}
			}
		}
	}
}elseif(isset($_REQUEST['comment'])){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);
	$result = $db->add_comment($user_id,$post_id,$given_comment);

	if ($result == true || $result == false) {
		header("location: post-page.php?post_id=$post_id");
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'search_post'){
	extract($_REQUEST);
	$result3 = $db->search_active_posts($search);
		if ($result3->num_rows>0) {
			while ($row3 = mysqli_fetch_assoc($result3)) {
			?>
				<div class="row my-2">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="card mb-3 border border-warning">
	                    <img src="Post_Featured_Images/<?php echo $row3['featured_img']; ?>" class="card-img-top">
		                    <div class="card-body">
		                        <h5 class="card-title"><?php echo $row3['post_title']; ?></h5>
		                        <p class="card-text"><?php echo $row3['post_summary']; ?></p>
		                        <span class="card-text"><a href="post-page.php?post_id=<?php echo $row3['post_id']; ?>">See this Post...</a></small></span>
		                        <span class="float-end text-secondary"><?php $db->date_format($row3['created_at']); ?></span> 
		                    </div>
		                </div>
					</div>
					<div class="col-md-1"></div>
				</div>
						 		<?php
						 	}
						 } 
}elseif(isset($_REQUEST['save_changes'])){
	echo "<pre>";
	print_r($_REQUEST);
	echo "</pre>";

	extract($_REQUEST);

	foreach ($key as $k => $v) {
		$result = $db->update_theme_setting($user_id,$v,$value[$k]);
	}

	if ($result) {
		header("location: index.php");
	}else{
		header("location: index.php");
	}
}elseif(isset($_REQUEST['save'])){
	echo "<pre>";
	print_r($_REQUEST);
	echo "</pre>";

	extract($_REQUEST);

	foreach ($key as $k => $v) {
		$result = $db->insert_theme_setting($user_id,$v,$value[$k]);
	}

	if ($result) {
		header("location: index.php");
	}else{
		header("location: index.php");
	}
}



 ?>