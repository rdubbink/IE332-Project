<?php

 require_once("db.php");

 if(isset($_POST['action']) && $_POST['action'] == "register")
 {	
 	register_user($_POST);
 }
 elseif(isset($_POST['action']) && $_POST['action'] == "login_student")
 {
 	login_student($_POST);
 }
 elseif(isset($_POST['action']) && $_POST['action'] == "new_job")
 {
 	create_new_job($_POST);
 }
  elseif(isset($_POST['action']) && $_POST['action'] == "login_employer")
 {
 	login_employer($_POST);
 }
  elseif(isset($_POST['action']) && $_POST['action'] == "login_staff")
 {
 	login_staff($_POST);
 }
 elseif (isset($_POST['action']) && $_POST['action'] == "update_student_basic_info")
 {
 	update_student_basic_info($_POST);
 }
 elseif (isset($_POST['action']) && $_POST['action'] == "update_student_work_experience")
 {
 	update_student_work_experience($_POST);
 }
 elseif (isset($_POST['action']) && $_POST['action'] =="update_student_courses")
 {
 	update_student_courses($_POST);
 }
 elseif (isset($_POST['action']) && $_POST['action'] == "search_jobs")
 {
 	search_for_job($_POST);
 }

 function search_for_job($post)
 {
 	global $tnt;
 	$tnt->selectIndex("name.index");
 	//This gets the top 12 search results
	$res = $tnt->search($post['search_query'], 12);
	$ids = join(",",$res['ids']); 
	$query = "SELECT jobs.id, jobs.title, jobs.location, jobs.description, jobs.academic_classification, jobs.industry, jobs.minimum_gpa, employers.company, employers.company_logo, group_concat(courses.name) as courses FROM jobs LEFT JOIN required_courses on jobs.id = required_courses.job_id LEFT JOIN courses on required_courses.course_id = courses.id LEFT JOIN employers on employers.id = jobs.employer_id WHERE jobs.id IN (".$ids.") GROUP BY jobs.id, jobs.title, jobs.academic_classification, jobs.location, jobs.minimum_gpa, jobs.description, jobs.industry, employers.company, employers.company_logo ORDER BY FIELD(jobs.id, ". $ids .")";
	$search_results = fetch_all($query);
	$_SESSION['search'] = $search_results;
	header("Location: /search_results.php");
 }

 function update_student_courses($post)
 {
 	$course = $post['course'];
 	$grade =  $post['grade'];
 	$id = $_SESSION['student']['id'];
 	$check_query = "SELECT * FROM taken_courses WHERE course_name = '{$course}' AND student_id = '{$id}'";
 	$record = fetch_record($check_query);
 	if (sizeof($record) != 0)
 	{
 		//Error
 		$_SESSION['errors'][] = "This Class Already Exists Under Your Taken Courses";
 		header("Location: /student_profile.php");
 		die();
 	}
 	$query = "INSERT INTO taken_courses (grade, course_name, student_id) VALUES ('{$grad}', '{$course}', '{$id}')";
 	if (run_mysql_query($query) != 1)
 	{
 		//Error
 		$_SESSION['errors'][] = "There was an error updating your info. Please try again later";
 		header("Location: /student_profile.php");
 		die();
 	}
 	$_SESSION['success'] = "Successfully Updated Your Taken Courses";
	header("Location: /student_profile.php");
 	die();
 }

 function update_student_work_experience($post) 
 {
 	$id = $_SESSION['student']['id'];
 	$company = $_POST['company_name'];
 	$position = $_POST['company_position'];
 	$location = $_POST['company_location'];
 	$start_date = $_POST['company_start_date'];
 	$end_date = $_POST['company_end_date'];
 	$industry = $_POST['industry'];
 	$role_description = $_POST['company_role_description'];
 	$query = "INSERT INTO work_experience (company, position, location, start_date, end_date, role_description, student_id, industry) VALUES ('{$company}', '{$position}', '{$location}', '{$start_date}', '{$end_date}', '{$role_description}', '{$id}', '{$industry}')";
 	if (run_mysql_query($query) != 1)
 	{
 		//Error
 		$_SESSION['errors'][] = "There was an error updating your info. Please try again later";
 		header("Location: /student_profile.php");
 		die();
 	}
 	$_SESSION['success'] = "Successfully Updated Your Work Experience";
 	header("Location: /student_profile.php");
 	die();
 }

 function update_student_basic_info($post)
 {
 	$class_match_array = ["Freshman" => 1, "Sophomore" => 2, "Junior" => 3, "Senior" => 4];
 	$first_name = escape_this_string($post['student_first_name']);
 	$last_name = escape_this_string($post['student_last_name']);
 	$email = escape_this_string($post['student_email']);
 	$description = escape_this_string($post['student_bio']);
 	$gpa = escape_this_string($post['student_gpa']);
 	$class = $class_match_array[escape_this_string($post['student_class'])];
 	$id = $_SESSION['student']['id'];
 	$query = "UPDATE students SET first_name='{$first_name}', last_name='{$last_name}', email='{$email}', academic_class='{$class}', gpa='{$gpa}', description='{$description}' WHERE id='{$id}'";
 	if (run_mysql_query($query) != 1)
 	{
 		//Error
 		$_SESSION['errors'][] = "There was an error updating your info. Please try again later";
 	}
 	$_SESSION['success'] = "Successfully Updated Your Info";
 	$email = $_SESSION['student']['email'];
 	$password = $_SESSION['student']['password'];
 	$user = fetch_record("SELECT * FROM students WHERE email = '{$email}' and password ='{$password}'");
 	if (!empty($user))
 	{
 		$_SESSION['student'] = $user;
 		if ($_SESSION['student']['profile_image'] == "")
 		{
 			$_SESSION['student']['profile_image'] = "./images/user_template.png";
 		}
 	}
 	header("Location: /student_profile.php");
 	die();
 }

function create_new_job($post) {
 	//TODO: Make sure the employer column is set
 	$_SESSION['errors'] = array();
 	if(empty($post['job_title']))
 	{
 		$_SESSION['errors'][] = "Please enter a job title";
 	}
 	if(empty($post['job_location']))
 	{
 		$_SESSION['errors'][] = "Please enter a location";
 	}
 	if(empty($post['job_description']))
 	{
 		$_SESSION['errors'][] = "Please enter a job description";
 	}

 	if(count($_SESSION['errors']) > 0)
 	{
 		$_SESSION['error_reason'] = "new_job";
 		header("location: employer_options.php");
 	}
 	else 
 	{
 		$title = $post['job_title'];
	 	$location = $post['job_location'];
	 	$description = $post['job_description'];
	 	$class = $post['class'];
	 	$gpa = $post['gpa'];

 	//Loop through classes;
 		$query = "INSERT INTO jobs (title, location, description, academic_classification, minimum_gpa, employer_id) VALUES ('{$title}', '{$location}', '{$description}', '{$class}', '{$gpa}', 1)";
 		run_mysql_query($query);
 		$_SESSION['success'] = "Job Successfully Created";
 		//Insert all courses
 		if (sizeof($post['courses']) > 0)
 		{
 			$query = "SELECT LAST_INSERT_ID() as id";
			$cleaned = fetch_record($query);
			$id = $cleaned['id'];
			foreach ($post['courses'] as $value) {
				$query = "INSERT INTO required_courses (job_id, course_id) VALUES ({$id}, {$value})";
 				run_mysql_query($query);
			}
 		}
 		header("location: employer_profile.php");
 		die();
 	}
 }

 function register_user($post)
 {
 	$_SESSION['errors'] = array();
 	if(empty($post['firstName']))
 	{
 		$_SESSION['errors'][] = "Please enter a first name";
 	}
 	if(empty($post['lastName']))
 	{
 		$_SESSION['errors'][] = "Please enter a last name";
 	}

 	if (sizeof($post['courses']) > 1 || (sizeof($post['courses']) == 1 && !empty($post['courses'][0])))
 	{
	 	foreach ($post['courses'] as $key => $value) {
	 		if (empty($value) || $post['grades'][$key] == "")
	 		{
	 			"Please enter a valid course with a grade";
	 		}
	 	}
	}

	if (sizeof($post['project_titles']) > 1 || (sizeof($post['project_titles']) == 1 && !empty($post['project_titles'][0])))
 	{
	 	foreach ($post['project_titles'] as $key => $value) {
	 		if (empty($value) || empty($post['project_descriptions'][$key]))
	 		{
	 			"Please enter a valid project";
	 		}
	 	}
	}

 	if(empty($post['gpa']) || !is_numeric($post['gpa']) || (float)$post['gpa'] < 0.0 || (float)$post['gpa'] > 4.0 )
 	{
 		$_SESSION['errors'][] = "Please enter a valid gpa";
 	}

 	if(empty($post['student_register_email']) && !filter_var($post['student_register_email'], FILTER_VALIDATE_EMAIL))
 	{
 		$_SESSION['errors'][] = "Please enter a valid email";
 	}
 	if(empty($post['student_register_password']))
 	{
 		$_SESSION['errors'][] = "Please enter a password";
 	}
 	if($post['student_register_password'] !== $post['student_register_conf_password'])
 	{
 		$_SESSION['errors'][] = "Please make sure passwords match";
 	}

 	if(count($_SESSION['errors']) > 0)
 	{
 		//var_dump($_SESSION['errors']);
 		$_SESSION['error_reason'] = "student_validation";
 		header("location: index.php");
 		//die();
 	}
 	else{
 		$class_match_array = ["Freshman" => 1, "Sophomore" => 2, "Junior" => 3, "Senior" => 4];
 		$fname = $post['firstName'];
 		$lname = $post['lastName'];
 		$email = $post['student_register_email'];
 		$gpa = $post['gpa'];
 		$class = $class_match_array[$post['class']];
 		$description = $post['description'];
 		$password = $post['student_register_password'];

 		//Check if user already exists
 		$query = "SELECT id FROM students where email = '{$email}'";
 		$found_user = fetch_all($query);
 		if (sizeof($found_user) > 0)
 		{
 			$_SESSION['errors'][] = "An account already exists with this email";
 			$_SESSION['error_reason'] = "student_validation";
 			header("location: index.php");
 		}
 		else {
 			if(!empty($_FILES["image"]["name"])) { 
		        // Get file info 
		        $fileName = basename($_FILES["image"]["name"]); 
		        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
		        $image = $_FILES['image']['tmp_name']; 
            	$imgContent = addslashes(file_get_contents($image));
            }
            else {
            	$imgContent = "";
            }

	 		$query = "INSERT INTO students (first_name, last_name, email, profile_image, academic_class, gpa, description, password) VALUES ('{$fname}', '{$lname}', '{$email}', '{$imgContent}', '{$class}', '{$gpa}', '{$description}', '{$password}')";
	 		if (run_mysql_query($query) != 1)
	 		{
	 			$_SESSION['errors'][] = "An error occurred. Please try again later";
	 			$_SESSION['error_reason'] = "student_validation";
	 			header("location: index.php");
	 			die();
	 		}
	 		$query = "SELECT LAST_INSERT_ID() as id";
			$cleaned = fetch_record($query);
			$id = $cleaned['id'];

	 		if (sizeof($post['courses']) > 0)
	 		{
	 			//TODO: Deduplication Needed
	 			//Insert courses
	 			foreach ($post['courses'] as $key => $value) {
	 				$grade = $post['grades'][$key];
			 		$query = "INSERT INTO taken_courses (grade, course_name, student_id) VALUES ('{$grade}', '{$value}', '{$id}')";
	 				run_mysql_query($query);
			 	}
	 		}
	 		if (sizeof($post['project_titles']) > 0 )
	 		{
	 			//Insert projects
	 			foreach ($post['project_titles'] as $key => $value) {
	 				if ($value != "" &&  $post['project_descriptions'][$key] != "")
	 				{
	 					$description = $post['project_descriptions'][$key];
	 					$query = "INSERT INTO projects (title, description, student_id) VALUES ('{$value}', '{$description}', '{$id}')";
	 					run_mysql_query($query);
			 			
	 				}
			 	}

	 		}
	 		if (sizeof($post['company_name']) > 0)
	 		{
	 			//Insert work experience
	 			foreach ($post['company_name'] as $key => $value) {
	 				$position = $post['company_position'][$key];
	 				$location = $post['company_location'][$key];
	 				$start_date = $post['company_start_date'][$key];
	 				$end_date = $post['company_end_date'][$key];
	 				$role_description = $post['company_role_description'][$key];
	 				$industry = $post['industries'][$key];
	 				if ($value != "" &&  $position != "" && $location != "" && $start_date != "" && $end_date != "" && $role_description != "" && $industry != "")
	 				{
				 		$query = "INSERT INTO work_experience (company, position, location, start_date, end_date, role_description, industry, student_id) VALUES ('{$value}', '{$position}', '{$location}', '{$start_date}', '{$end_date}', '{$role_description}', '{$industry}', '{$id}')";
		 				run_mysql_query($query);
		 			}
			 	}

	 		}
	 		$_SESSION['success'] = "Successfully Registered. Please Login";
	 		header("location: index.php");
	 		die();
 		}

 	}
 }

 function login_student($post)
 {
 	$email = escape_this_string($post['student_login_email']);
 	$password = $post['student_login_password'];

 	$user = fetch_record("SELECT * FROM students WHERE email = '{$email}' and password ='{$password}'");
 	if (!empty($user))
 	{
 		$_SESSION['student'] = $user;
 		if ($_SESSION['student']['profile_image'] == "" || $_SESSION['student']['profile_image'] == NULL)
 		{
 			$_SESSION['student']['profile_image'] = "./images/user_template.png";
 		}
 		header("location: student_profile.php");
 		die();
 	}
 	else
 	{
 		$_SESSION['error_reason'] = "missing_student";
 		$_SESSION['errors'][] = "Incorrect Username Or Password";
 		header("location: index.php");

 	}
 	
 }

 function login_employer($post)
 {
 	$email = escape_this_string($post['corp_email']);
 	$password = $post['corp_password'];

 	$user = fetch_record("SELECT * FROM employers WHERE email = '{$email}' and password ='{$password}'");
 	if (!empty($user))
 	{
 		$_SESSION['employer'] = $user;
 		header("location: employer_profile.php");
 		die();
 	}
 	else
 	{
 		$_SESSION['error_reason'] = "missing_employer";
 		$_SESSION['errors'][] = "Incorrect Username Or Password";
 		header("location: index.php");
 	}
 }

 function login_staff($post)
 {
 	$email = escape_this_string($post['email']);
 	$password = $post['password'];

 	$user = fetch_record("SELECT * FROM staff WHERE email = '{$email}' and password ='{$password}'");
 	if (!empty($user))
 	{
 		$_SESSION['staff'] = $user;
 		header("location: staff_profile.php");
 		die();
 	}
 	else
 	{
 		$_SESSION['error_reason'] = "missing_staff";
 		$_SESSION['errors'][] = "Incorrect Username Or Password";
 		header("location: index.php");

 	}
 }
