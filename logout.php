<?php

session_start();
session_destroy();

$msg="Logged out Successfully";
$color = 'alert-success';
header("location: login-page.php?msg=$msg&color=$color");
 ?>