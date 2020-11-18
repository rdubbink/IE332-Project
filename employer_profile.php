 <?php
 //TODO: make sure user has the employer index set

 require_once("db.php");
  if (!isset($_SESSION['employer']))
 {
 	header("Location: /");
 }
 $courses = get_courses();
 $jobs = get_jobs();
 ?>
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="employer_profile.css">
	<title>BoilerMatch | Company Profile</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="/">BoilerMatch</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" href="#">All Companies</a>
	      </li>
	    </ul>
	  </div>
	  <div class="nav-right">
	  	<ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" href="#">Profile</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="logout.php">Logout</a>
	      </li>
	    </ul>
	  </div>
	</nav>


	<div class="container main">
		<div class="row">
			<h1 class="profile_header">Google</h1>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 profile_content">
				<div class="row">
					<img class="mid-image" src="./images/google.png">
				</div>
			</div>
		</div>
		<div class="back">
			<svg width="30" height="30" aria-hidden="true" focusable="false" data-prefix="far" data-icon="arrow-alt-circle-left" class="svg-inline--fa fa-arrow-alt-circle-left fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M8 256c0 137 111 248 248 248s248-111 248-248S393 8 256 8 8 119 8 256zm448 0c0 110.5-89.5 200-200 200S56 366.5 56 256 145.5 56 256 56s200 89.5 200 200zm-72-20v40c0 6.6-5.4 12-12 12H256v67c0 10.7-12.9 16-20.5 8.5l-99-99c-4.7-4.7-4.7-12.3 0-17l99-99c7.6-7.6 20.5-2.2 20.5 8.5v67h116c6.6 0 12 5.4 12 12z"></path></svg>
		</div>
		<div class="menu">
			<div class="row">
				<h1 class="page-heading" style="">Create/View Job Postings</h1>
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
				<h1 class="alt-heading">Create A New Job Posting</h1>
			</div>
			<?php
				if(isset($_SESSION['errors']))
				{
					foreach($_SESSION['errors'] as $error)
					{
						echo "<div class='row'><p class='errors'>". $error . "</p></div>";;
					}
					unset($_SESSION['errors']);
				}
			?>
			<div class="row">
				<form method="post" action="process.php">
					<input hidden type="text" name="action" value="new_job">
					<div class="form-group">
				    	<label for="job_title">Job Title</label>
				    	<input type="text" class="form-control" id="job_title" name="job_title" placeholder="Data Analyst">
				 	</div>
				  	<div class="form-group">
				    	<label for="job_location">Job Location</label>
				    	<input type="text" class="form-control" id="job_location" name="job_location" placeholder="Menlo Park, CA">
				  	</div>
				  	<div class="form-group">
				    	<label for="job_description">Job Description</label>
				    	<textarea name="job_description" class="form-control" id="job_description" rows="3"></textarea>
				  	</div>
				  	<h5>Preferred Academic Class</h5>
				  	<div class="form-check">
					  	<input class="form-check-input" type="radio" name="class" value="Freshman" id="freshman">
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
					<br>	
				  	<div class="form-group">
				    	<label for="gpa">GPA Range</label>
				    	<select class="form-control" id="gpa" name="gpa">
				      		<option value="2.0">2.0+</option>
				      		<option value="2.5">2.5+</option>
				      		<option value="3.0">3.0+</option>
				      		<option value="3.3">3.3+</option>
				      		<option value="3.5">3.5+</option>
				      		<option value="3.8">3.8+</option>
				    	</select>
				  	</div>
				  	<h5>Required Courses</h5>
				  	<?php foreach ($courses as $key => $value) { 
				  		if ($key % 4 == 0)
				  		{ ?>
				  			<div class="outerline">
				  		<?php }
				  		?>
				  		<div class="form-check-holder">
			  			<label for="<?php echo $value['id'];?>">
					    	<?php echo $value['name'];?>
					  	</label><br>
					  	<input  type="checkbox" name="courses[]" value="<?php echo $value['id'];?>" id="<?php echo $value['id'];?>">
					  	
					</div>
				  	<?php 
				  		if ($key % 4 == 3 || $key == sizeof($courses) - 1)
				  		{ ?>
				  			<hr>
				  		</div>
				  		<?php }
				  } ?>
				  	<div class="button-parent">
				  		<button class="add_job">Submit</button>
				  	</div>
				</form>
			</div>
		</div>

		<div class="view_jobs content_option">
			<div class="row">
				<h1 class="alt-heading">View Job Postings</h1>
			</div>
			<?php 
				foreach ($jobs as $value) {
					echo '<div class="job_entry">
						<div class="row">
							<div class="col-lg-9 col-md-9">
								<p class="job_heading">'.$value["title"].'<img class="company_logo" src="./images/google.png"></p>
								<p class="location">'.$value["location"].'</p>
								<p class="description">
									'.$value["description"].'
								</p>
							</div>
							<div class="col-lg-3 col-md-3">
								<a><button class="job_option edit">Edit</button></a><br>
								<button class="job_option delete">Delete</button><br>
								<a href="employee_match_tool.php?job_id='.$value["id"].'"><button class="job_option view">Find Candidates</button></a>
							</div>
						</div>
					</div>';
				}
			?>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript">
	<?php
		if (isset($_SESSION['error_reason']) && $_SESSION['error_reason'] == "new_job")
		{?>
			console.log("error back");
			$('.menu').fadeOut('fast', function() {
				$('.new_job').fadeIn('fast');
				$('.back').fadeIn('fast');
			})
		<?php 
			unset($_SESSION['error_reason']);
			unset($_SESSION['errors']);
		}
	 ?>
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