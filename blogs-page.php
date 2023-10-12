<?php
session_start();
require_once('require/general-library.php');
require_once('require/database-library.php');
$db = new Database();
$obj = new General();
$obj->header();
$obj->navbar();
 ?>

  <div class="container-fluid" style="margin-top: 70px;">
    <div class="row mx-0 px-0">
      <div class="col-md-8 border border-2 border-warning rounded p-1">

        <div class="row mx-0 px-0 mt-1">
          <div class="col-md-4"></div>
          <div class="col-md-4 bg-warning text-light text-center rounded">
            <p class="display-6">
              Our Blogs
            </p>
          </div>
          <div class="col-md-4"></div>
        </div>
        <?php 
          $page = isset($_GET['page']) ? $_GET['page'] : 1;
          $PerPage = 4;
        ?>

        <?php
        $offset = ($page - 1) * $PerPage;
        $result2 = $db->show_active_blogs_paged($PerPage, $offset);
        if ($result2->num_rows>0) {
          while ($row2 = mysqli_fetch_assoc($result2)) {
            ?>
            <div class="row mx-0 px-0 mt-1">
              <div class="col-md-1"></div>
              <div class="col-md-10 border border-warning p-2 rounded">
              <div class="card mb-3 p-1 border border-0">
                <?php
                if (isset($_SESSION['user'])) {
                  $result5 = $db->checks_author($_SESSION['user']['user_id'],$row2['blog_id']);
                  if (!$result5->num_rows>0) {
                    // code...
                  $result3 = $db->checks_follow($_SESSION['user']['user_id'],$row2['blog_id']);
                  if ($result3->num_rows > 0 ) {
                    $row3 = mysqli_fetch_assoc($result3);
                    if ($row3['follow_status'] == 'Followed') {
                      ?>
                      <a class="btn btn-secondary float-end my-1 text-light" onclick="unfollow_blog(<?php echo $_SESSION['user']['user_id']; ?>, <?php echo $row2['blog_id']; ?>)">-Unfollow</a>
                      <?php
                    }elseif($row3['follow_status'] == 'Unfollowed'){
                      ?>
                      <a class="btn btn-warning float-end my-1 text-light" onclick="follow_blog(<?php echo $_SESSION['user']['user_id']; ?>, <?php echo $row2['blog_id']; ?>)">+Follow</a>
                      <?php
                    }
                  }else{
                    ?>
                    <a class="btn btn-warning float-end my-1 text-light" onclick="add_follow_blog(<?php echo $_SESSION['user']['user_id']; ?>, <?php echo $row2['blog_id']; ?>)">+Follow</a>
                    <?php
                  }
                  }

                }else{
                  ?>
                  <a type="button" class="btn btn-warning float-end my-1 text-light" data-bs-toggle="modal" data-bs-target="#exampleModal">+Follow</a>
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

                  <a href="this-blog.php?blog_id=<?php echo $row2['blog_id']; ?>" style="text-decoration: none;" class="text-warning">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img src="Blog_Background_Images/<?php echo $row2['blog_background_image']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title text-dark"><?php echo $row2['blog_title']; ?></h5>
                        <p class="card-text text-dark">Author of this Blog is <b><?php echo $row2['first_name']." ".$row2['last_name']; ?></b></p>
                        <span class="text-secondary"><?php $db->date_format($row2['created_at']); ?></span>
                      </div>
                    </div>
                  </div>
                  </a>
              </div>
              </div>
              <div class="col-md-1"></div>
            </div>
            <?php
          }
        }

         ?>
         <nav aria-label="Page navigation" class="text-center mt-2">
            <ul class="pagination justify-content-center">
                      <?php 
                      $result3 = $db->show_active_blogs();
                        $totalPosts = mysqli_num_rows($result3);
                        $totalPages = ceil($totalPosts / $PerPage);

                        // Display Previous Button
                        if ($page > 1) {
                            echo '<li class="page-item">';
                            echo '<a class="page-link" href="blogs-page.php?page=' . ($page - 1) . '">Previous</a>';
                            echo '</li>';
                        }

                        // Display Page Links
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '">';
                            echo '<a class="page-link" href="blogs-page.php?page=' . $i . '">' . $i . '</a>';
                            echo '</li>';
                        }

                        // Display Next Button
                        if ($page < $totalPages) {
                            echo '<li class="page-item">';
                            echo '<a class="page-link" href="blogs-page.php?page=' . ($page + 1) . '">Next</a>';
                            echo '</li>';
                        }
                      ?>
            </ul>
          </nav>
      </div>


      <div class="col-md-4 border border-2 border-warning rounded p-1">
        <div class="row mx-0 px-0 mt-1">
          <div class="col-md-3"></div>
          <div class="col-md-6 bg-warning text-center text-light rounded">
            <h5>Recent Blogs</h5>
          </div>
          <div class="col-md-3"></div>
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
      </div>
    </div>
  </div>

<?php
$obj->footer();
 ?>