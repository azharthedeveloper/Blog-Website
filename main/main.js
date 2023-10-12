function validate_register(){
	var flag = true;

		var alpha_pattern = /^[A-Za-z]+( [A-Za-z]+){0,2}$/;
		var email_pattern = /^[a-z]{3,50}\d{1,10}[@]{1}[a-z]{3,10}[.]{1}[a-z]{3,6}$/;
		var password_pattern =  /^(.{8,})$/;
		var dob_pattern = /^\d{4}-\d{2}-\d{2}$/;

		var first_name = document.querySelector('#first_name').value;
		var last_name = document.querySelector('#last_name').value;
		var email = document.querySelector('#email').value;
		var password = document.querySelector('#password').value;
		var address = document.querySelector('#address').value;
		var dob = document.querySelector('#date_of_birth').value;
		var pfp = document.querySelector('#profile_image').value;
		var gender_elem = document.querySelectorAll('.gender');
			var gender = null;
			if(gender_elem[0].checked){
				gender = "ok";
			}else if(gender_elem[1].checked){
				gender = "ok";
			}

		if (first_name == "") {
				flag = false;
				document.querySelector('#first_name_msg').innerHTML = 'First Name is Required';
			}else{
				document.querySelector('#first_name_msg').innerHTML = '';
				if (alpha_pattern.test(first_name) == false) {
					flag = false;
					document.querySelector('#first_name_msg').innerHTML = 'First Name should be like e.g. Ali, Awais';
				}

			}

		if (last_name == "") {
				flag = false;
				document.querySelector('#last_name_msg').innerHTML = 'Last Name is Required';
			}else{
				document.querySelector('#last_name_msg').innerHTML = '';
				if (alpha_pattern.test(last_name) == false) {
					flag = false;
					document.querySelector('#last_name_msg').innerHTML = 'Last Name should be like e.g. Khan, Soomro';
				}
			}

		if (email == "") {
				flag = false;
				document.querySelector('#email_msg').innerHTML = 'Email is Required';
			}else{
				document.querySelector('#email_msg').innerHTML = '';
				if (email_pattern.test(email) == false) {
					flag = false;
					document.querySelector('#email_msg').innerHTML = 'Email should be like e.g. example12@gmail.com';
				}
			}

		if (password == "") {
				flag = false;
				document.querySelector('#password_msg').innerHTML = 'Password is Required';
			}else{
				document.querySelector('#password_msg').innerHTML = '';
				if (password_pattern.test(password) == false) {
					flag = false;
					document.querySelector('#password_msg').innerHTML = 'Password Should be atleast 8 characters';
				}
			}

		if(address == ""){
				flag = false;
				document.querySelector('#address_msg').innerHTML = "Please, Enter your Address";
			}else{
				document.querySelector('#address_msg').innerHTML = "";
			}

		if(!gender){
				flag = false;
				document.querySelector('#gender_msg').innerHTML = 'Please, Select a Gender';
			}else{
				document.querySelector('#gender_msg').innerHTML = '';
			}

		if (dob == "") {
				flag = false;
				document.querySelector('#dob_msg').innerHTML = 'Date of Birth is Required';
			}else{
				document.querySelector('#dob_msg').innerHTML = '';
				if (dob_pattern.test(dob) == false) {
					flag = false;
					document.querySelector('#dob_msg').innerHTML = 'Date of Birth Should be Like YYYY-MM-DD e.g. 1992-11-18';
				}
			}

		if(pfp == ""){
				flag = false;
				document.querySelector('#pfp_msg').innerHTML = "Please, Select a Profile Image";
			}else{
				document.querySelector('#pfp_msg').innerHTML = "";
			}

		if (flag) {
				return true;
			}else{
				return false;
			}
}


function user_request(){
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}
	obj.onreadystatechange = function (){
		if (obj.readyState == 4 && obj.status == 200) {
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
			$(document).ready( function () {
            	$('#example').DataTable();
        	} );

		}
	}
	obj.open('GET','admin-process.php?action=user_request');
	obj.send();
}

function add_user_form(){
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
		}
	}

	obj.open('GET', 'admin-process.php?action=add_user_form');
	obj.send();
}

function view_users(){
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
			$(document).ready( function () {
            	$('#example').DataTable();
        	} );
		}
	}

	obj.open('GET', 'admin-process.php?action=view_users');
	obj.send();
}

function add_blog_form(){
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
		}
	}

	obj.open('GET','admin-process.php?action=add_blog_form');
	obj.send();
}


function view_blogs(){
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
			$(document).ready( function () {
            	$('#example').DataTable();
        	} );
		}
	}

	obj.open('GET', 'admin-process.php?action=view_blogs');
	obj.send();
}


function add_category_form(){
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
		}
	}

	obj.open('GET','admin-process.php?action=add_category_form');
	obj.send();
}

function view_categories(){
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
			$(document).ready( function () {
            	$('#example').DataTable();
        	} );
		}
	}

	obj.open('GET','admin-process.php?action=view_categories');
	obj.send();
}

function add_post_form(){
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
			$(document).ready(function () {
            $('.js-example-basic-multiple').select2({
                placeholder: 'Select multiple options',
                allowClear: true,
                closeOnSelect: true // Allow multiple selections to stay open
            	});
        	});
		}
	}

	obj.open('GET','admin-process.php?action=add_post_form');
	obj.send();
}

function view_posts(){
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
			$(document).ready( function () {
            	$('#example').DataTable();
        	} );
		}
	}

	obj.open('GET', 'admin-process.php?action=view_posts');
	obj.send();
}

function approve(user_id){
	var obj;
	show_loader();

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}


	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			if (obj.response.trim() !== "") {
				document.getElementById('user_msg').innerHTML = obj.responseText;
				hide_loader();
				setTimeout(user_request, 2000);
			}
		}
	}

	obj.open('GET', 'admin-process.php?action=approve&user_id='+user_id);
	obj.send();
}

function reject(user_id){
	var obj;
	show_loader();

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}


	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			if (obj.response.trim() !== "") {
				document.getElementById('user_msg').innerHTML = obj.responseText;
				hide_loader();
				setTimeout(user_request, 2000);
			}
		}
	}

	obj.open('GET', 'admin-process.php?action=reject&user_id='+user_id);
	obj.send();
}


function add_user(){

	var flag = true;


    	var alpha_pattern = /^[A-Za-z]+( [A-Za-z]+){0,2}$/;
		var email_pattern = /^[a-z]{3,50}\d{1,10}[@]{1}[a-z]{3,10}[.]{1}[a-z]{3,6}$/;
		var password_pattern =  /^(.{8,})$/;
		var dob_pattern = /^\d{4}-\d{2}-\d{2}$/;

		var first_name = document.querySelector('#first_name').value;
		var last_name = document.querySelector('#last_name').value;
		var email = document.querySelector('#email').value;
		var password = document.querySelector('#password').value;
		var address = document.querySelector('#address').value;
		var dob = document.querySelector('#date_of_birth').value;
		var pfp = document.querySelector('#profile_image').value;
		var gender_elem = document.querySelectorAll('.gender');
			var gender = null;
			if(gender_elem[0].checked){
				gender = "ok";
			}else if(gender_elem[1].checked){
				gender = "ok";
			}

		if (first_name == "") {
				flag = false;
				document.querySelector('#first_name_msg').innerHTML = 'First Name is Required';
			}else{
				document.querySelector('#first_name_msg').innerHTML = '';
				if (alpha_pattern.test(first_name) == false) {
					flag = false;
					document.querySelector('#first_name_msg').innerHTML = 'First Name should be like e.g. Ali, Awais';
				}

			}

		if (last_name == "") {
				flag = false;
				document.querySelector('#last_name_msg').innerHTML = 'Last Name is Required';
			}else{
				document.querySelector('#last_name_msg').innerHTML = '';
				if (alpha_pattern.test(last_name) == false) {
					flag = false;
					document.querySelector('#last_name_msg').innerHTML = 'Last Name should be like e.g. Khan, Soomro';
				}
			}

		if (email == "") {
				flag = false;
				document.querySelector('#email_msg').innerHTML = 'Email is Required';
			}else{
				document.querySelector('#email_msg').innerHTML = '';
				if (email_pattern.test(email) == false) {
					flag = false;
					document.querySelector('#email_msg').innerHTML = 'Email should be like e.g. example12@gmail.com';
				}
			}

		if (password == "") {
				flag = false;
				document.querySelector('#password_msg').innerHTML = 'Password is Required';
			}else{
				document.querySelector('#password_msg').innerHTML = '';
				if (password_pattern.test(password) == false) {
					flag = false;
					document.querySelector('#password_msg').innerHTML = 'Password Should be atleast 8 characters';
				}
			}

		if(address == ""){
				flag = false;
				document.querySelector('#address_msg').innerHTML = "Please, Enter your Address";
			}else{
				document.querySelector('#address_msg').innerHTML = "";
			}

		if(!gender){
				flag = false;
				document.querySelector('#gender_msg').innerHTML = 'Please, Select a Gender';
			}else{
				document.querySelector('#gender_msg').innerHTML = '';
			}

		if (dob == "") {
				flag = false;
				document.querySelector('#dob_msg').innerHTML = 'Date of Birth is Required';
			}else{
				document.querySelector('#dob_msg').innerHTML = '';
				if (dob_pattern.test(dob) == false) {
					flag = false;
					document.querySelector('#dob_msg').innerHTML = 'Date of Birth Should be Like YYYY-MM-DD e.g. 1992-11-18';
				}
			}

		if(pfp == ""){
				flag = false;
				document.querySelector('#pfp_msg').innerHTML = "Please, Select a Profile Image";
			}else{
				document.querySelector('#pfp_msg').innerHTML = "";
			}

	

	if (flag) {

		var form = document.querySelector('#userForm');
    	var formData = new FormData(form);

		var obj;

		show_loader();

		if (window.ActiveXObject) {
			obj = new ActiveXObject('Microsoft.XMLHTTP');
		}else{
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function(){
			if (obj.readyState == 4 && obj.status == 200) {
				// console.log(obj.responseText);
				document.getElementById('add_user_msg').innerHTML = obj.responseText;
				hide_loader();
				setTimeout(add_user_form, 2000);
			}
		}

		obj.open("POST", "admin-process.php?action=add_user", true);
		obj.send(formData);
	}


}

function inactive_user(user_id){
	// console.log(user_id);

	var obj;

	show_loader();

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_user_msg').innerHTML = obj.responseText;
			hide_loader();
			setTimeout(view_users, 2000);
		}
	}

	obj.open('GET','admin-process.php?action=inactive_user&user_id='+user_id);
	obj.send();
}

function active_user(user_id){
	// console.log(user_id);

	var obj;
	show_loader();

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_user_msg').innerHTML = obj.responseText;
			hide_loader();
			setTimeout(view_users, 2000);
		}
	}

	obj.open('GET','admin-process.php?action=active_user&user_id='+user_id);
	obj.send();
}

function addBlog(){
	var flag = true;

	var blog_title = document.getElementById('blog_title').value;
	var post_per_page = document.getElementById('post_per_page').value;
	var blog_bg_img = document.getElementById('blog_background_image').value;

	if (blog_title == "") {
		flag = false;
		document.getElementById('blog_title_msg').innerHTML = 'Please Write Blog Title';
	}else{
		document.getElementById('blog_title_msg').innerHTML = '';
	}

	if (post_per_page == "") {
		flag = false;
		document.getElementById('post_per_page_msg').innerHTML = "Post Per Page is Required";
	}else{
		document.getElementById('post_per_page_msg').innerHTML = "";
	}

	if (blog_bg_img == "") {
		flag = false;
		document.getElementById('blog_background_image_msg').innerHTML = "Please Select an Image";
	}else{
		document.getElementById('blog_background_image_msg').innerHTML = "";
	}

	if (flag) {
		var form = document.querySelector('#blogForm');
    	var formData = new FormData(form);

		var obj;

		if (window.ActiveXObject) {
			obj = new ActiveXObject('Microsoft.XMLHTTP');
		}else{
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function(){
			if (obj.readyState == 4 && obj.status == 200) {
				// console.log(obj.responseText);
				document.getElementById('add_blog_msg').innerHTML = obj.responseText;

				setTimeout(add_blog_form, 2000);
			}
		}

		obj.open("POST", "admin-process.php?action=add_blog", true);
		obj.send(formData);
	}
}


function inactive_blog(blog_id){
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_blog_msg').innerHTML = obj.responseText;

			setTimeout(view_blogs,2000)
		}
	}

	obj.open('GET', 'admin-process.php?action=inactive_blog&blog_id='+blog_id);
	obj.send();
}


function active_blog(blog_id){
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_blog_msg').innerHTML = obj.responseText;

			setTimeout(view_blogs,2000)
		}
	}

	obj.open('GET', 'admin-process.php?action=active_blog&blog_id='+blog_id);
	obj.send();
}

function edit_user(user_id){
	// console.log(user_id);

	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function (){
		if (obj.readyState == 4 && obj.status == 200) {

			// console.log(obj.responseText);

			document.getElementById('dashboard_response').innerHTML = obj.responseText;
		}
	}

	obj.open('GET', 'admin-process.php?action=edit_user&user_id='+user_id);
	obj.send();
}


function update_user(user_id){
	// console.log(user_id);

	var flag = true;

	var first_name = document.querySelector('#first_name').value;
		var last_name = document.querySelector('#last_name').value;
		var email = document.querySelector('#email').value;
		var password = document.querySelector('#password').value;
		var address = document.querySelector('#address').value;
		var dob = document.querySelector('#date_of_birth').value;
		var pfp = document.querySelector('#profile_image').value;
		var gender_elem = document.querySelectorAll('.gender');
			var gender = null;
			if(gender_elem[0].checked){
				gender = "ok";
			}else if(gender_elem[1].checked){
				gender = "ok";
			}

		if (first_name == "") {
				flag = false;
				document.querySelector('#first_name_msg').innerHTML = 'First Name is Required';
			}else{
				document.querySelector('#first_name_msg').innerHTML = '';
			}

		if (last_name == "") {
				flag = false;
				document.querySelector('#last_name_msg').innerHTML = 'Last Name is Required';
			}else{
				document.querySelector('#last_name_msg').innerHTML = '';
			}

		if (email == "") {
				flag = false;
				document.querySelector('#email_msg').innerHTML = 'Email is Required';
			}else{
				document.querySelector('#email_msg').innerHTML = '';
			}

		if (password == "") {
				flag = false;
				document.querySelector('#password_msg').innerHTML = 'Password is Required';
			}else{
				document.querySelector('#password_msg').innerHTML = '';
			}

		if(address == ""){
				flag = false;
				document.querySelector('#address_msg').innerHTML = "Please, Enter your Address";
			}else{
				document.querySelector('#address_msg').innerHTML = "";
			}

		if(!gender){
				flag = false;
				document.querySelector('#gender_msg').innerHTML = 'Please, Select a Gender';
			}else{
				document.querySelector('#gender_msg').innerHTML = '';
			}

		if (dob == "") {
				flag = false;
				document.querySelector('#dob_msg').innerHTML = 'Date of Birth is Required';
			}else{
				document.querySelector('#dob_msg').innerHTML = '';
			}

		// if(pfp == ""){
		// 		flag = false;
		// 		document.querySelector('#pfp_msg').innerHTML = "Please, Select a Profile Image";
		// 	}else{
		// 		document.querySelector('#pfp_msg').innerHTML = "";
		// 	}

		if (flag) {

		var form = document.querySelector('#updateUserForm');
    	var formData = new FormData(form);

		var obj;

		if (window.ActiveXObject) {
			obj = new ActiveXObject('Microsoft.XMLHTTP');
		}else{
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function(){
			if (obj.readyState == 4 && obj.status == 200) {
				// console.log(obj.responseText);
				document.getElementById('update_user_msg').innerHTML = obj.responseText;

				setTimeout(function(){
					edit_user(user_id);
				}, 2000);
			}
		}

		obj.open("POST", "admin-process.php?action=update_user&user_id="+user_id, true);
		obj.send(formData);

		}


}

function edit_blog(blog_id){

	// console.log(blog_id);

	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
		}
	}

	obj.open('GET', 'admin-process.php?action=edit_blog&blog_id='+blog_id);
	obj.send();
}


function updateBlog(blog_id){
	var flag = true;

	var blog_title = document.getElementById('blog_title').value;
	var post_per_page = document.getElementById('post_per_page').value;
	var blog_bg_img = document.getElementById('blog_background_image').value;

	if (blog_title == "") {
		flag = false;
		document.getElementById('blog_title_msg').innerHTML = 'Please Write Blog Title';
	}else{
		document.getElementById('blog_title_msg').innerHTML = '';
	}

	if (post_per_page == "") {
		flag = false;
		document.getElementById('post_per_page_msg').innerHTML = "Post Per Page is Required";
	}else{
		document.getElementById('post_per_page_msg').innerHTML = "";
	}

	// if (blog_bg_img == "") {
	// 	flag = false;
	// 	document.getElementById('blog_background_image_msg').innerHTML = "Please Select an Image";
	// }else{
	// 	document.getElementById('blog_background_image_msg').innerHTML = "";
	// }

	if (flag) {
		var form = document.querySelector('#updateBlogForm');
    	var formData = new FormData(form);

		var obj;

		if (window.ActiveXObject) {
			obj = new ActiveXObject('Microsoft.XMLHTTP');
		}else{
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function(){
			if (obj.readyState == 4 && obj.status == 200) {
				console.log(obj.responseText);
				document.getElementById('update_blog_msg').innerHTML = obj.responseText;

				setTimeout(function(){
					edit_blog(blog_id);
				}, 2000);
			}
		}

		obj.open("POST", "admin-process.php?action=update_blog&blog_id="+blog_id, true);
		obj.send(formData);
	}


}

function addCategory(){

	var flag = true;

	var category_title = document.getElementById('category_title').value;
	var category_description = document.getElementById('category_description').value;
	var status = document.querySelector('input[name="status"]:checked').value;

	if (category_title == "") {
		flag = false;
		document.getElementById('category_title_msg').innerHTML = "Please Write Category Title";
	}else{
		document.getElementById('category_title_msg').innerHTML = "";
	}

	if (category_description == "") {
		flag = false;
		document.getElementById('category_description_msg').innerHTML = "Please Write Category Description";
	}else{
		document.getElementById('category_description_msg').innerHTML = "";
	}

	if (flag) {
		var obj;

		if (window.ActiveXObject) {
			obj = new ActiveXObject('Microsoft.XMLHTTP');
		}else{
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function(){
			if (obj.readyState == 4 && obj.status == 200) {
				// console.log(obj.responseText);
				document.getElementById('add_category_form_msg').innerHTML = obj.responseText;
				setTimeout(add_category_form, 2000);
			}
		}

		obj.open('GET', 'admin-process.php?action=add_category&category_title='+category_title+"&category_description="+category_description+"&status="+status);
		obj.send();
	}
}


function inactive_category(category_id){
	// console.log(category_id);

	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_categories_msg').innerHTML = obj.responseText;
			setTimeout(view_categories,2000);
		}
	}

	obj.open('GET', 'admin-process.php?action=inactive_category&category_id='+category_id);
	obj.send();
}


function active_category(category_id){
	// console.log(category_id);

	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_categories_msg').innerHTML = obj.responseText;
			setTimeout(view_categories,2000);
		}
	}

	obj.open('GET', 'admin-process.php?action=active_category&category_id='+category_id);
	obj.send();
}

function edit_category(category_id){
	// console.log(category_id);

	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
		}
	}

	obj.open('GET', 'admin-process.php?action=edit_category&category_id='+category_id);
	obj.send();
}

function updateCategory(category_id){
	// console.log(category_id);

	var flag = true;

	var category_title = document.getElementById('category_title').value;
	var category_description = document.getElementById('category_description').value;

	if (category_title == "") {
		flag = false;
		document.getElementById('category_title_msg').innerHTML = "Please Write Category Title";
	}else{
		document.getElementById('category_title_msg').innerHTML = "";
	}

	if (category_description == "") {
		flag = false;
		document.getElementById('category_description_msg').innerHTML = "Please Write Category Description";
	}else{
		document.getElementById('category_description_msg').innerHTML = "";
	}


	if (flag) {
		var obj;

		if (window.ActiveXObject) {
			obj = new ActiveXObject('Microsoft.XMLHTTP');
		}else{
			obj = new XMLHttpRequest();
		}


		obj.onreadystatechange = function(){
			if (obj.readyState == 4 && obj.status == 200) {
				// console.log(obj.responseText);
				document.getElementById('edit_category_form_msg').innerHTML = obj.responseText;
				setTimeout(function(){
					edit_category(category_id);
				}, 2000);
			}
		}

		obj.open('GET', 'admin-process.php?action=update_category&category_id='+category_id+"&category_title="+category_title+"&category_description="+category_description);
		obj.send();
	}
}


function rejected_users(){
	// console.log('Working');

	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
			$(document).ready( function () {
            	$('#example').DataTable();
        	} );
		}
	}

	obj.open('GET', 'admin-process.php?action=rejected_users');
	obj.send();
}

function show_loader(){
	document.getElementById('loader').style.display = 'block';
}
function hide_loader(){
	document.getElementById('loader').style.display = 'none';
}


function user_info(user_id){
	// console.log(user_id);
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
		}
	}

	obj.open('GET', 'admin-process.php?action=user_info&user_id='+user_id);
	obj.send();
}

function blog_info(blog_id){
	// console.log(blog_id);
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
		}
	}

	obj.open('GET', 'admin-process.php?action=blog_info&blog_id='+blog_id);
	obj.send();
}

function category_info(category_id){
	// console.log(category_id);
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}
	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
		}
	}

	obj.open('GET', 'admin-process.php?action=category_info&category_id='+category_id);
	obj.send();
}

function add_attachments(){
	var no_of_attachments = document.getElementById('no_of_attachments').value;

	if (no_of_attachments == "") {
		document.getElementById('attachment_msg').innerHTML = "Please Enter Numbers First";
	}else{
		document.getElementById('attachment_msg').innerHTML = "";
		var obj;

		if (window.ActiveXObject) {
			obj = new ActiveXObject('Microsoft.XMLHTTP');
		}else{
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function(){
			if (obj.readyState == 4 && obj.status == 200) {
				// console.log(obj.responseText);
				document.getElementById('attachments').innerHTML = obj.responseText;
			}
		}

		obj.open('GET', 'admin-process.php?action=add_attachments&numbers='+no_of_attachments);
		obj.send();
	}
}

function add_post(){
	var flag = true;

	var post_title = document.getElementById('post_title').value;
	var post_summary = document.getElementById('post_summary').value;
	var post_description = document.getElementById('post_description').value;
	var featured_image = document.getElementById('featured_image').value;
	var post_blog = document.getElementById('post_blog').value;
	var categories = document.getElementById('categories').value;

	if (post_title == "") {
		flag = false;
		document.getElementById('post_title_msg').innerHTML = "Please Write Post Title";
	}else{
		document.getElementById('post_title_msg').innerHTML = "";
	}

	if (post_summary == "") {
		flag = false;
		document.getElementById('post_summary_msg').innerHTML = "Please Write Post Summary";
	}else{
		document.getElementById('post_summary_msg').innerHTML = "";
	}

	if (post_description == "") {
		flag = false;
		document.getElementById('post_description_msg').innerHTML = "Please Write Post Description";
	}else{
		document.getElementById('post_description_msg').innerHTML = "";
	}

	if (featured_image == "") {
		flag = false;
		document.getElementById('featured_image_msg').innerHTML = "Please Select an Image";
	}else{
		document.getElementById('featured_image_msg').innerHTML = "";
	}

	if (post_blog == "") {
		flag = false;
		document.getElementById('blog_msg').innerHTML = "Please Select a Blog";
	}else{
		document.getElementById('blog_msg').innerHTML = "";
	}

	if (categories == "") {
		flag = false;
		document.getElementById('category_msg').innerHTML = "Please Select atleast one category";
	}else{
		document.getElementById('category_msg').innerHTML = "";
	}

	if (flag) {
		var form = document.querySelector('#addPostForm');
    	var formData = new FormData(form);

    	var obj;
    	show_loader();
    	if (window.ActiveXObject) {
    		obj = new ActiveXObject('Microsoft.XMLHTTP');
    	}else{
    		obj = new XMLHttpRequest();
    	}

    	obj.onreadystatechange = function(){
    		if (obj.readyState == 4 && obj.status == 200) {
    			// console.log(obj.responseText);
    			document.getElementById('add_post_form_msg').innerHTML = obj.responseText;
    			hide_loader();
    			setTimeout(add_post_form,2000);
    		}
    	}

    	obj.open('POST', 'admin-process.php?action=add_post');
    	obj.send(formData);
	}
}

function inactive_post(post_id){
	console.log(post_id);

	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_post_msg').innerHTML = obj.responseText;
			setTimeout(view_posts,2000);
		}
	}

	obj.open('GET', 'admin-process.php?action=inactive_post&post_id='+post_id);
	obj.send();
}

function active_post(post_id){
	console.log(post_id);

	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_post_msg').innerHTML = obj.responseText;
			setTimeout(view_posts,2000);
		}
	}

	obj.open('GET', 'admin-process.php?action=active_post&post_id='+post_id);
	obj.send();
}

function edit_post(post_id){
	// console.log(post_id);

	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
		}
	}

	obj.open('GET', 'admin-process.php?action=edit_post&post_id='+post_id);
	obj.send();
}

function update_post(post_id){
	// console.log(post_id);
	var flag = true;

	var post_title = document.getElementById('post_title').value;
	var post_summary = document.getElementById('post_summary').value;
	var post_description = document.getElementById('post_description').value;
	var featured_image = document.getElementById('featured_image').value;
	var post_blog = document.getElementById('post_blog').value;

	if (post_title == "") {
		flag = false;
		document.getElementById('post_title_msg').innerHTML = "Please Write Post Title";
	}else{
		document.getElementById('post_title_msg').innerHTML = "";
	}

	if (post_summary == "") {
		flag = false;
		document.getElementById('post_summary_msg').innerHTML = "Please Write Post Summary";
	}else{
		document.getElementById('post_summary_msg').innerHTML = "";
	}

	if (post_description == "") {
		flag = false;
		document.getElementById('post_description_msg').innerHTML = "Please Write Post Description";
	}else{
		document.getElementById('post_description_msg').innerHTML = "";
	}

	if (flag) {
		var form = document.querySelector('#updatePostForm');
    	var formData = new FormData(form);

    	var obj;
    	show_loader();
    	if (window.ActiveXObject) {
    		obj = new ActiveXObject('Microsoft.XMLHTTP');
    	}else{
    		obj = new XMLHttpRequest();
    	}

    	obj.onreadystatechange = function(){
    		if (obj.readyState == 4 && obj.status == 200) {
    			// console.log(obj.responseText);
    			document.getElementById('update_post_form_msg').innerHTML = obj.responseText;
    			hide_loader();
    			setTimeout(function(){
    				edit_post(post_id);
    			},2000);
    		}
    	}

    	obj.open('POST', 'admin-process.php?action=update_post&post_id='+post_id);
    	obj.send(formData);
	}
}


function given_categories(post_id){
	// console.log(post_id);
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
			$(document).ready( function () {
            	$('#example').DataTable();
        	} );
        	$(document).ready(function () {
            $('.js-example-basic-multiple').select2({
                placeholder: 'Select multiple options',
                allowClear: true,
                closeOnSelect: true // Allow multiple selections to stay open
            	});
        	});
		}
	}

	obj.open('GET','admin-process.php?action=given_categories&post_id='+post_id);
	obj.send();
}


function inactive_given_category(post_id,category_post_id){
	// console.log(post_id);
	// console.log(category_post_id);
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_given_categories_msg').innerHTML = obj.responseText;
			setTimeout(function(){
				given_categories(post_id);
			},2000)
		}
	}

	obj.open('GET', 'admin-process.php?action=inactive_given_category&category_post_id='+category_post_id);
	obj.send();
}

function active_given_category(post_id,category_post_id){
	// console.log(post_id);
	// console.log(category_post_id);
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_given_categories_msg').innerHTML = obj.responseText;
			setTimeout(function(){
				given_categories(post_id);
			},2000)
		}
	}

	obj.open('GET', 'admin-process.php?action=active_given_category&category_post_id='+category_post_id);
	obj.send();
}


function add_post_category(post_id){
	// console.log(post_id);
	var flag = true;

	var categories = document.getElementById('categories').value;

	if (categories == "") {
		flag = false;
		document.getElementById('category_msg').innerHTML = "Please Select atleast one category";
	}else{
		document.getElementById('category_msg').innerHTML = "";
	}

	if (flag) {
		var form = document.querySelector('#addPostCategoryForm');
    	var formData = new FormData(form);
    	var obj;
    	if (window.ActiveXObject) {
    		obj = new ActiveXObject('Microsoft.XMLHTTP');
    	}else{
    		obj = new XMLHttpRequest();
    	}

    	obj.onreadystatechange = function(){
    		if (obj.readyState == 4 && obj.status == 200) {
    			// console.log(obj.responseText);
    			document.getElementById('view_given_categories_msg').innerHTML = obj.responseText;
    			setTimeout(function(){
    				given_categories(post_id);
    			},2000);
    		}
    	}

    	obj.open('POST', 'admin-process.php?action=add_post_category&post_id='+post_id);
    	obj.send(formData);
	}
}


function given_attachments(post_id){
	// console.log(post_id);
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
			$(document).ready( function () {
            	$('#example').DataTable();
        	} );
		}
	}

	obj.open('GET','admin-process.php?action=given_attachments&post_id='+post_id);
	obj.send();
}

function inactive_given_attachment(post_id,post_attachment_id){
	// console.log(post_id+" | "+post_attachment_id);
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_given_attachments_msg').innerHTML = obj.responseText;
			setTimeout(function(){
				given_attachments(post_id);
			},2000);
		}
	}

	obj.open('GET', 'admin-process.php?action=inactive_given_attachment&post_attachment_id='+post_attachment_id);
	obj.send();
}

function active_given_attachment(post_id,post_attachment_id){
	// console.log(post_id+" | "+post_attachment_id);
	var obj;

	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_given_attachments_msg').innerHTML = obj.responseText;
			setTimeout(function(){
				given_attachments(post_id);
			},2000);
		}
	}

	obj.open('GET', 'admin-process.php?action=active_given_attachment&post_attachment_id='+post_attachment_id);
	obj.send();
}

function add_post_attachment(post_id){
	// console.log(post_id);
	var form = document.querySelector('#addPostAttachmentForm');
    var formData = new FormData(form);

    var obj;
    if (window.ActiveXObject) {
    	obj = new ActiveXObject('Microsoft.XMLHTTP');
    }else{
    	obj = new XMLHttpRequest();
    }

    obj.onreadystatechange = function(){
    	if (obj.readyState == 4 && obj.status == 200) {
    		// console.log(obj.responseText);
    		document.getElementById('view_given_attachments_msg').innerHTML = obj.responseText;
			setTimeout(function(){
				given_attachments(post_id);
			},2000);
    	}
    }

    obj.open('POST', 'admin-process.php?action=add_post_attachment&post_id='+post_id);
    obj.send(formData);
}

function view_comments(post_id){
	// console.log(post_id);
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
			$(document).ready( function () {
            	$('#example').DataTable();
        	} );
		}
	}

	obj.open('GET', 'admin-process.php?action=view_comments&post_id='+post_id);
	obj.send();
}


function active_given_comment(post_id,comment_id){
	// console.log(post_id+" | "+comment_id);
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_given_comments_msg').innerHTML = obj.responseText;
			setTimeout(function(){
				view_comments(post_id);
			},2000);
		}
	}

	obj.open('GET', 'admin-process.php?action=active_given_comment&comment_id='+comment_id);
	obj.send();
}

function inactive_given_comment(post_id,comment_id){
	// console.log(post_id+" | "+comment_id);
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			document.getElementById('view_given_comments_msg').innerHTML = obj.responseText;
			setTimeout(function(){
				view_comments(post_id);
			},2000);
		}
	}

	obj.open('GET', 'admin-process.php?action=inactive_given_comment&comment_id='+comment_id);
	obj.send();
}

function all_feedbacks(){
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
			$(document).ready( function () {
            	$('#example').DataTable();
        	} );
		}
	}

	obj.open('GET', 'admin-process.php?action=all_feedbacks');
	obj.send();
}
function visitors_feedback(){
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
			$(document).ready( function () {
            	$('#example').DataTable();
        	} );
		}
	}

	obj.open('GET', 'admin-process.php?action=visitors_feedback');
	obj.send();
}

function users_feedback(){
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function(){
		if (obj.readyState == 4 && obj.status == 200) {
			document.getElementById('dashboard_response').innerHTML = obj.responseText;
			$(document).ready( function () {
            	$('#example').DataTable();
        	} );
		}
	}

	obj.open('GET', 'admin-process.php?action=users_feedback');
	obj.send();
}

//Checks Email Function Start
function checksEmail(){
	var email = document.getElementById('email').value;

	if (email != "") {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject('Microsoft.XMLHTTP');
		}else{
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function(){
			if (obj.readyState == 4 && obj.status == 200) {
				if (obj.responseText.trim() == 'Yes') {
					document.getElementById('email_msg').innerHTML = "Email Already Exists";
					document.getElementById('register_btn').disabled = true;
				}else if(obj.responseText.trim() == "No"){
					document.getElementById('email_msg').innerHTML = "";
					document.getElementById('register_btn').disabled = false;
				}
			}
		}

		obj.open('GET', 'register-process.php?action=checks_email&email='+email);
		obj.send();
	}else{
		document.getElementById('email_msg').innerHTML = "";
		document.getElementById('register_btn').disabled = false;
	}
}
//Checks Email Function End

function unfollow_blog(follower_id, blog_following_id){
	// console.log(follower_id+" | "+blog_following_id);
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function (){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			if (obj.responseText != "") {
				window.location.href = "blogs-page.php";
			}
		}
	}

	obj.open('GET', 'user-process.php?action=unfollow_blog&follower_id='+follower_id+"&blog_following_id="+blog_following_id);
	obj.send();
}

function follow_blog(follower_id, blog_following_id){
	// console.log(follower_id+" | "+blog_following_id);
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function (){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			if (obj.responseText != "") {
				window.location.href = "blogs-page.php";
			}
		}
	}

	obj.open('GET', 'user-process.php?action=follow_blog&follower_id='+follower_id+"&blog_following_id="+blog_following_id);
	obj.send();
}

function add_follow_blog(follower_id, blog_following_id){
	// console.log(follower_id+" | "+blog_following_id);
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function (){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			if (obj.responseText != "") {
				window.location.href = "blogs-page.php";
			}
		}
	}

	obj.open('GET', 'user-process.php?action=add_follow_blog&follower_id='+follower_id+"&blog_following_id="+blog_following_id);
	obj.send();
}

function blog_unfollow_blog(follower_id, blog_following_id){
	// console.log(follower_id+" | "+blog_following_id);
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function (){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			if (obj.responseText != "") {
				window.location.href = "this-blog.php?blog_id="+blog_following_id;
			}
		}
	}

	obj.open('GET', 'user-process.php?action=unfollow_blog&follower_id='+follower_id+"&blog_following_id="+blog_following_id);
	obj.send();
}

function blog_follow_blog(follower_id, blog_following_id){
	// console.log(follower_id+" | "+blog_following_id);
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function (){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			if (obj.responseText != "") {
				window.location.href = "this-blog.php?blog_id="+blog_following_id;
			}
		}
	}

	obj.open('GET', 'user-process.php?action=follow_blog&follower_id='+follower_id+"&blog_following_id="+blog_following_id);
	obj.send();
}

function blog_add_follow_blog(follower_id, blog_following_id){
	// console.log(follower_id+" | "+blog_following_id);
	var obj;
	if (window.ActiveXObject) {
		obj = new ActiveXObject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();
	}

	obj.onreadystatechange = function (){
		if (obj.readyState == 4 && obj.status == 200) {
			// console.log(obj.responseText);
			if (obj.responseText != "") {
				window.location.href = "this-blog.php?blog_id="+blog_following_id;
			}
		}
	}

	obj.open('GET', 'user-process.php?action=add_follow_blog&follower_id='+follower_id+"&blog_following_id="+blog_following_id);
	obj.send();
}

function search_post(){
	var search = document.getElementById('search_post').value;

		// console.log(search);
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject('Microsoft.XMLHTTP');
		}else{
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function(){
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('home_posts').innerHTML = obj.responseText;
			}
		}

		obj.open('GET', 'user-process.php?action=search_post&search='+search);
		obj.send();
}
