<?php
session_start();
if (isset($_SESSION['user'])) {
	header("location: index.php");
}else{
require_once('require/general-library.php');
$obj = new General();
$obj->header();
$obj->navbar();
$obj->change_password_form();
$obj->footer();
}
 ?>