<?php 
 require_once("db.php");

if (!isset($_SESSION['student']))
{
	header("Location: index.php");
}
$job_matches = $_SESSION['search'];
?>
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="job_match_tool.css">
	
	<title>BoilerMatch | Job Match Tool</title>
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
				<div class="col-lg-3 col-md-3 col-sm-12 filter-container">

					<div class="filter">
						<h6>Filter By</h6>
						<div class="options">
							<div>
								<p>
									Company Name
								</p>
							</div>
							<div>
								<p>
									Company Rating
								</p>
							</div>
							<div>
								<p>
									Job Region
								</p>
							</div>
							<div class="filter-button-parent">
								<button class="filter-button">Apply Filter</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12">
					<h1 class="job-feed-header">Job Feed</h1>

					<div class="job_feed">
						<?php 
							foreach ($job_matches as $job) {
								if (empty($job['company_logo'])){
									$show = "<span class='alt_logo'> ".$job['company']." </span>";
								}
								else {
									$show = ' <img class="company_logo" src="data:image/jpg;charset=utf8;base64,".base64_encode('. $job['company_logo'] .')"/>';
								}
								echo '<a class="view-job-link" href="/view_job_page.php?job_id='.$job['id'] .'"><div class="job_entry">
							<div class="row">
								<div class="col-lg-9 col-md-9">
									<p class="job_heading">'. $job["title"] . $show .'</p>
									<p class="location">'. $job["location"] .'</p>
									<p class="description">
										'. $job["description"] .'
									</p>
								</div>
								<div class="col-lg-3 col-md-3">
								</div>
							</div>
						</div></a>';
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