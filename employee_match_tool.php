<?php 
require_once("db.php");
if (!isset($_GET['job_id']))
{
	header("Location: index.php");
}
$employee_matches = get_employee_matches($_GET['job_id']);
?>
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="employee_match_tool.css">
	<title>BoilerMatch | Employee Match Tool</title>
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
	        <a class="nav-link" href="#">Job Listings</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">All Companies</a>
	      </li>
	    </ul>
	  </div>
	 <div class="nav-right">
	  	<ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" href="/employer_profile.php">Profile</a>
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
				<div class="col-lg-12 col-md-12 col-sm-12">
					<h1 class="page-header">Potential Data Analyst Candidates</h1>

					<div class="candidate_feed">
						<?php
						foreach ($employee_matches as $key => $value) {
							if(empty($value['profile_image'])){
								$image_source = "./images/user_template.png";
							} 
							else
							{
								$image_source = "data:image/jpg;charset=utf8;base64,".base64_encode($value['profile_image']);
							}
						 	echo '<div class="candidate_entry">
									<div class="row">
										<div class="col-lg-9 col-md-9">
										<div class="row">
											<div class="col-lg-2 col-md-2">
												<img class="candidate_image" src="'.$image_source.'">
											</div>
											<div class="col-lg-10 col-md-10">
												<p class="job_heading">'.$value["first_name"]." ".$value["last_name"].'</p>
												<p class="candidate_class">'.$value["academic_class"].'</p>
											</div>
										</div>
											<p class="description">
												'.$value["description"].'
											</p>
										</div>
										<div class="col-lg-3 col-md-3">
											<p class="match_strength">
												'.$value["match_value"].'% <br> <span style="font-size: 14px;">Match</span>
											</p>
										</div>
									</div>
								</div>';
						 } 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>