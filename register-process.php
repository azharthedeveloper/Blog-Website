<?php
// echo "<h1>OK</h1>";
// die;

date_default_timezone_set("Asia/Karachi");
require_once('require/database-library.php');
require_once('require/pdf.php');
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

if (isset($_REQUEST['register'])) {
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	$flag = true;
    $error_msg = null;

	extract($_REQUEST);

	$alpha_pattern = "/^[A-Za-z]+( [A-Za-z]+){0,2}$/";
    $email_pattern = "/^[a-z]{3,50}\d{1,10}[@]{1}[a-z]{3,10}[.]{1}[a-z]{3,6}$/";
    $password_pattern = '/^(.{8,})$/';
    $dob_pattern = '/^\d{4}-\d{2}-\d{2}$/';

    if ($first_name == "") {
        $flag = false;
        $error_msg = "<li>First Name is Required</li>";
    }else{
        if (!preg_match($alpha_pattern, $first_name)) {
            $flag = false;
            $error_msg .= "<li>First Name should be like e.g. Ali, Waqas</li>";
        }
    }

    if ($last_name == "") {
        $flag = false;
        $error_msg .= "<li>Last Name is Required</li>";
    }else{
        if (!preg_match($alpha_pattern, $last_name)) {
            $flag = false;
            $error_msg .= "<li>Last Name should be like e.g. Khan, Malik</li>";
        }
    }

    if ($email == "") {
        $flag = false;
        $error_msg .= "<li>Email is Required</li>";
    }else{
        if (!preg_match($email_pattern, $email)) {
            $flag = false;
            $error_msg .= "<li>Email should be like e.g. example12@gmail.com</li>";
        }
    }

    if ($password == "") {
        $flag = false;
        $error_msg .= "<li>Password is Required</li>";
    }else{
        if (!preg_match($password_pattern, $password)) {
            $flag = false;
            $error_msg .= "<li>Password Should be of atleast 8 characters</li>";
        }
    }

    if ($address == "") {
        $flag = false;
        $error_msg .= "<li>Please, Enter your Address</li>";
    }

    if (!isset($gender)) {
        $flag = false;
        $error_msg .= "<li>Please, Select a Gender</li>";
    }

    if ($date_of_birth == "") {
        $flag = false;
        $error_msg .= "<li>Date of Birth is Required</li>";
    }else{
        if (!preg_match($dob_pattern, $date_of_birth)) {
            $flag = false;
            $error_msg .= "<li>Date of Birth Should be Like YYYY-MM-DD e.g. 1992-11-18</li>";
        }
    }

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
        	$error_msg .= "<li>Image extensions Should be (jpg, jpeg, png)</li>";
	    }
	}

	if ($flag == false) {
		header("location: register-page.php?err_msg=$error_msg");
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
				$result = $db->register_user($first_name,$last_name,$email,$password,$gender,$date_of_birth,$file_name,$address);

				if ($result) {

					$mail->setFrom('as3614851@gmail.com');
					$mail->addAddress($email);
					$mail->Subject = 'Credentials for blog website';
					$html = "<h3 style='background-color:green'>Congratulations! You have been Registered. Here is your Credentials</h3> <h4 style='color:red'>Email: $email</h4><h4 style='color:red'>Password: $password</h4>";
					$mail->msgHTML($html);
					$mail->send();
						$user_id = mysqli_insert_id($db->connection);
						
						$msg = "Registered Successfully";
						$color = "alert-success";
						$location = "register-process.php";
						header("location: register-page.php?msg=$msg&color=$color&user_id=$user_id");
				}else{
					$msg = "Cannot Register Already Registered Email";
					$color = "alert-danger";
					$location = "register-process.php";
					header("location: register-page.php?msg=$msg&color=$color");
				}
			}
		}
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'pdf'){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->user_by_user_id($user_id);

	if ($result->num_rows>0) {
		$row = mysqli_fetch_assoc($result);

		$pdf = new PDF();
		$pdf->AddPage();

		$pdf->addUserDetails($row['first_name'], $row['last_name'], $row['email'], $row['password'], $row['home_town'], $row['gender'], $row['date_of_birth']);

		$pdf->Output('D', $row['first_name'].".pdf");
	}
}elseif(isset($_REQUEST['change_password'])){
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->checks_email($checks_email);
	if ($result->num_rows>0) {
		$password = "dummy_".rand(100,10000);
		$result2 = $db->change_password($checks_email,$password);
		if ($result2) {
			$mail->setFrom('as3614851@gmail.com');
			$mail->addAddress($checks_email);
			$mail->Subject = 'Password Changed';
			$html = "<h3 style='background-color:green'>Congratulations! Your Password Has been Changed</h3><h4 style='color:red'>Your New Password is : $password</h4>";
			$mail->msgHTML($html);
			if($mail->send()){
			$msg = "Password Changed Please Check Mail";
			$color = 'alert-success';
			header("location: forgot-password.php?msg=$msg&color=$color");
			}else{
				$msg = "Password Changed but Mail could not be sent try again later!";
				$color = 'alert-danger';
				header("location: forgot-password.php?msg=$msg&color=$color");
			}
		}else{
			$msg = "Cannot Change Password! please Try Again";
			$color = 'alert-danger';
			header("location: forgot-password.php?msg=$msg&color=$color");
		}

	}else{
		$msg = "Invalid Email! please Try Again";
		$color = 'alert-danger';
		header("location: forgot-password.php?msg=$msg&color=$color");
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'checks_email'){
	extract($_REQUEST);

	$result = $db->checks_email($email);

	if ($result->num_rows>0) {
		echo "Yes";
	}else{
		echo "No";
	}
}

 ?>
