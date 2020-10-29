
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Login and Registration</title>
	<style type="text/css">
		body {
			background: #E5F2E8;
			background: -webkit-linear-gradient(top left, #E5F2E8, #CCC4D4);
			background: -moz-linear-gradient(top left, #E5F2E8, #CCC4D4);
			background: linear-gradient(to bottom right, #E5F2E8, #CCC4D4);
		}

		.row {
			justify-content: center;
		}

		.main {
			margin-top: 100px;
		}

		h1 {
			color: #747eca;
		}

		button {
			width: 40%;
			padding: 20px;
    		font-size: 30px;
    		color: white;
    		background-color: #8a64d6;
    		border-radius: 4px;
    		border: none;
		}

		.student_content, .student_registration, .employer_content, .staff_content {
			display: none;
		}

		svg {
			cursor: pointer;
		}

		.back {
			display: none;
		}

	</style>
</head>
<body>
	<?php
		if(isset($_SESSION['errors']))
		{
			foreach($_SESSION['errors'] as $error)
			{
				echo $error;
			}
			unset($_SESSION['errors']);
		}

		if(isset($_SESSION['success']))
		{
			echo $_SESSION['success'];
			unset($_SESSION['success']);
		}
	?>
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
			<svg width="30" height="30" aria-hidden="true" focusable="false" data-prefix="far" data-icon="arrow-alt-circle-left" class="svg-inline--fa fa-arrow-alt-circle-left fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M8 256c0 137 111 248 248 248s248-111 248-248S393 8 256 8 8 119 8 256zm448 0c0 110.5-89.5 200-200 200S56 366.5 56 256 145.5 56 256 56s200 89.5 200 200zm-72-20v40c0 6.6-5.4 12-12 12H256v67c0 10.7-12.9 16-20.5 8.5l-99-99c-4.7-4.7-4.7-12.3 0-17l99-99c7.6-7.6 20.5-2.2 20.5 8.5v67h116c6.6 0 12 5.4 12 12z"></path></svg>
		</div>
		<div class="menu">
			<div class="row">
				<h1>Welcome To Boiler Match</h1>
			</div>
			<div class="row">
				<h2 style="margin-bottom: 50px;">Are You A?</h2>
			</div>
			<div class="row">
				<div style="text-align: center; margin-top: 10px; margin-bottom: 10px;" class="col-lg-12 col-md-12 col-sm-4">
					<button class="content_open" id="student">
						Student
					</button>
				</div>
				<div style="text-align: center; margin-top: 10px; margin-bottom: 10px;" class="col-lg-12 col-md-12 col-sm-4">
					<button class="content_open" id="employer">
						Employer
					</button>
				</div>
				<div style="text-align: center; margin-top: 10px; margin-bottom: 10px;" class="col-lg-12 col-md-12 col-sm-4">
					<button class="content_open" id="staff">
						IE Staff
					</button>
				</div>
			</div>
		</div>

		<div class="student_content row content_option">
			<div class="col-lg-7 col-md-7 student_login">
				<h2>Student Login</h2>
				<form>
				 	<div class="form-group">
				    	<label for="student_login_email">Email address</label>
				    	<input type="email" class="form-control" id="student_login_email" aria-describedby="emailHelp">
				  	</div>
				  	<div class="form-group">
				    	<label for="student_login_password">Password</label>
				    	<input type="password" class="form-control" id="student_login_password">
				  	</div>
				  	<button type="submit" class="btn btn-primary">Login</button>
				</form>
				<p>New? Click <span id="open_student_registration" style="color: #0070ff; cursor: pointer">Here To Register</span></p>
			</div>
			<div class="col-lg-7 col-md-7 student_registration">
				<h2>Student Registration</h2>
				<form>
				 	<div class="form-group">
				 		<label for="firstName">First Name</label>
				    	<input type="text" class="form-control" id="firstName" aria-describedby="firstName">

				    	<label for="lastName">Last Name</label>
				    	<input type="text" class="form-control" id="lastName" aria-describedby="lastName">

				    	<label for="student_register_email">Email address</label>
				    	<input type="email" class="form-control" id="student_register_email" aria-describedby="emailHelp">
				    </div>
				    <div class="form-group">
				    	<label for="gpa">GPA</label>
				    	<input placeholder="Between 0.0 to 4.0" type="text" class="form-control" id="gpa" aria-describedby="emailHelp">
				  	</div>
				  	<div class="form-group">
				    	<label for="student_register_password">Password</label>
				    	<input type="password" class="form-control" id="student_register_password">

				    	<label for="student_register_conf_password">Confirm Password</label>
				    	<input type="password" class="form-control" id="student_register_conf_password">
				  	</div>
				  	<button type="submit" class="btn btn-primary">Register</button>
				</form>
				<p>Already A Member? Click <span  id="open_student_login" style="color: #0070ff; cursor: pointer">Here To Login</span></p>
			</div>
		</div>

		<div class="employer_content row content_option">
			<div class="col-lg-7 col-md-7 employer_login">
				<h2>Employer Login</h2>
				<form>
				 	<div class="form-group">
				    	<label for="corp_email">Corporate Email address</label>
				    	<input type="email" class="form-control" id="corp_email" aria-describedby="emailHelp">
				  	</div>
				  	<div class="form-group">
				    	<label for="corp_password">Password</label>
				    	<input type="password" class="form-control" id="corp_password">
				  	</div>
				  	<button type="submit" class="btn btn-primary">Login</button>
				</form>
			</div>
		</div>

		<div class="staff_content row content_option">
			<div class="col-lg-7 col-md-7 staff_login">
				<h2>IE Staff Login</h2>
				<form>
				 	<div class="form-group">
				    	<label for="staff_email">IE Staff Email address</label>
				    	<input type="email" class="form-control" id="staff_email" aria-describedby="emailHelp">
				  	</div>
				  	<div class="form-group">
				    	<label for="staff_password">Password</label>
				    	<input type="password" class="form-control" id="staff_password">
				  	</div>
				  	<button type="submit" class="btn btn-primary">Login</button>
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

		$('.back').click(function() {
			$('.back').fadeOut('fast');
			$('.content_option').fadeOut('fast').promise().done(function(){

				$('.menu').fadeIn('fast');
			})
		})
	})
</script>
</body>
</html>