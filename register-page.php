<?php

session_start();

if (isset($_SESSION['user'])) {
  header("location: index.php");
}else{
require_once('require/general-library.php');
$obj = new General();
$obj->header();
$obj->navbar();

if (isset($_REQUEST['user_id'])) {
	$user_id = $_REQUEST['user_id'];

	?>
<div aria-live="polite" aria-atomic="true" class="bg-body-secondary position-relative bd-example-toasts rounded-3">
  <div class="toast-container p-3 top-0 end-0" id="toastPlacement">
    <div class="toast show">
      <div class="toast-header bg-warning">
        <img src="images/logo2.jpg" class="rounded-circle me-2" alt="..." style="width: 30px; height: 30px;">
        <strong class="me-auto text-light">Blog Website</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>

      </div>
      <div class="toast-body">
        <p>Congratulations! You have been Registered, you can check your Email for Credentials or Download it Here.</p>
        <a href="register-process.php?action=pdf&user_id=<?php echo $user_id; ?>" class="btn btn-warning text-light">Download Credentials</a>
        <a href="login-page.php" class="btn btn-warning text-light">Login Here</a>

      </div>
    </div>
  </div>
</div>
	<?php
}

$obj->registeration_form();
$obj->footer();
}
 ?>