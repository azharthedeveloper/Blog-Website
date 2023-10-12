<?php
session_start();
	require_once('require/general-library.php');
	require_once('require/database-library.php');
	$db = new Database();

	$obj= new General();
	$obj->header();
	$obj->navbar();
?>

<style type="text/css">
		<?php

		if (isset($_SESSION['user'])) {

			$flag = $db->check_theme_setting($_SESSION['user']['user_id']);
			if ($flag) {
				$result = $db->select_theme_setting($_SESSION['user']['user_id']);
				if ($result->num_rows>0) {
					while ($row = mysqli_fetch_assoc($result)) {
						if ($row['setting_key'] == 'post_background_color') {
							echo ".post_background_color{
									background-color: {$row['setting_value']};
								}";
						}
						if ($row['setting_key'] == 'post_title_color') {
							echo ".post_title_color{
									color: {$row['setting_value']};
								}";
						}
						if ($row['setting_key'] == 'post_title_font_size') {
							echo ".post_title_font_size{
									font-size: {$row['setting_value']};
								}";
						}
						if ($row['setting_key'] == 'post_font_style') {
							echo ".post_font_style{
									font-style: {$row['setting_value']};
									}";
						}
						if ($row['setting_key'] == 'post_font_weight') {
							echo ".post_font_weight{
									font-weight: {$row['setting_value']};
									}";
						}
					}
				}

			}else{
				echo ".post_background_color{
						background-color: white;
					}";
				echo ".post_title_color{
						color: black;
						}";
				echo ".post_title_font_size{
						font-size: 20px;
						}";
				echo ".post_font_style{
						font-style: normal;
						}";
				echo ".post_font_weight{
						font-weight: normal;
						}"; 
			}
		}else{
		echo ".post_background_color{
				background-color: white;
			}";
		echo ".post_title_color{
				color: black;
				}";
		echo ".post_title_font_size{
				font-size: 20px;
				}";
		echo ".post_font_style{
				font-style: normal;
				}";
		echo ".post_font_weight{
				font-weight: normal;
				}"; 
		}
		?>
</style>

	<!--Main Content Start-->
	<div class="container-fluid border mx-0 px-0" style="margin-top: 70px;">

			<div class="col-md-12">

				<!--Image Slider Start-->
				<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
				  <div class="carousel-inner">
				    <div class="carousel-item active">
				      <img src="images/slider1.jpg" class="d-block w-100" height="550">
				    </div>
				    <div class="carousel-item">
				      <img src="images/slider2.jpg" class="d-block w-100" height="550">
				    </div>
				    <div class="carousel-item">
				      <img src="images/slider3.jpg" class="d-block w-100" height="550">
				    </div>
				  </div>
				  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="visually-hidden">Previous</span>
				  </button>
				  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="visually-hidden">Next</span>
				  </button>
				</div>
				<!--Image Slider End-->

				
			</div>

			<div class="row mx-0 px-0">
				<div class="col-md-3 mt-2 border border-2 border-warning rounded">
					<div class="col-md-12 m-1 p-1 bg-warning text-light text-center rounded">
							<h5 class="">Recent Blogs</h5>
						</div>
						<?php
						$result = $db->show_all_active_blog_5();
						if ($result->num_rows>0) {
							while ($row = mysqli_fetch_assoc($result)) {
							?>
							<div class="col-md-12 m-1 p-1 border border-2 border-dark rounded">
								<a href="this-blog.php?blog_id=<?php echo $row['blog_id']; ?>" style="text-decoration: none;">
								  <img src="Blog_Background_Images/<?php echo $row['blog_background_image']; ?>" class="mx-1 rounded" style="width: 180px; height: 80px;">
								  <span class="text-secondary"><small><?php $db->date_format($row['created_at']); ?></small></span>
								  <p class="py-0 my-0 text-dark h5"><b><?php echo $row['blog_title'] ?></b></p>
							    </a>
							</div>
							<?php
							}
						}
						?>
				</div>

				<div class="col-md-6 mt-2 border border-2 border-warning rounded" style="background-color: whitesmoke;">

					<div class="col-md-12 bg-warning text-light text-center rounded m-1 p-1">
						<p class="display-6">Our Posts</p>
					</div>
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $postsPerPage = 3; 
                ?>
					<div class="col-md-12 bg-warning text-light text-center rounded m-1 p-1">
						    <div class="d-flex" role="search">
						      <input class="form-control me-2" id="search_post" type="search" placeholder="Search Posts" aria-label="Search" onkeyup="search_post(<?php echo $page ?>, <?php echo $postsPerPage ?>)">
						      <button class="btn btn-outline-danger" type="button" onclick="search_post()">Search</button>
						    </div>
					</div>
					<div class="row mx-0 px-0 my-2" id="home_posts">
						<?php
							$offset = ($page - 1) * $postsPerPage;
            				$result3 = $db->show_active_posts_paged($postsPerPage, $offset);
						if ($result3->num_rows>0) {
						 	while ($row3 = mysqli_fetch_assoc($result3)) {
						 		?>
						 		<div class="row my-2">
									<div class="col-md-1"></div>
									<div class="col-md-10">
										<div class="card mb-3 border border-warning post_background_color">
	                             		<img src="Post_Featured_Images/<?php echo $row3['featured_img']; ?>" class="card-img-top">
	                             	<div class="card-body">
	                              		<h5 class="card-title post_title_color post_title_font_size post_font_style post_font_weight"><?php echo $row3['post_title']; ?></h5>
	                              		<p class="card-text post_font_style post_font_weight"><?php echo $row3['post_summary']; ?></p>
	                              		<span class="card-text post_font_style post_font_weight"><a href="post-page.php?post_id=<?php echo $row3['post_id']; ?>">See this Post...</a></small></span>
	                              		<span class="float-end text-secondary post_font_style"><?php $db->date_format($row3['created_at']); ?></span> 
	                             		</div>
	                            	</div>
									</div>
									<div class="col-md-1"></div>
								</div>
						 		<?php
						 	}
						 } 
						?>
						<nav aria-label="Page navigation" class="text-center">
            				<ul class="pagination justify-content-center">
				            	<?php 
				            	$result3 = $db->show_active_posts();
				                $totalPosts = mysqli_num_rows($result3);
				                $totalPages = ceil($totalPosts / $postsPerPage);

				                // Display Previous Button
				                if ($page > 1) {
				                    echo '<li class="page-item">';
				                    echo '<a class="page-link" href="index.php?page=' . ($page - 1) . '">Previous</a>';
				                    echo '</li>';
				                }

				                // Display Page Links
				                for ($i = 1; $i <= $totalPages; $i++) {
				                    echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '">';
				                    echo '<a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a>';
				                    echo '</li>';
				                }

				                // Display Next Button
				                if ($page < $totalPages) {
				                    echo '<li class="page-item">';
				                    echo '<a class="page-link" href="index.php?page=' . ($page + 1) . '">Next</a>';
				                    echo '</li>';
				                }
				            	?>
            				</ul>
        				</nav>

					</div>
				</div>

				<div class="col-md-3 mt-2 rounded border border-2 border-warning">

				<?php
					if (isset($_SESSION['user'])) {
					 ?>
					<div class="col-md-12 m-1 p-1 text-center border border-2 border-warning rounded">
						<h5 class="bg-warning text-light rounded p-1">Theme Settings</h5>
						<button type="button" class="btn btn-outline-warning mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Cutomize theme</button>
						<div class="modal fade" data-bs-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  						<div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h1 class="modal-title fs-5 text-warning" id="exampleModalLabel">Customize Theme</h1>
						        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <div class="modal-body">
						        <form action="user-process.php" method="POST">
						          <div class="col-md-12 mb-1 d-flex justify-content-between">
						          	<input type="hidden" name="key[]" value="post_title_color">
						          	<label for="post_title_color">Post Title Color: </label>
						          	<input type="color" id="post_title_color" name="value[]" style="width: 50%;" value="#000000">
						          </div>
						          <div class="col-md-12 mb-1 d-flex justify-content-between">
						          	<input type="hidden" name="key[]" value="post_background_color">
						          	<label for="post_background_color">Post Background Color: </label>
						          	<input type="color" id="post_background_color" name="value[]" style="width: 50%;" value="#ffffff">
						          </div>
						          <div class="col-md-12 mb-1 d-flex justify-content-between">
						          	<input type="hidden" name="key[]" value="post_title_font_size">
						          	<label for="post_title_font_size">Post Title Font Size: </label>
						          	<!-- <input type="number" id="post_title_font_size" name="value[]" style="width: 50%;" required> -->
						          	<select name="value[]" id="post_title_font_size" style="width: 50%;">
						          		<option selected value="20px">20px</option>
						          		<option value="24px">24px</option>
						          		<option value="30px">30px</option>
						          	</select>
						          </div>
						          <div class="col-md-12 mb-1 d-flex justify-content-between">
						          	<input type="hidden" name="key[]" value="post_font_style">
						          	<label for="post_font_style">Post Font Style: </label>
						          	<select name="value[]" id="post_font_style" style="width: 50%;">
						          		<option disabled>--Select Font Style--</option>
						          		<option selected value="normal">normal</option>
						          		<option value="italic">italic</option>
						          		<option value="oblique">oblique</option>
						          	</select>
						          </div>
						          <div class="col-md-12 mb-1 d-flex justify-content-between">
						          	<input type="hidden" name="key[]" value="post_font_weight">
						          	<label for="post_font_weight">Post Font Weight: </label>
						          	<select name="value[]" id="post_font_weight" style="width: 50%;" required>
						          		<option disabled>--Select Font Weight--</option>
						          		<option value="normal" selected>normal</option>
						          		<option value="bold">bold</option>
						          	</select>
						          </div>
						      </div>
						      <div class="modal-footer">
						      	<input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id']; ?>">

						      	<?php
						      	$flag = $db->check_theme_setting($_SESSION['user']['user_id']);
						      	if ($flag) {
						      		?>
						      		<button type="submit" name="save_changes" value="save_changes" class="btn btn-warning">Save Changes</button>
						      		<?php
						      	}else{
						      	 ?>
						          <button type="submit" name="save" value="save" class="btn btn-warning">Save</button>
						      <?php } ?>
						        </form>
						      </div>
						    </div>
						  </div>
						</div>
					</div>
				<?php } ?>



						<div class="col-md-12 m-1 p-1 bg-warning text-light text-center rounded">
							<h5 class="">Recent Posts</h5>
						</div>
						<?php
						$result2 = $db->show_all_active_post_5();
						if ($result2->num_rows>0) {
							while ($row2 = mysqli_fetch_assoc($result2)) {
								?>
								<div class="col-md-12 m-1 p-1 border border-2 border-dark rounded">
									<a href="post-page.php?post_id=<?php echo $row2['post_id']; ?>" style="text-decoration: none;">
							  		<img src="Post_Featured_Images/<?php echo $row2['featured_img']; ?>" class="mx-1 rounded" style="width: 50px; height: 50px;">
							  		<span class="text-secondary"><small><?php $db->date_format($row2['created_at']) ?></small></span>
							  		<p class="my-0 py-0 text-dark"><?php echo $row2['post_title']; ?></p>
						    		</a>
								</div>
								<?php
							}
						}
						 ?>			
				</div>
			</div>

	</div>
	<!--Main Content End-->

<?php
     $obj->footer(); 
?>	

