<?php 
session_start();
require_once('require/database-library.php');
$db = new Database();


if (isset($_REQUEST['login'])) {
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	extract($_REQUEST);

	$result = $db->login_user($login_email,$login_password);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);

		if ($row['approval'] == 'Pending') {
			$msg = 'Your Request is Pending Please Wait!';
			$color = 'alert-danger';
			header("location: login-page.php?msg=$msg&color=$color");
		}elseif($row['approval'] == 'Rejected'){
			$msg = 'Your Request for Account Registration is Rejected';
			$color = 'alert-danger';
			header("location: login-page.php?msg=$msg&color=$color");
		}elseif($row['status'] == 'Inactive'){
			$msg = 'Your Account is Deactive please contact Admin';
			$color = 'alert-danger';
			header("location: login-page.php?msg=$msg&color=$color");
		}elseif($row['approval'] == 'Approved' && $row['status'] == 'Active') {
			$_SESSION['user'] = $row;
			header("location: index.php");
			
		}
	}else{
		$msg = 'Incorrect Email or Password';
		$color = 'alert-danger';
		header("location: login-page.php?msg=$msg&color=$color");
	}


}

?>