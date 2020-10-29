
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

		.filter {
			min-height: 260px;
			background: #EEEFF3;
			background: -webkit-linear-gradient(top left, #EEEFF3, #EBE4F2);
			background: -moz-linear-gradient(top left, #EEEFF3, #EBE4F2);
			background: linear-gradient(to bottom right, #EEEFF3, #EBE4F2);
		}

		.job_feed {
			min-height: 600px;
			background: #EEEFF3;
			background: -webkit-linear-gradient(top left, #EEEFF3, #EBE4F2);
			background: -moz-linear-gradient(top left, #EEEFF3, #EBE4F2);
			background: linear-gradient(to bottom right, #EEEFF3, #EBE4F2);
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

		.options > div > p {
			text-align: center;
			color: #565273;
			cursor: pointer;
			transition-duration: 0.4s;
			padding-top: 4px;
			padding-bottom: 4px;
			font-weight: 600;
		}
		.options > div > p:hover {
			background-color: #bab4ec;
			color: white
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
		<div class="menu">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-12" style="margin-top: 80px;">

					<div class="filter">
						<h6 style="text-align: center;padding: 15px;">Filter By</h6>
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
							<div style="text-align: center;">
								<button style="border: 1px solid #87599e; border-radius: 4px; padding: 10px; padding-left: 30px; padding-right: 30px;color: #87599e;">Apply</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12">
					<h1 style="text-align: center; color: #949292; margin-bottom: 40px;">Job Feed</h1>

					<div class="job_feed">
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
									<p class="match_strength">
										98% <br> <span style="font-size: 14px;">Match</span>
									</p>
								</div>
							</div>
						</div>
						<div class="job_entry">
							<div class="row">
								<div class="col-lg-9 col-md-9">
									<p class="job_heading">Project Manager <img class="company_logo" src="./images/microsoft.png"></p>
									<p class="location">Atlanta, GA</p>
									<p class="description">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque dui et lorem porttitor, sed mollis augue vestibulum. Maecenas euismod dui et mauris dignissim, nec aliquet libero lobortis
									</p>
								</div>
								<div class="col-lg-3 col-md-3">
									<p class="match_strength">
										93% <br><span style="font-size: 14px;">Match</span>
									</p>
								</div>
							</div>
						</div>
						<div class="job_entry">
							<div class="row">
								<div class="col-lg-9 col-md-9">
									<p class="job_heading">Data Analyst <img class="company_logo" src="./images/amazon.png"></p>
									<p class="location">San Diego, CA</p>
									<p class="description">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque dui et lorem porttitor, sed mollis augue vestibulum. Maecenas euismod dui et mauris dignissim, nec aliquet libero lobortis
									</p>
								</div>
								<div class="col-lg-3 col-md-3">
									<p class="match_strength">
										90% <br><span style="font-size: 14px;">Match</span>
									</p>
								</div>
							</div>
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

</body>
</html>