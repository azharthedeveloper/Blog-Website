<?php
session_start();
require_once('require/general-library.php');
require_once('require/database-library.php');
$obj = new General();
if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) {
  // header("location: index.php");
// }else{
$obj->header();
$obj->navbar();
$obj->admin_main_start();
$obj->admin_sidebar();
$obj->admin_content_start();

$db = new Database();


 ?>
<div id="loader" class="bg-warning border border-danger p-1 m-1 rounded">
<div class="d-flex align-items-center text-danger">
      <strong role="status" class="text-danger">Loading... Please Wait...</strong>
      <div class="spinner-border ms-auto" aria-hidden="true"></div>
</div>
</div>

 <div class="row mx-0 px-0" id="dashboard_response">
 	<div class="col-md-12 text-center">
 		<p class="display-2"><b class="text-warning"><?php echo $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']; ?></b> Welcome to Admin Dashboard.</p>
 		<div class="row mx-0 px-0 mt-1">
 			<div class="col-md-4">
 				<div class="card text-bg-warning mb-3" style="max-width: 18rem;">
  				<div class="card-header h4 text-light">Total Users</div>
  				<div class="card-body">
    				<h5 class="card-title display-1 text-center text-light">
              <?php
               echo $db->all_user_stats();
               ?>    
            </h5>
  				</div>
				</div>
 			</div>
 			<div class="col-md-4">
 				<div class="card text-bg-warning mb-3" style="max-width: 18rem;">
  				<div class="card-header h4 text-light">Total Requests</div>
  				<div class="card-body">
    				<h5 class="card-title display-1 text-center text-light">
              <?php echo $db->all_request_stats(); ?>    
            </h5>
  				</div>
				</div>
 			</div>
 			<div class="col-md-4">
 				<div class="card text-bg-warning mb-3" style="max-width: 18rem;">
  				<div class="card-header h4 text-light">Total Blogs</div>
  				<div class="card-body">
    				<h5 class="card-title display-1 text-center text-light">
              <?php echo $db->all_blog_stats(); ?>    
            </h5>
  				</div>
				</div>
 			</div>
 		</div>
 		<div class="row mx-0 px-0 mt-1">
 			<div class="col-md-4">
 				<div class="card text-bg-warning mb-3" style="max-width: 18rem;">
  				<div class="card-header h4 text-light">Total Categories</div>
  				<div class="card-body">
    				<h5 class="card-title display-1 text-center text-light">
              <?php echo $db->all_category_stats(); ?>    
            </h5>
  				</div>
				</div>
 			</div>
 			<div class="col-md-4">
 				<div class="card text-bg-warning mb-3" style="max-width: 18rem; max-height: 30rem;">
  				<div class="card-header h4 text-light">Total Posts</div>
  				<div class="card-body">
    				<h5 class="card-title display-1 text-center text-light">
                <?php echo $db->all_post_stats(); ?>    
            </h5>
  				</div>
				</div>
 			</div>
 			<div class="col-md-4">
 				<div class="card text-bg-warning mb-3" style="max-width: 18rem;">
  				<div class="card-header h4 text-light">Total Feedbacks</div>
  				<div class="card-body">
    				<h5 class="card-title display-1 text-center text-light">
              <?php echo $db->all_feedback_stats(); ?>    
            </h5>
  				</div>
				</div>
 			</div>
 		</div>
 	</div>
 </div>



<?php 
$obj->admin_content_end();
$obj->admin_main_end();
$obj->footer();
}else{
	header("location: index.php");
}
?>