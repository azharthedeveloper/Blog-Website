<?php
session_start();

require_once('require/general-library.php');
require_once('require/database-library.php');

$db = new Database();

$obj = new General();
$obj->header();
$obj->navbar();
 ?>

	<div class="container border border-2 border-warning rounded p-2" style="margin-top: 70px; min-height: 80vh;">

		<?php
		if (isset($_REQUEST['post_id'])) {
			$post_id = $_REQUEST['post_id'];
		 ?>

		<div class="row mx-0 px-0">
			<div class="col-md-1"></div>
			<?php
			$result = $db->show_post_by_post_id($post_id);
			if ($result->num_rows>0) {
				$row = mysqli_fetch_assoc($result);
			?>
			<div class="col-md-10 border border-2 border-danger rounded p-2">
				<img src="Post_Featured_Images/<?php echo $row['featured_img']; ?>" style="width: 100%; height: 250px;">
				<span class="text-center my-2 h2"><a href="this-blog.php?blog_id=<?php echo $row['blog_id']; ?>" class="text-warning" style="text-decoration: none;"><b><?php echo $row['blog_title']; ?></b></a></span>
				<span class="text-secondary float-end h6"><?php $db->date_format($row['created_at']); ?></span>
				<h5 class="my-2"><b>Post Title: </b><?php echo $row['post_title']; ?></h5>
				<h5 class="my-2"><b>Post Summary: </b><?php echo $row['post_summary']; ?></h5>
				<h5 class="my-2"><b>Post Description: </b><?php echo $row['post_description']; ?></h5>

				<?php
				$result2 = $db->post_attachment_by_post_id($post_id);
				if ($result2->num_rows>0) {
				 ?>
				<h5><b>Attachments:</b></h5>
				<?php
				while ($row2 = mysqli_fetch_assoc($result2)) {
				?>
					<a href="<?php echo $row2['attachment_path']; ?>" class="attachment_icon mx-1" download><?php echo $row2['attachment_title'];?></a>
				<?php
					}
				 } 
				 ?>
			</div>
			<div class="col-md-1"></div>
		</div>

		<div class="row mt-2 mx-0 px-0">
			<div class="col-md-1"></div>
			<div class="col-md-10 border border-2 border-danger rounded p-2" style="background-color: antiquewhite;">
				<div class="col-md-12">
					<?php
					$result3 = $db->show_post_comment_by_post_id($post_id);
					if ($result3->num_rows>0) {
						while ($row3 = mysqli_fetch_assoc($result3)) {
					 ?>
					<div class="border border-dark rounded p-1 my-1">
					<img class="rounded-circle" src="Profile_Images/<?php echo $row3['profile_img'] ?>" style="width: 30px; height: 30px;">
					<span><b class="text-primary"><?php echo $row3['first_name']." ".$row3['last_name']; ?> </b><?php echo $row3['comment']; ?></span>
					</div>
					<?php
						}
					}else{
						?>
						<p class="border border-dark p-1 text-center"><b class="text-secondary">Be the First to Comment</b></p>
						<?php
					}
					 ?>
				</div>

				<?php
				if ($row['is_comment_allowed'] == 'Yes') {
				 ?>
				<div class="col-md-12">
				<form action="user-process.php">
					<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
					<div class="form-group">
                        <label for="comment">Leave a Comment</label>
                        <textarea class="form-control" id="comment" name="given_comment" rows="2"></textarea>
                    </div>
                    <?php
                    if (isset($_SESSION['user'])) {
                    ?>
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id']; ?>">
                    <div class="d-grid gap-2 m-1">
                        <button class="btn btn-warning text-light" type="submit" name="comment" value="comment">Comment</button>
                    </div>
                <?php 
                     }else{
                     	?>
                     	<a type="button" class="btn btn-warning my-1 text-light" data-bs-toggle="modal" data-bs-target="#exampleModal" style="width: 100%;">Comment</a>
                  <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Login Error</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body text-danger">
                            Please Login first! <a href="login-page.php">LOGIN HERE</a>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                     	<?php
                     }
                ?>
                </form>
				</div>
			<?php 
				}
			?>
			</div>
			<div class="col-md-1"></div>
		</div>
		<?php 
			}else{
				header("location: index.php");
			}
		}else{
			header("location: index.php");
		}
		?>

	</div>

<?php

$obj->footer();

 ?>