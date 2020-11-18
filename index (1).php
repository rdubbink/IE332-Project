<?php 
 require_once("db.php");
 if (isset($_SESSION['employer']))
 {
 	header("Location: /employer_profile.php");
 }
  if (isset($_SESSION['student']))
 {
 	header("Location: /student_profile.php");
 }
 $courses = get_courses();
 ?>
 <datalist id="courses">
 <?php
 foreach ($courses as $value) {
 	echo "<option value='".$value['name']."'>";
 }
 ?>
  </datalist>
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
<title>BoilerMatch Home</title>
</head>
<body>
	
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">BoilerMatch</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Job Listings</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">All Companies</a>
	      </li>
	    </ul>
	  </div>
	</nav>


	<div class="container main">
		
		<div class="back">
			<svg class="back_button" width="30" height="30" aria-hidden="true" focusable="false" data-prefix="far" data-icon="arrow-alt-circle-left" class="svg-inline--fa fa-arrow-alt-circle-left fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M8 256c0 137 111 248 248 248s248-111 248-248S393 8 256 8 8 119 8 256zm448 0c0 110.5-89.5 200-200 200S56 366.5 56 256 145.5 56 256 56s200 89.5 200 200zm-72-20v40c0 6.6-5.4 12-12 12H256v67c0 10.7-12.9 16-20.5 8.5l-99-99c-4.7-4.7-4.7-12.3 0-17l99-99c7.6-7.6 20.5-2.2 20.5 8.5v67h116c6.6 0 12 5.4 12 12z"></path></svg>
		</div>
		<div class="menu">
			<div class="row">
				<h1 class="main-heading">Boiler Match</h1>
			</div>
			<?php
			if(isset($_SESSION['success']))
			{
				echo "<p class='success_message'>".$_SESSION['success']."</p>";
				unset($_SESSION['success']);
			}
			?>
			<div class="row">
				<h2 class="main-sub-heading">Are You A?</h2>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-4 button-parent">
					<button class="content_open" id="student">
						Student
					</button>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-4 button-parent">
					<button class="content_open" id="employer">
						Employer
					</button>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-4 button-parent">
					<button class="content_open" id="staff">
						IE Staff
					</button>
				</div>
			</div>
		</div>
		<div class="student_content row content_option">
			<div class="col-lg-7 col-md-7 student_login">
				<h2>Student Login</h2>
				<?php
					if(isset($_SESSION['errors']) && isset($_SESSION['error_reason']) && $_SESSION['error_reason'] == "missing_student")
					{
						foreach($_SESSION['errors'] as $error)
						{
							echo "<div class='row'><p style='color:#7b1515;'>". $error . "</p></div>";
						}
					}
				?>
				<form method="post" action="process.php">
				<input type="" name="action" hidden value="login_student">
				 	<div class="form-group">
				    	<label for="student_login_email">Email address</label>
				    	<input type="email" class="form-control" name="student_login_email" id="student_login_email" aria-describedby="emailHelp">
				  	</div>
				  	<div class="form-group">
				    	<label for="student_login_password">Password</label>
				    	<input type="password" class="form-control" name="student_login_password" id="student_login_password">
				  	</div>
				  	<button type="submit" class="btn">Login</button>
				</form>
				<p>New? Click <span id="open_student_registration">Here To Register</span></p>
			</div>
			<div class="col-lg-7 col-md-7 student_registration">
				<h2>Student Registration</h2>
				<?php
					if(isset($_SESSION['errors']) && isset($_SESSION['error_reason']) && $_SESSION['error_reason'] == "student_validation")
					{
						foreach($_SESSION['errors'] as $error)
						{
							echo "<div class='row'><p style='color:#902d2d;'>". $error . "</p></div>";
						}
					}
				?>
				<form enctype="multipart/form-data" method="post" action="process.php">
					<input hidden type="text" name="action" value="register">
					<div class="student_register_basic_info">
						<h4 class="sub_title">Basic Information</h4>
						<div class="form-group">
					 		<label for="firstName">First Name</label>
					    	<input type="text" class="form-control" name="firstName" id="firstName" aria-describedby="firstName">

					    	<label for="lastName">Last Name</label>
					    	<input type="text" class="form-control" name="lastName" id="lastName" aria-describedby="lastName">

					    	<label for="student_register_email">Email address</label>
					    	<input type="email" class="form-control" name="student_register_email" id="student_register_email" aria-describedby="emailHelp">
					    </div>
					    <div class="form-group">
					    	<label>Profile Picture</label><br>
   							<input type="file" name="image">
					    </div>
					    <div class="form-group">
					    	<label for="gpa">GPA</label>
					    	<input placeholder="Between 0.0 to 4.0" name="gpa" type="text" class="form-control" id="gpa" aria-describedby="emailHelp">
					  	</div>
					  	<div class="form-group">
					  		<label for="gpa">Academic Class</label>
					  		<div class="form-check">
							  	<input checked="" class="form-check-input" type="radio" name="class" value="Freshman" id="freshman">
							  	<label class="form-check-label" for="freshman">
							    	Freshman
							  	</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="class" value="Sophomore" id="sophomore">
							  	<label class="form-check-label" for="sophomore">
							    	Sophomore
							  	</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="class" value="Junior" id="junior">
							  	<label class="form-check-label" for="junior">
							    	Junior
							  	</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="class" value="Senior" id="senior">
							  	<label class="form-check-label" for="senior">
							    	Senior
							  	</label>
							</div>
					  	</div>
					  	<div class="form-group">
					    	<label for="student_register_password">Password</label>
					    	<input type="password" class="form-control" name="student_register_password" id="student_register_password">

					    	<label for="student_register_conf_password">Confirm Password</label>
					    	<input type="password" class="form-control" name="student_register_conf_password" id="student_register_conf_password">
					  	</div>
					  	<button type="button" class="btn  first_next">Next</button>
					</div>
					<div class="student_courses_info">
						<h4 class="sub_title">Enter Relevant Courses (Optional) <button type="button" class="add_row">Add Row</button></h4>
						<div class="form-row course_input">
						    <div class="col">
						     	<input type="text" list="courses" class="form-control" name="courses[]" placeholder="IE 335">
						    </div>
						    <div class="col">
						      	<select class="form-control" name="grades[]">
								  	<option selected hidden value="">Grade</option>
								  	<option value="A">A</option>
								  	<option value="B">B</option>
								  	<option value="C">C</option>
								</select>
						    </div>
						    <div class="col">
						      	<button class="remove_row" type="button">X</button>
						    </div>
						</div>
						<div class="margin-space">
							<button type="button" class="btn second_back">Back</button>
					  		<button type="button" class="btn second_next">Next</button>
						</div>
					</div>
					<div class="student_project_info">
						<h4 class="sub_title">Enter Relevant Projects (Optional) <button type="button" class="add_row_projects">Add Row</button></h4>
						<div class="project_holder">
							<div class="form-group">
							    <input type="text" class="form-control" name="project_titles[]" placeholder="Project Title">
							</div>
							<div class="form-group">
							    <textarea class="form-control" name="project_descriptions[]" rows="3"></textarea>
							</div>
							<button type="button" class="remove_row_projects">Delete</button>
							<hr>
						</div>
						<div class="margin-space">
					  		<button type="button" class="btn third_back">Back</button>
					  		<button type="button" class="btn third_next">Next</button>
					  	</div>
					</div>
					<div class="student_work_info">
						<h4 class="sub_title">Work Information (Optional)</h4>
						<!-- <div class="form-group">
					    	<label for="gpa">Upload Resume</label><br>
					    	<button class="resume">Upload</button>
					  	</div> -->
					  	<div class="form-group">
					    	<label for="gpa">Bio</label>
					    	<textarea name="description" class="form-control" rows="4" placeholder="Tell potential employers about yourself"></textarea>
					  	</div>
					  	<div class="form-group">
					  		<label for="gpa">Work Experience</label>
					  		<button type="button" class="add_row_work">Add Row</button>
						  	<div class="work_holder">
								<div class="form-group">
								    <input type="text" class="form-control" name="company_name[]" placeholder="Company Name">
								</div>
								<div class="form-group">
								    <select class="form-control" name="industries[]">
									  	<option selected hidden value="">Select Job Industry</option>
									  	<option value="Healthcare">Healthcare</option>
									  	<option value="Consulting">Consulting</option>
									  	<option value="Automotive">Automotive</option>
									  	<option value="Manufacturing">Manufacturing</option>
									  	<option value="Aerospace">Aerospace</option>
									  	<option value="Oil & Gas">Oil & Gas</option>
									  	<option value="Finance">Finance</option>
									  	<option value="Pharmaceutical">Pharmaceutical</option>
									</select>
								</div>
								<div class="form-group">
								    <input type="text" class="form-control" name="company_position[]" placeholder="Position">
								</div>
								<div class="form-group">
								    <input type="text" class="form-control" name="company_location[]" placeholder="Location">
								</div>
								<div class="form-group">
									<label>Start Date</label>
								    <input type="date" class="form-control" name="company_start_date[]">
								</div>
								<div class="form-group">
									<label>End Date</label>
								    <input type="date" class="form-control" name="company_end_date[]">
								</div>
								<div class="form-group">
								    <textarea class="form-control" name="company_role_description[]" rows="3" placeholder="Role Description"></textarea>
								</div>
								<button type="button" class="remove_row_work">Delete</button>
								<hr>
							</div>
						</div>
						<div class="margin-space">
					  		<button type="button" class="btn  fourth_back">Back</button>
					  		<button type="submit" class="btn ">Register</button>
					  	</div>
					</div>
				</form>
				<p>Already A Member? Click <span  id="open_student_login">Here To Login</span></p>
			</div>
		</div>
		<div class="employer_content row content_option">
			<div class="col-lg-7 col-md-7 employer_login">
				<h2>Employer Login</h2>
				<?php
					if(isset($_SESSION['errors']) && isset($_SESSION['error_reason']) &&  $_SESSION['error_reason'] == "missing_employer")
					{
						foreach($_SESSION['errors'] as $error)
						{
							echo "<div class='row'><p class='errors'>". $error . "</p></div>";
						}
						unset($_SESSION['errors']);
					}
				?>
				<form method="post" action="process.php">
					<input type="" name="action" hidden value="login_employer">
				 	<div class="form-group">
				    	<label for="corp_email">Corporate Email address</label>
				    	<input type="email" class="form-control" name="corp_email" id="corp_email" aria-describedby="emailHelp">
				  	</div>
				  	<div class="form-group">
				    	<label for="corp_password">Password</label>
				    	<input type="password" class="form-control" id="corp_password" name="corp_password">
				  	</div>
				  	<button type="submit" class="btn ">Login</button>
				</form>
			</div>
		</div>

		<div class="staff_content row content_option">
			<div class="col-lg-7 col-md-7 staff_login">
				<h2>IE Staff Login</h2>
				<?php
					if(isset($_SESSION['errors']) && $_SESSION['error_reason'] == "missing_staff")
					{
						foreach($_SESSION['errors'] as $error)
						{
							echo "<div class='row'><p class='errors'>". $error . "</p></div>";;
						}
						unset($_SESSION['errors']);
					}
				?>
				<form method="post" action="process.php">
					<input type="" name="action" hidden value="login_staff">
				 	<div class="form-group">
				    	<label for="staff_email">IE Staff Email address</label>
				    	<input type="email" class="form-control" id="staff_email" aria-describedby="emailHelp">
				  	</div>
				  	<div class="form-group">
				    	<label for="staff_password">Password</label>
				    	<input type="password" class="form-control" id="staff_password">
				  	</div>
				  	<button type="submit" class="btn ">Login</button>
				</form>
			</div>
		</div>
	</div>
	
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function() {

		<?php 
			if (isset($_SESSION['error_reason']) && $_SESSION['error_reason'] == "missing_employer")
			{ ?>
				$('.menu').fadeOut('fast', function() {
					$('.employer_content').fadeIn('fast');
					$('.employer_content').css('display', 'flex');
					$('.back').fadeIn('fast');
				})
			<?php 
				unset($_SESSION['error_reason']);
				unset($_SESSION['errors']);
			}
		?>

		<?php 
			if (isset($_SESSION['error_reason']) && $_SESSION['error_reason'] == "missing_staff")
			{ ?>
				$('.menu').fadeOut('fast', function() {
					$('.staff_content').fadeIn('fast');
					$('.staff_content').css('display', 'flex');
					$('.back').fadeIn('fast');
				})
			<?php 
				unset($_SESSION['error_reason']);
				unset($_SESSION['errors']);
			}
		?>

		<?php 
			if (isset($_SESSION['error_reason']) && $_SESSION['error_reason'] == "missing_student")
			{ ?>
				$('.menu').fadeOut('fast', function() {
					$('.student_content').fadeIn('fast');
					$('.student_content').css('display', 'flex');
					$('.back').fadeIn('fast');
				})
			<?php 
				unset($_SESSION['error_reason']);
				unset($_SESSION['errors']);
			}
		?>

		<?php 
			if (isset($_SESSION['error_reason']) && $_SESSION['error_reason'] == "student_validation")
			{ ?>
				$('.menu').fadeOut('fast', function() {
					$('.student_content').fadeIn('fast');
					$('.student_content').css('display', 'flex');
					$('.back').fadeIn('fast');
				});
				$('.student_login').fadeOut('fast', function() {
					$('.student_registration').fadeIn('fast');
				})
			<?php 
				unset($_SESSION['error_reason']);
				unset($_SESSION['errors']);
			}
		?>
		$('#student').click(function() {
			$('.menu').fadeOut('fast', function() {
				$('.student_content').fadeIn('fast');
				$('.student_content').css('display', 'flex');
				$('.back').fadeIn('fast');
			})
		})

		$('#employer').click(function() {
			$('.menu').fadeOut('fast', function() {
				$('.employer_content').fadeIn('fast');
				$('.employer_content').css('display', 'flex');
				$('.back').fadeIn('fast');
			})
		})

		$('#staff').click(function() {
			$('.menu').fadeOut('fast', function() {
				$('.staff_content').fadeIn('fast');
				$('.staff_content').css('display', 'flex');
				$('.back').fadeIn('fast');
			})
		})

		$('#open_student_registration').click(function() {
			$('.student_login').fadeOut('fast', function() {
				$('.student_registration').fadeIn('fast');
			})
		})

		$('#open_student_login').click(function() {
			$('.student_registration').fadeOut('fast', function() {
				$('.student_login').fadeIn('fast');
			})
		})

		$('.back_button').click(function() {
			$('.back').fadeOut('fast');
			$('.content_option').fadeOut('fast').promise().done(function(){

				$('.menu').fadeIn('fast');
			})
		})

		$('.first_next').click(function() {
			$('.student_register_basic_info').fadeOut('fast').promise().done(function() {
				$('.student_courses_info').fadeIn('fast');
			})
		})

		$('.second_next').click(function() {
			$('.student_courses_info').fadeOut('fast').promise().done(function() {
				$('.student_project_info').fadeIn('fast');
			})
		})

		$('.second_back').click(function() {
			$('.student_courses_info').fadeOut('fast').promise().done(function() {
				$('.student_register_basic_info').fadeIn('fast');
			})
		})

		$('.third_next').click(function() {
			$('.student_project_info').fadeOut('fast').promise().done(function() {
				$('.student_work_info').fadeIn('fast');
			})
		})

		$('.third_back').click(function() {
			$('.student_project_info').fadeOut('fast').promise().done(function() {
				$('.student_courses_info').fadeIn('fast');
			})
		})

		$('.fourth_back').click(function() {
			$('.student_work_info').fadeOut('fast').promise().done(function() {
				$('.student_project_info').fadeIn('fast');
			})
		})

		$('.add_row').click(function() {
			$('.course_input').last().after('<div class="form-row course_input"><div class="col"><input type="text" class="form-control" list="courses" name="courses[]" placeholder="IE 335"></div><div class="col"><select class="form-control" name="grades[]"><option>Grade</option><option>A</option><option>B</option><option>C</option></select></div><div class="col"><button class="remove_row" type="button">X</button></div></div>');
		})

		$('.add_row_projects').click(function() {
			$('.project_holder').last().after('<div class="project_holder"><div class="form-group"><input type="text" class="form-control" name="project_titles[]" placeholder="Project Title"></div><div class="form-group"><textarea class="form-control" name="project_descriptions[]" rows="3"></textarea></div><button type="button" class="remove_row_projects" >Delete</button><hr></div>');
		})

		$('.add_row_work').click(function() {
			$('.work_holder').last().after('<div class="work_holder"><div class="form-group"><input type="text" class="form-control" name="company_name[]" placeholder="Company Name"></div><div class="form-group"> <select class="form-control" name="industries[]"><option selected hidden value="">Select Job Industry</option><option value="Healthcare">Healthcare</option><option value="Consulting">Consulting</option><option value="Automotive">Automotive</option><option value="Manufacturing">Manufacturing</option><option value="Aerospace">Aerospace</option><option value="Oil & Gas">Oil & Gas</option><option value="Finance">Finance</option><option value="Pharmaceutical">Pharmaceutical</option></select></div><div class="form-group"><input type="text" class="form-control" name="company_position[]" placeholder="Position"></div><div class="form-group"><input type="text" class="form-control" name="company_location[]" placeholder="Location"></div><div class="form-group"><label>Start Date</label><input type="date" class="form-control" name="company_start_date[]"></div><div class="form-group"><label>End Date</label><input type="date" class="form-control" name="company_end_date[]"></div><div class="form-group"><textarea class="form-control" name="company_role_description[]" rows="3" placeholder="Role Description"></textarea></div><button type="button" class="remove_row_work">Delete</button><hr></div>')
		}) 

		
		$(document).on('click', '.remove_row', function() {
			if ($('.remove_row').length > 1)
			{
				$(this).parent().parent().remove();
			}
		})

		$(document).on('click', '.remove_row_projects', function() {
			if ($('.remove_row_projects').length > 1)
			{
				$(this).parent().remove();
			}
		})
		
		$(document).on('click', '.remove_row_work', function() {
			if ($('.remove_row_work').length > 1)
			{
				$(this).parent().remove();
			}

		})
	})
</script>
</body>
</html>