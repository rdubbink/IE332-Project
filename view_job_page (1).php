<?php
	require_once('db.php');
	if (!isset($_GET['job_id']))
	{
		header("/student_profile.php");
	}
	$job_info = get_specific_job_info($_GET['job_id']);
	//var_dump($job_info);
?>

<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="view_job_page.css">
	<title>BoilerMatch | View Job</title>
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
	        <a class="nav-link" href="/job_match_tool.php">Job Match Tool</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#" id="job-search-toggle">Search Jobs</a>
	      </li>
	      <li class="search-holder">
	      	<form method="post" action="process.php">
	      		<input hidden type="" name="action" value="search_jobs">
	      		<input type="text" name="search_query">
	      		<button class="exec-search">Go</button>
	      	</form>
	      </li>
	    </ul>
	  </div>
	  <div class="right-side-nav">
	  	<ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" href="/student_profile.php">Profile</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="logout.php">Logout</a>
	      </li>
	    </ul>
	  </div>
	</nav>


	<div class="container main">
		<div class="menu">
			<div class="row">
				<div class="col-lg-12 col-md-12 profile_content">
					<div class="row">
						<div class="col-lg-2 col-md-2">
							<img class="w-120" src="images/google.png">
							<img class="w-120" src="images/rating.png">
						</div>
						<div class="col-lg-8 col-md-8 main-body">
							<h1><?php echo ucwords($job_info['title']); ?></h1>
							<p class="job-location"><?php echo $job_info['location'] ?></p>
							<p class="job-description">
								<?php echo $job_info['description']; ?>
							</p>
							<h5 style="text-align: left; color: #5a4744">Minimum Requirements</h5>
							<p style="text-align: left;">Academic Classification - <?php echo $job_info['academic_classification']; ?></p>
							<p style="text-align: left;">GPA - <?php echo $job_info['minimum_gpa'] ?></p>
							<p style="text-align: left;">Required Courses - <?php echo $job_info['courses']; ?></p>
							<button class="apply_button">
								Apply Now
							</button>

						</div>
						<div class="col-lg-2 col-md-2" style="text-align: center; margin-top: 40px;">
							<p style="font-size: 30px;"><?php echo $job_info['match_value']; ?>% <br><span style="font-size: 15px;">Match</span></p>
						</div>
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
	$('#job-search-toggle').click(function () {
		console.log($(".search-holder").css("display"));
		if ($(".search-holder").css("display") == "none")
		{
		    $(".search-holder").toggle("slide").promise().done(function() {
		    	$(".exec-search").fadeToggle();
		    })
		}
		else {
			$(".exec-search").fadeToggle("slide").promise().done(function() {
		    	$(".search-holder").toggle("slide")
		    })
		}

	});
</script>
</body>
</html>