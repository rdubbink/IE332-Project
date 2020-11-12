
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Student profile</title>
	<style type="text/css">
		body {
			background: Black;
			background: -webkit-linear-gradient(top left, #0d0d0d, #333333);
		}
		/*body {
			background: #E5F2E8;
			background: -webkit-linear-gradient(top left, #E5F2E8, #CCC4D4);
			background: -moz-linear-gradient(top left, #E5F2E8, #CCC4D4);
			background: linear-gradient(to bottom right, #E5F2E8, #CCC4D4);
		}*/

		.row {
			justify-content: center;
		}

		.main {
			margin-top: 100px;
		}

		.profile_content {
			min-height: 600px;
			background: #EEEFF3;
			/*background: -webkit-linear-gradient(top left, #EEEFF3, #EBE4F2);
			background: -moz-linear-gradient(top left, #EEEFF3, #EBE4F2);
			background: linear-gradient(to bottom right, #EEEFF3, #EBE4F2);*/
			padding: 50px;
		}

		.profile_info {
			padding-top: 25px;
		}

		.student_name {
			font-size: 30px;
			margin-bottom: 0;
		}

		.classification {
			color: #e6b800;
		}

		.options {
			background-color: white;
			margin-top: 50px;
		}

		.option_title {
			text-align: center;
			padding-top: 10px;
			padding-bottom: 10px;
			border-bottom: 1px solid silver;
			transition-duration: 0.4s;
			cursor: pointer;
		}

		.option_title: hover {
			color: white;
			background-color: red;
		}

		.update_info {
			width: 60%;
			padding: 10px;
			margin-bottom: 10px;
		}

		.input_label {
			width: 60%;
			text-align: left;
		}

		.edit_info {
			width: 100%;
			text-align: center;
		}

		.profile_header {
			margin-bottom: 35px;
			color: #93acbd;
		}

		.active {
			border-bottom-color: purple;
		}

		.button_holder > button {
			border: none;
			padding: 10px;
			padding-left: 30px;
			padding-right: 30px;
			border-radius: 4px;
			color: Black;
			background-color: GoldenRod;
		}

	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<img src=BoilerMatchLogo.jpg style="width:200px; height:60px">
		<!--<a class="navbar-brand" href="#">BoilerMatch</a>-->
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
				<h1 class="profile_header" style="color: GoldenRod">Your Profile</h1>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 profile_content">

					<div class="row">
						<div class="col-lg-3 col-md-3 profile_picture">
							<img style="width: 150px;" src="./images/user_template.png">
						</div>
						<div class="col-lg-9 col-md-9 profile_info">
							<p class="student_name">John Doe</p>
							<p class="classification">Industrial Engineering Major</p>
							<p class="student_bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae ornare leo. In massa sem, lacinia non leo eu, condimentum blandit metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Mauris quis magna a leo bibendum sodales. Donec tempor mi arcu, ut tempus risus dictum id.</p>
							<div class="row">
								<div class="col-lg-12 options row">
									<div class="col-lg-6 col-md-6">
										<p class="option_title active">Edit Info</p>
									</div>
									<div class="col-lg-6 col-md-6">
										<p class="option_title">Account Settings</p>
									</div>
									<div class="edit_info">
										<form>
											<label class="input_label" for="student_name">
												Name
											</label>
											<br>
											<input id="student_name" class="update_info" value="John Doe" type="text" name="student_name">
											<label class="input_label" for="student_major">
												Major
											</label>
											<br>
											<input disabled id="student_major" class="update_info" value="Industrial Engineering" type="text" name="student_major">
											<label class="input_label" for="student_gpa">
												GPA
											</label>
											<br>
											<input id="student_gpa" class="update_info" value="3.25" type="text" name="student_gpa">
											<label class="input_label" for="student_class">
												Academic Classification
											</label>
											<br>
											<input id="student_class" class="update_info" value="Sophomore" type="text" name="student_class">

											<div class="work_experience">
												<h2>

												</h2>
												<div class="new_experience">

												</div>
											</div>

											<div class="button_holder">
												<button>
													Apply
												</button>
											</div>
										</form>
									</div>
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
