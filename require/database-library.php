<?php

class Database{
	public $connection;
	public $query;
	public $result;

	public function __construct($hostname="localhost",$username="root",$password="",$database_name="20518_syed_azhar_ali_shah"){

		mysqli_report(FALSE);
		$this->connection = mysqli_connect($hostname,$username,$password,$database_name);
		if (!$this->connection) {
			echo "<h1 style='red'>Database Connection Failed</h1>";
		}
	}

	public function date_format($time){
		$timestamp = strtotime($time);

		$date = date('jS M, Y', $timestamp);
		echo $date;
	}

	public function date_time_format($time){
		$timestamp = strtotime($time);

		$date = date('jS M, Y H:i:s A', $timestamp);
		echo $date;
	}

	public function register_user($first_name,$last_name,$email,$password,$gender,$dob,$pfp,$address){
		$this->query = "INSERT INTO user (first_name,last_name,email,password,gender,date_of_birth,profile_img,home_town) VALUES('{$first_name}','{$last_name}','{$email}','{$password}','{$gender}','{$dob}','{$pfp}','{$address}')";

		$this->result = mysqli_query($this->connection, $this->query);

		return $this->result;
	}

	public function login_user($login_email,$login_password){
		$this->query = "SELECT * FROM user WHERE email = '{$login_email}' AND password = '{$login_password}'";
		$this->result = mysqli_query($this->connection, $this->query);

		return $this->result;
	}


	public function all_user_stats(){
		$this->query = "SELECT * FROM user";
		$this->result = mysqli_query($this->connection, $this->query);

		// return $this->result; 
		return mysqli_num_rows($this->result);
	}

	public function all_request_stats(){
		$this->query = "SELECT * FROM user WHERE approval = 'Pending'";
		$this->result = mysqli_query($this->connection, $this->query);

		return mysqli_num_rows($this->result);
	}

	public function all_blog_stats(){
		$this->query = "SELECT * FROM blog";
		$this->result = mysqli_query($this->connection, $this->query);

		return mysqli_num_rows($this->result);
	}

	public function all_category_stats(){
		$this->query = "SELECT * FROM category";
		$this->result = mysqli_query($this->connection, $this->query);

		return mysqli_num_rows($this->result);
	}

	public function all_post_stats(){
		$this->query = "SELECT * FROM post";
		$this->result = mysqli_query($this->connection, $this->query);

		return mysqli_num_rows($this->result);
	}

	public function all_feedback_stats(){
		$this->query = "SELECT * FROM feedback";
		$this->result = mysqli_query($this->connection, $this->query);

		return mysqli_num_rows($this->result);
	}

	public function user_by_user_id($user_id){
		$this->query = "SELECT * FROM user WHERE user_id = {$user_id}";
		$this->result = mysqli_query($this->connection, $this->query);

		return $this->result;
	}

	public function pending_user(){
		$this->query = "SELECT * FROM user WHERE approval = 'Pending' ORDER BY user_id DESC";
		$this->result = mysqli_query($this->connection, $this->query);

		return $this->result;
	}

	public function approve_user($user_id){
		$updated_at = date("Y-m-d H:i:s",time());
		$this->query = "UPDATE user SET approval = 'Approved', status = 'Active', updated_at = '{$updated_at}' WHERE user_id = {$user_id}";
		$this->result = mysqli_query($this->connection, $this->query);

		return $this->result;
	}

	public function reject_user($user_id){
		$updated_at = date("Y-m-d H:i:s",time());
		$this->query = "UPDATE user SET approval = 'Rejected', updated_at = '{$updated_at}' WHERE user_id = {$user_id}";
		$this->result = mysqli_query($this->connection, $this->query);

		return $this->result;
	}

	public function add_user($role_id,$first_name,$last_name,$email,$password,$gender,$dob,$pfp,$address,$approval,$status){
		$this->query = "INSERT INTO user (role_id,first_name,last_name,email,password,gender,date_of_birth,profile_img,home_town,approval,status) VALUES({$role_id},'{$first_name}','{$last_name}','{$email}','{$password}','{$gender}','{$dob}','{$pfp}','{$address}','{$approval}','{$status}')";

		$this->result = mysqli_query($this->connection, $this->query);

		return $this->result;

	}

	public function view_user($user_id){
		$this->query = "SELECT u.*,r.role_type FROM USER u JOIN role r ON u.role_id = r.role_id WHERE u.approval = 'Approved' AND u.user_id <> {$user_id} ORDER BY u.user_id DESC;";
		$this->result = mysqli_query($this->connection,$this->query);

		return $this->result;
	}

	public function inactive_user($user_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE user SET status = 'Inactive',updated_at = '{$updated_at}' WHERE user_id = {$user_id}";
		$this->result = mysqli_query($this->connection,$this->query);

		return $this->result;
	}

	public function active_user($user_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE user SET status = 'Active', updated_at = '{$updated_at}' WHERE user_id = {$user_id}";
		$this->result = mysqli_query($this->connection,$this->query);

		return $this->result;
	}

	public function add_blog($user_id,$blog_title,$posts_per_page,$blog_background_image,$status){
		$this->query = "INSERT INTO blog (user_id,blog_title,posts_per_page,blog_background_image,blog_status) VALUES({$user_id}, '{$blog_title}', {$posts_per_page}, '{$blog_background_image}','{$status}')";
		$this->result = mysqli_query($this->connection,$this->query);

		return $this->result;
	}

	public function view_blogs(){
		$this->query = "SELECT u.first_name,u.last_name,b.* FROM USER u JOIN blog b ON u.user_id = b.user_id ORDER BY b.blog_id DESC";
		$this->result = mysqli_query($this->connection,$this->query);

		return $this->result;
	}

	public function inactive_blog($blog_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE blog SET blog_status = 'Inactive', updated_at = '{$updated_at}' WHERE blog_id = {$blog_id}";
		$this->result = mysqli_query($this->connection,$this->query);

		return $this->result;
	}

	public function active_blog($blog_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE blog SET blog_status = 'Active', updated_at = '{$updated_at}' WHERE blog_id = {$blog_id}";
		$this->result = mysqli_query($this->connection,$this->query);

		return $this->result;
	}


	public function update_user($user_id,$role_id,$first_name,$last_name,$gender,$address,$date_of_birth,$profile_img){
		$updated_at = date('Y-m-d H:i:s', time());

		if ($profile_img == "") {
			$this->query = "UPDATE user SET role_id = {$role_id}, first_name = '{$first_name}', last_name = '{$last_name}', gender = '{$gender}',home_town = '{$address}', date_of_birth = '{$date_of_birth}', updated_at = '{$updated_at}' WHERE user_id = {$user_id}";
			$this->result = mysqli_query($this->connection, $this->query);
		}else{
			$this->query = "UPDATE user SET role_id = {$role_id}, first_name = '{$first_name}', last_name = '{$last_name}', gender = '{$gender}',home_town = '{$address}', date_of_birth = '{$date_of_birth}', updated_at = '{$updated_at}', profile_img = '{$profile_img}' WHERE user_id = {$user_id}";
			$this->result = mysqli_query($this->connection, $this->query);
		}

		return $this->result;

	}

	public function roles(){
		$this->query = "SELECT * FROM role WHERE status = 'Active'";
		$this->result = mysqli_query($this->connection, $this->query);

		return $this->result;
	}


	public function blog_by_blog_id($blog_id){
		$this->query = "SELECT u.first_name,u.last_name,b.* FROM user u JOIN blog b ON u.user_id = b.user_id WHERE b.blog_id = {$blog_id}";
		$this->result = mysqli_query($this->connection,$this->query);

		return $this->result;
	}

	public function update_blog($blog_id,$blog_title,$posts_per_page,$blog_background_image){
		$updated_at = date('Y-m-d H:i:s', time());
		if ($blog_background_image == "") {
			$this->query = "UPDATE blog SET blog_title = '{$blog_title}', posts_per_page = '{$posts_per_page}', updated_at = '{$updated_at}' WHERE blog_id = '{$blog_id}'";
			$this->result = mysqli_query($this->connection, $this->query);
		}else{
			$this->query = "UPDATE blog SET blog_title = '{$blog_title}', posts_per_page = '{$posts_per_page}', updated_at = '{$updated_at}', blog_background_image = '{$blog_background_image}' WHERE blog_id = '{$blog_id}'";
			$this->result = mysqli_query($this->connection, $this->query);
		}

		return $this->result;
	}


	public function add_category($category_title,$category_description,$status){
		$category_description = htmlspecialchars($category_description);
		$this->query = "INSERT INTO category (category_title, category_description, status) VALUES('{$category_title}', '{$category_description}', '{$status}')";

		$this->result = mysqli_query($this->connection, $this->query);

		return $this->result;
	}

	public function view_categories(){
		$this->query = "SELECT * FROM category ORDER BY category_id DESC";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function inactive_category($category_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE category SET status = 'Inactive', updated_at = '{$updated_at}' WHERE category_id = {$category_id}";
		$this->result = mysqli_query($this->connection, $this->query);

		return $this->result;
	}

	public function active_category($category_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE category SET status = 'Active', updated_at = '{$updated_at}' WHERE category_id = {$category_id}";
		$this->result = mysqli_query($this->connection, $this->query);

		return $this->result;
	}


	public function category_by_category_id($category_id){
		$this->query = "SELECT * FROM category WHERE category_id = {$category_id}";
		$this->result = mysqli_query($this->connection,$this->query);

		return $this->result;
	}

	public function update_category($category_title,$category_description,$category_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$category_description = htmlspecialchars($category_description);
		$this->query = "UPDATE category SET category_title = '{$category_title}', category_description = '{$category_description}', updated_at = '{$updated_at}' WHERE category_id = {$category_id}";
		$this->result = mysqli_query($this->connection,$this->query);

		return $this->result;
	}

	public function rejected_users(){
		$this->query = "SELECT * FROM user WHERE approval = 'Rejected'";
		$this->result = mysqli_query($this->connection, $this->query);

		return $this->result;
	}

	public function update_profile($user_id,$first_name,$last_name,$email,$password,$gender,$address,$date_of_birth,$profile_img){
		$updated_at = date('Y-m-d H:i:s', time());

		if ($profile_img == "") {
			$this->query = "UPDATE user SET first_name = '{$first_name}', last_name = '{$last_name}', email = '{$email}', password = '{$password}', gender = '{$gender}',home_town = '{$address}', date_of_birth = '{$date_of_birth}', updated_at = '{$updated_at}' WHERE user_id = {$user_id}";
			$this->result = mysqli_query($this->connection, $this->query);
		}else{
			$this->query = "UPDATE user SET first_name = '{$first_name}', last_name = '{$last_name}', email = '{$email}', password = '{$password}', gender = '{$gender}',home_town = '{$address}', date_of_birth = '{$date_of_birth}', updated_at = '{$updated_at}', profile_img = '{$profile_img}' WHERE user_id = {$user_id}";
			$this->result = mysqli_query($this->connection, $this->query);
		}

		return $this->result;
	}

	public function active_blog_by_user_id($user_id){
		$this->query = "SELECT * FROM blog WHERE blog_status = 'Active' AND user_id = {$user_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function all_active_categories(){
		$this->query = "SELECT * FROM category WHERE status = 'Active'";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function add_post($blog_id,$post_title,$post_summary,$post_description,$is_comment_allowed,$status,$featured_img){
		$post_description = htmlspecialchars($post_description);
		$this->query = "INSERT INTO post (blog_id,post_title,post_summary,post_description,is_comment_allowed,status,featured_img) VALUES({$blog_id},'{$post_title}','{$post_summary}','{$post_description}','{$is_comment_allowed}','{$status}','{$featured_img}')";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function add_post_category($post_id,$category_id){
		$this->query = "INSERT INTO post_category(post_id,category_id) VALUES({$post_id},{$category_id})";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function add_post_attachment($post_id,$attachment_title,$attachment_path){
		$this->query = "INSERT INTO post_attachment(post_id,attachment_title,attachment_path) VALUES({$post_id},'{$attachment_title}','{$attachment_path}')";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function post_mail($blog_id){
		$this->query = "SELECT * FROM user u JOIN following_blog f ON u.user_id = f.follower_id JOIN blog b ON f.blog_following_id = b.blog_id WHERE f.follow_status = 'Followed' AND f.blog_following_id = {$blog_id}";
		$this->result = mysqli_query($this->connection,$this->query);

		return $this->result;
	}

	public function view_posts($user_id){
		$this->query = "SELECT p.*, b.* FROM post p JOIN blog b ON p.blog_id = b.blog_id JOIN USER u ON b.user_id = u.user_id WHERE u.user_id = {$user_id} ORDER BY p.post_id DESC;";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function inactive_post($post_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE post SET status = 'Inactive', updated_at = '{$updated_at}' WHERE post_id = {$post_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function active_post($post_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE post SET status = 'Active', updated_at = '{$updated_at}' WHERE post_id = {$post_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function post_by_post_id($post_id){
		$this->query = "SELECT * FROM post WHERE post_id = {$post_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function update_post($post_id,$blog_id,$post_title,$post_summary,$post_description,$is_comment_allowed,$featured_img){
		$updated_at = date('Y-m-d H:i:s', time());
		$post_description = htmlspecialchars($post_description);

		if ($featured_img == "") {
			$this->query = "UPDATE post SET blog_id = {$blog_id}, post_title = '{$post_title}', post_summary = '{$post_summary}', post_description = '{$post_description}',is_comment_allowed = '{$is_comment_allowed}', updated_at = '{$updated_at}' WHERE post_id = {$post_id}";
			$this->result = mysqli_query($this->connection, $this->query);
		}else{
			$this->query = "UPDATE post SET blog_id = {$blog_id}, post_title = '{$post_title}', post_summary = '{$post_summary}', post_description = '{$post_description}',is_comment_allowed = '{$is_comment_allowed}', updated_at = '{$updated_at}', featured_img = '{$featured_img}' WHERE post_id = {$post_id}";
			$this->result = mysqli_query($this->connection, $this->query);
		}

		return $this->result;

	}


	public function given_categories($post_id){
		$this->query = "SELECT pc.*, c.category_title FROM category c JOIN post_category pc ON c.category_id = pc.category_id WHERE pc.post_id = {$post_id}";
		$this->result = mysqli_query($this->connection,$this->query);

		return $this->result;
	}

	public function inactive_given_category($category_post_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE post_category SET status = 'Inactive', updated_at = '{$updated_at}' WHERE category_post_id = {$category_post_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function active_given_category($category_post_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE post_category SET status = 'Active', updated_at = '{$updated_at}' WHERE category_post_id = {$category_post_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function all_not_selected_categories($post_id){
		$this->query = "SELECT * FROM category u WHERE u.status = 'Active' AND u.category_id NOT IN(SELECT category_id FROM post_category WHERE post_id = {$post_id})";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function given_attachments($post_id){
		$this->query = "SELECT p.post_title, pt.* FROM post_attachment pt JOIN post p ON p.post_id = pt.post_id WHERE pt.post_id = {$post_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function inactive_given_attachment($post_attachment_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE post_attachment SET status = 'Inactive', updated_at = '{$updated_at}' WHERE post_attachment_id = {$post_attachment_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function active_given_attachment($post_attachment_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE post_attachment SET status = 'Active', updated_at = '{$updated_at}' WHERE post_attachment_id = {$post_attachment_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function given_comments($post_id){
		$this->query = "SELECT u.first_name, u.last_name, pc.* FROM post_comment pc JOIN USER u ON pc.user_id = u.user_id WHERE pc.post_id = {$post_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function active_given_comment($comment_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE post_comment SET status = 'Active', updated_at = '{$updated_at}' WHERE comment_id = {$comment_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function inactive_given_comment($comment_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE post_comment SET status = 'Inactive', updated_at = '{$updated_at}' WHERE comment_id = {$comment_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function all_feedbacks(){
		$this->query = "SELECT * FROM feedback ORDER BY feedback_id DESC";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function visitors_feedback(){
		$this->query = "SELECT * FROM feedback WHERE user_id IS NULL ORDER BY feedback_id DESC";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function users_feedback(){
		$this->query = "SELECT * FROM feedback WHERE user_id IS NOT NULL ORDER BY feedback_id DESC";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function show_all_active_blog_5(){
		$this->query = "SELECT * FROM blog WHERE blog_status = 'Active' ORDER BY blog_id DESC LIMIT 5";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function show_all_active_post_5(){
		$this->query = "SELECT * FROM post WHERE STATUS = 'Active' ORDER BY post_id DESC LIMIT 5";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	//Checks Email Start
	public function checks_email($email){
		$this->query = "SELECT * FROM user WHERE email = '{$email}'";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}
	//Checks Email End
	//Change Password Start
	public function change_password($email,$password){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE user SET password = '{$password}',updated_at = '{$updated_at}' WHERE email = '{$email}'";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}
	//Change Password End

	public function show_active_posts(){
		$this->query = "SELECT * FROM post WHERE status = 'Active' ORDER BY post_id DESC";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function search_active_posts($search){
		$this->query = "SELECT * FROM post WHERE status = 'Active' AND (post_title LIKE '%{$search}%' OR post_summary LIKE '%{$search}%') ORDER BY post_id DESC";
		$this->result = mysqli_query($this->connection, $this->query);
		return $this->result;
	}

	public function add_feedback($name,$email,$feedback,$user_id){
		$feedback = htmlspecialchars($feedback);
		if ($user_id == "") {
			$this->query = "INSERT INTO feedback(name,email,feedback) VALUES('{$name}','{$email}', '{$feedback}')";
			$this->result = mysqli_query($this->connection,$this->query);
			return $this->result;
		}else{
			$this->query = "INSERT INTO feedback(user_id,name,email,feedback) VALUES({$user_id},'{$name}','{$email}', '{$feedback}')";
			$this->result = mysqli_query($this->connection,$this->query);
			return $this->result;
		}
	}

	public function all_active_admins(){
		$this->query = "SELECT r.role_type, u.* FROM role r JOIN USER u ON r.role_id = u.role_id WHERE r.role_type = 'Admin' AND u.status = 'Active'";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function checks_follow($user_id,$blog_id){
		$this->query = "SELECT * FROM following_blog WHERE follower_id = {$user_id} AND blog_following_id = {$blog_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function show_active_blogs(){
		$this->query = "SELECT u.first_name, u.last_name, b.* FROM blog b JOIN user u ON u.user_id = b.user_id WHERE b.blog_status = 'Active' ORDER BY b.blog_id DESC";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function show_active_blogs_paged($blogsPerPage, $offset){
		$this->query = "SELECT u.first_name, u.last_name, b.* FROM blog b JOIN user u ON u.user_id = b.user_id WHERE b.blog_status = 'Active' ORDER BY b.blog_id DESC LIMIT {$offset}, {$blogsPerPage}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function unfollow_blog($follower_id,$blog_following_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE following_blog SET follow_status = 'Unfollowed',updated_at = '{$updated_at}' WHERE follower_id = {$follower_id} AND blog_following_id = {$blog_following_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->query;
	}

	public function follow_blog($follower_id,$blog_following_id){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE following_blog SET follow_status = 'Followed',updated_at = '{$updated_at}' WHERE follower_id = {$follower_id} AND blog_following_id = {$blog_following_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->query;
	}

	public function add_follow_blog($follower_id,$blog_following_id){
		$this->query = "INSERT INTO following_blog (follower_id,blog_following_id,follow_status) VALUES({$follower_id},{$blog_following_id}, 'Followed')";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function follower_fullname($follower_id,$blog_following_id){
		$this->query = "SELECT u.first_name, u.last_name FROM user u JOIN following_blog fb ON u.user_id = fb.follower_id WHERE fb.follower_id = {$follower_id} AND fb.blog_following_id = {$blog_following_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function blog_author_email($follower_id,$blog_following_id){
		$this->query = "SELECT u.email,b.blog_title FROM user u JOIN blog b ON u.user_id = b.user_id JOIN following_blog fb ON b.blog_id = fb.blog_following_id WHERE fb.follower_id = {$follower_id} AND fb.blog_following_id = {$blog_following_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function show_posts_by_blog_id($blog_id){
		$this->query = "SELECT * FROM post WHERE status = 'Active' AND blog_id = {$blog_id} ORDER BY post_id DESC";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function show_posts_by_blog_id_paged($blog_id,$posts_per_page,$offset){
		$this->query = "SELECT * FROM post WHERE status = 'Active' AND blog_id = {$blog_id} ORDER BY post_id DESC LIMIT {$offset}, {$posts_per_page}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}


	public function show_categories_in_blog($blog_id){
		$this->query = "SELECT DISTINCT c.category_title FROM blog b JOIN post p ON b.blog_id = p.blog_id JOIN post_category pc ON p.post_id = pc.post_id JOIN category c ON pc.category_id = c.category_id WHERE pc.status = 'Active' AND b.blog_id = {$blog_id}";
		$this->result = mysqli_query($this->connection, $this->query);
		return $this->result;
	}

	public function show_post_by_post_id($post_id){
		$this->query = "SELECT p.*, b.blog_title FROM post p JOIN blog b ON p.blog_id = b.blog_id WHERE p.post_id = {$post_id}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function post_attachment_by_post_id($post_id){
		$this->query = "SELECT * FROM post_attachment WHERE status = 'Active' AND post_id = {$post_id}";
		$this->result = mysqli_query($this->connection, $this->query);
		return $this->result;
	}

	public function show_post_comment_by_post_id($post_id){
		$this->query = "SELECT pc.*, u.first_name, u.last_name, u.profile_img FROM post_comment pc JOIN USER u ON pc.user_id = u.user_id WHERE pc.post_id = {$post_id} AND pc.status = 'Active'";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function add_comment($user_id,$post_id,$given_comment){
		$given_comment = htmlspecialchars($given_comment);
		$this->query = "INSERT INTO post_comment (user_id,post_id,comment) VALUES({$user_id},{$post_id},'{$given_comment}')";
		$this->result = mysqli_query($this->connection, $this->query);
		return $this->result;
	}


	public function checks_author($user_id,$blog_id){
		$this->query = "SELECT * FROM USER u JOIN blog b ON u.user_id = b.user_id WHERE b.blog_id = {$blog_id} AND u.user_id = {$user_id}";
		$this->result = mysqli_query($this->connection, $this->query);
		return $this->result;
	}

	public function show_active_posts_paged($postsPerPage, $offset){
		$this->query = "SELECT * FROM post WHERE status = 'Active' ORDER BY post_id DESC LIMIT {$offset}, {$postsPerPage}";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function insert_theme_setting($user_id,$key,$value){
		$this->query = "INSERT INTO theme_setting(user_id,setting_key,setting_value) VALUES({$user_id},'{$key}','{$value}')";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function update_theme_setting($user_id,$key,$value){
		$updated_at = date('Y-m-d H:i:s', time());
		$this->query = "UPDATE theme_setting SET setting_value = '{$value}', updated_at = '{$updated_at}' WHERE user_id = {$user_id} AND setting_key = '{$key}'";
		$this->result = mysqli_query($this->connection,$this->query);
		return $this->result;
	}

	public function select_theme_setting($user_id){
		$this->query = "SELECT * FROM theme_setting WHERE user_id = {$user_id}";
		$this->result = mysqli_query($this->connection, $this->query);
		return $this->result;
	}

	public function check_theme_setting($user_id){
		$this->result = $this->select_theme_setting($user_id);
		if (mysqli_num_rows($this->result) == 5) {
			return true;
		}else{
			return false;
		}
	}


}

 ?>