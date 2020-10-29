
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Login and Registration</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" type="text/css" href="./custom_select.css">
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

		h1,h5 {
			text-align: center;
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
			<h1 style="color: #68586f; font-size: 60px;">Job Feed</h1>
			<h5 style="color: #78a8da; margin-bottom: 30px;">Search For A Job</h5>
			<div class="row">

				<div class="select animated zoomIn">
				    <!-- You can toggle select (disabled) -->
				    <input type="radio" name="option">
				    <i class="toggle icon icon-arrow-down"></i>
				    <i class="toggle icon icon-arrow-up"></i>
				    <span class="placeholder">Choose...</span>
				    <label class="option">
				        <input type="radio" name="option">
				        <span class="title animated fadeIn">Product Manager</span>
				    </label>
				    <label class="option">
				        <input type="radio" name="option">
				        <span class="title animated fadeIn">Data Scientist</span>
				    </label>
				    <label class="option">
				        <input type="radio" name="option">
				        <span class="title animated fadeIn">Site Reliability Engineer</span>
				    </label>
				</div>
			</div>
			<div class="row">
				<button style="
				margin-top: 20px;
				    padding: 10px;
			padding-left: 30px;
			padding-right: 30px;
    		font-size: 14px;
    		color: white;
    		background-color: #8a64d6;
    		border-radius: 4px;
    		border: none;">GO</button>
			</div>
		</div>
	</div>
	
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>