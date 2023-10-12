<?php
session_start();
require_once('require/general-library.php');
require_once('require/database-library.php');
$db = new Database();
$obj = new General();
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



  <div class="container-fluid" style="margin-top: 70px;">

    <?php
    if (isset($_REQUEST['blog_id'])) {
      $blog_id = $_REQUEST['blog_id'];
      // echo $blog_id;
      // die;
      $result = $db->blog_by_blog_id($blog_id);
      if ($result->num_rows>0) {
        $row = mysqli_fetch_assoc($result);
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $posts_per_page = $row['posts_per_page'];
        // $posts_per_page = 2;
     ?>
    <div class="row mx-0 px-0">
      <div class="col-md-12 mx-0 px-0">
        <img class="" src="Blog_Background_Images/<?php echo $row['blog_background_image'] ?>" style="width: 100%; height: 500px;">
      </div>
    </div>
    <div class="row mx-0 px-0">
      <div class="col-md-8 border border-2 border-warning rounded mt-1 p-1">
        <div class="row mx-0 px-0 bg-warning rounded mb-1">
          <div class="col-md-4 text-light text-center rounded">
            <p class="display-6"><?php echo $row['blog_title']; ?></p>
          </div>
          <div class="col-md-4 text-center h6 my-2">Author Name <b><?php echo $row['first_name']." ".$row['last_name']; ?></b></div>
          <div class="col-md-2">
            <p class="text-secondary text-center my-2"><?php $db->date_format($row['created_at']); ?></p>
          </div>
          <div class="col-md-2 text-center">
            <?php
                if (isset($_SESSION['user'])) {
                $result5 = $db->checks_author($_SESSION['user']['user_id'],$row['blog_id']);
                  if (!$result5->num_rows>0){
                  $result3 = $db->checks_follow($_SESSION['user']['user_id'],$row['blog_id']);
                  if ($result3->num_rows > 0 ) {
                    $row3 = mysqli_fetch_assoc($result3);
                    if ($row3['follow_status'] == 'Followed') {
                      ?>
                      <a class="btn btn-outline-danger text-center border border-light my-2" onclick="blog_unfollow_blog(<?php echo $_SESSION['user']['user_id']; ?>, <?php echo $row['blog_id']; ?>)">-Unfollow</a>
                      <?php
                    }elseif($row3['follow_status'] == 'Unfollowed'){
                      ?>
                      <a class="btn btn-outline-danger text-center border border-light my-1" onclick="blog_follow_blog(<?php echo $_SESSION['user']['user_id']; ?>, <?php echo $row['blog_id']; ?>)">+Follow</a>
                      <?php
                    }
                  }else{
                    ?>
                    <a class="btn btn-outline-danger text-center border border-light my-1" onclick="blog_add_follow_blog(<?php echo $_SESSION['user']['user_id']; ?>, <?php echo $row['blog_id']; ?>)">+Follow</a>
                    <?php
                  }
              }
                }else{
                  ?>
                  <a type="button" class="btn btn-outline-danger text-center border border-light my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">+Follow</a>
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
          </div>
        </div>

        <?php
        $offset = ($page - 1) * $posts_per_page;
        $result4 = $db->show_posts_by_blog_id_paged($blog_id,$posts_per_page,$offset);
        if ($result4->num_rows>0) {
        	while ($row4 = mysqli_fetch_assoc($result4)) {
        		?>
        		<div class="row mx-0 px-0 mt-1">
		          <div class="col-md-2"></div>
		          <div class="col-md-8">
		            <div class="card mb-3 border border-warning post_background_color">
		              <img src="Post_Featured_Images/<?php echo $row4['featured_img']; ?>" class="card-img-top">
		              <div class="card-body">
		               <h5 class="card-title post_title_color post_title_font_size post_font_style post_font_weight"><?php echo $row4['post_title']; ?></h5>
		               <p class="card-text post_font_style post_font_weight"><?php echo $row4['post_summary']; ?></p>
		               <span class="text-secondary float-end post_font_style"><?php $db->date_format($row4['created_at']); ?></span>
		               <p class="card-text post_font_style post_font_weight"><a href="post-page.php?post_id=<?php echo $row4['post_id']; ?>">See this Post...</a></small></p>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-2"></div>
		        </div>
        		<?php
        	}
        }else{
          ?>
          <div class="col-md-12 text-center">
            <p class="display-5 text-warning">No Posts Available</p>
          </div>
          <?php
        }

         ?>
         <nav aria-label="Page navigation" class="text-center text-white">
                    <ul class="pagination justify-content-center">
                      <?php 
                      $result6 = $db->show_posts_by_blog_id($blog_id);
                        $totalPosts = mysqli_num_rows($result6);
                        $totalPages = ceil($totalPosts / $posts_per_page);

                        // Display Previous Button
                        if ($page > 1) {
                            echo '<li class="page-item">';
                            echo '<a class="page-link" href="this-blog.php?blog_id='.$blog_id.'&page=' . ($page - 1) . '">Previous</a>';
                            echo '</li>';
                        }

                        // Display Page Links
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '">';
                            echo '<a class="page-link" href="this-blog.php?blog_id='.$blog_id.'&page=' . $i . '">' . $i . '</a>';
                            echo '</li>';
                        }

                        // Display Next Button
                        if ($page < $totalPages) {
                            echo '<li class="page-item">';
                            echo '<a class="page-link" href="this-blog.php?blog_id='.$blog_id.'&page=' . ($page + 1) . '">Next</a>';
                            echo '</li>';
                        }
                      ?>
                    </ul>
                </nav>

      </div>

    <div class="col-md-4 border border-2 border-warning rounded mt-1 p-1">
        <div class="row mx-0 px-0">
          <div class="col-md-4"></div>
          <div class="col-md-4 bg-warning text-light text-center rounded">
            <h5>Categories</h5>
          </div>
          <div class="col-md-4"></div>
        </div>
        <?php
        $result5 = $db->show_categories_in_blog($blog_id);
        if ($result5->num_rows>0) {
        	while ($row5 = mysqli_fetch_assoc($result5)) {
        		?>
        		<div class="row mx-0 px-0 mt-1 border border-warning rounded">
		          <div class="col-md-12">
		            <a class="text-dark" style="text-decoration: none; cursor: pointer;"><strong><?php echo $row5['category_title']; ?></strong></a>
		          </div>
		        </div>
        		<?php
        	}
        }

         ?>

    </div>
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