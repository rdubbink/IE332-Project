
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
			margin-bottom: 100px;
		}

		.employer_option {
			border: 1px solid silver;
			padding: 15px;
			padding-left: 30px;
			padding-right: 30px;
			margin-top: 20px;
			margin-bottom: 20px;
			border-radius: 4px;
			color: white;
			background-color: #a99cdc;
		}

		form {
			width: 60%;
		}

		.add_job {
			padding: 15px;
		    padding-left: 30px;
		    padding-right: 30px;
		    background-color: #ac89d4;
		    color: white;
		    border: none;
		}

		.new_job, .view_jobs {
			display: none
		}

		.back {
			display: none;
			padding-bottom: 20px;
		}

		.back > svg{
			cursor: pointer;

		}

		.content_option {
			background: #EEEFF3;
			background: -webkit-linear-gradient(top left, #EEEFF3, #EBE4F2);
			background: -moz-linear-gradient(top left, #EEEFF3, #EBE4F2);
			background: linear-gradient(to bottom right, #EEEFF3, #EBE4F2);
			padding: 50px;
		}

		.job_entry {
			padding: 50px;
			border-bottom: 1px solid silver;
		}

		.job_heading {
			font-size: 24px;
			margin-bottom: 0px;
		}

		.location {
			color: #75777b;
		}

		.match_strength {
			text-align: center;
			font-size: 22px;
			margin-top: 20px;
		}

		.description {
			color: #736c88;
		}

		.company_logo {
			width: 40px;
			margin-left: 10px;
		}

		.job_option {
			width: 80%;
			border: none;
			padding: 15px;
			padding-left: 20px;
			padding-right: 20px;
			margin-bottom: 5px;
			background-color: #8193ef;
    		color: white;
		}


	</style>
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
			<svg width="30" height="30" aria-hidden="true" focusable="false" data-prefix="far" data-icon="arrow-alt-circle-left" class="svg-inline--fa fa-arrow-alt-circle-left fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M8 256c0 137 111 248 248 248s248-111 248-248S393 8 256 8 8 119 8 256zm448 0c0 110.5-89.5 200-200 200S56 366.5 56 256 145.5 56 256 56s200 89.5 200 200zm-72-20v40c0 6.6-5.4 12-12 12H256v67c0 10.7-12.9 16-20.5 8.5l-99-99c-4.7-4.7-4.7-12.3 0-17l99-99c7.6-7.6 20.5-2.2 20.5 8.5v67h116c6.6 0 12 5.4 12 12z"></path></svg>
		</div>
		<div class="menu">
			<div class="row">
				<h1 style="color: #8f8c9a; font-size: 40px;">Create/View Job Postings</h1>
			</div>
			<div class="row">
				<button class="employer_option" id="new_job_button">Create New Job Posting</button>
			</div>
			<div class="row">
				<button class="employer_option" id="view_jobs_button">View Open Job Postings</button>
			</div>
		</div>
		<div class="new_job content_option">
			<div class="row">
				<h1 style="color: #8f8c9a; font-size: 40px;">Create A New Job Posting</h1>
			</div>
			<div class="row">
				
				<form>
					<div class="form-group">
				    	<label for="job_title">Job Title</label>
				    	<input type="email" class="form-control" id="job_title" name="job_title" placeholder="Data Analyst">
				 	</div>
				  	<div class="form-group">
				    	<label for="job_location">Job Location</label>
				    	<input type="email" class="form-control" id="job_location" name="job_location" placeholder="Menlo Park, CA">
				  	</div>
				  	<div class="form-group">
				    	<label for="job_description">Job Description</label>
				    	<textarea name="job_description" class="form-control" id="job_description" rows="3"></textarea>
				  	</div>
				  	<h5>Required Academic Class</h5>
				  	<div class="form-check">
					  	<input class="form-check-input" type="checkbox" name="class[]" value="freshman" id="freshman">
					  	<label class="form-check-label" for="freshman">
					    	Freshman
					  	</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="class[]" value="sophomore" id="sophomore">
					  	<label class="form-check-label" for="sophomore">
					    	Sophomore
					  	</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="class[]" value="junior" id="junior">
					  	<label class="form-check-label" for="junior">
					    	Junior
					  	</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="class[]" value="senior" id="senior">
					  	<label class="form-check-label" for="senior">
					    	Senior
					  	</label>
					</div>
					<br>	
				  	<div class="form-group">
				    	<label for="gpa">GPA Range</label>
				    	<select class="form-control" id="gpa">
				      		<option>2.0+</option>
				      		<option>2.5+</option>
				      		<option>3.0+</option>
				      		<option>3.3+</option>
				      		<option>3.5+</option>
				      		<option>3.8+</option>
				    	</select>
				  	</div>
				  	<h5>Required Courses</h5>
				  	<div class="form-check">
					  	<input class="form-check-input" type="checkbox" name="courses[]" value="ie_332" id="ie_332">
					  	<label class="form-check-label" for="ie_332">
					    	IE 332
					  	</label>
					</div>
					<div class="form-check">
					  	<input class="form-check-input" type="checkbox" name="courses[]" value="ie_200" id="ie_200">
					  	<label class="form-check-label" for="ie_200">
					    	IE 200
					  	</label>
					</div>
					<div class="form-check">
					  	<input class="form-check-input" type="checkbox" name="courses[]" value="ie_440" id="ie_440">
					  	<label class="form-check-label" for="ie_440">
					    	IE 440
					  	</label>
					</div>
				  	<div style="text-align: center;">
				  		<button class="add_job">Submit</button>
				  	</div>
				</form>
			</div>
		</div>
		<div class="view_jobs content_option">
			<div class="row">
				<h1 style="color: #8f8c9a; font-size: 40px;">View Job Postings</h1>
			</div>
			<div class="job_entry">
				<div class="row">
					<div class="col-lg-9 col-md-9">
						<p class="job_heading">Software Engineer <img class="company_logo" src="./images/google.png"></p>
						<p class="location">Menlo Park, CA</p>
						<p class="description">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque dui et lorem porttitor, sed mollis augue vestibulum. Maecenas euismod dui et mauris dignissim, nec aliquet libero lobortis
						</p>
					</div>
					<div class="col-lg-3 col-md-3">
						<button class="job_option edit">Edit</button><br>
						<button class="job_option delete">Delete</button><br>
						<button class="job_option view">Find Candidates</button>
					</div>
				</div>
			</div>
			<div class="job_entry">
				<div class="row">
					<div class="col-lg-9 col-md-9">
						<p class="job_heading">Data Analyst <img class="company_logo" src="./images/google.png"></p>
						<p class="location">San Diego, CA</p>
						<p class="description">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque dui et lorem porttitor, sed mollis augue vestibulum. Maecenas euismod dui et mauris dignissim, nec aliquet libero lobortis
						</p>
					</div>
					<div class="col-lg-3 col-md-3">
						<button class="job_option edit">Edit</button><br>
						<button class="job_option delete">Delete</button><br>
						<button class="job_option view">Find Candidates</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript">
	$('document').ready(function() {
		$('#new_job_button').click(function() {
			$('.menu').fadeOut('fast', function() {
				$('.new_job').fadeIn('fast');
				$('.back').fadeIn('fast');
			})
		})


		$('#view_jobs_button').click(function() {
			$('.menu').fadeOut('fast', function() {
				$('.view_jobs').fadeIn('fast');
				$('.back').fadeIn('fast');
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