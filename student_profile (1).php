<?php 
 require_once("db.php");

if (!isset($_SESSION['student']))
{
	header('location: index.php');
}
$academic_class_match = array("Freshman", "Sophomore", "Junior", "Senior");
$survey_completed = get_work_is_survey_completed();
 ?>
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="student_profile.css">
	<title>BoilerMatch | Student Profile</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<!-- Latest compiled and minified JavaScript -->
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">BoilerMatch</a>
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
	  <div class="nav-right" style="">
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
		<div class="menu">
			<div class="row">
				<?php
				if(isset($_SESSION['success']))
				{
					echo "<p class='success_message'>".$_SESSION['success']."</p>";
					unset($_SESSION['success']);
				}
				if(isset($_SESSION['errors']))
					{
						foreach($_SESSION['errors'] as $error)
						{
							echo "<div class='row'><p style='color:#7b1515;'>". $error . "</p></div>";
						}
						unset($_SESSION['errors']);
					}
				?>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 profile_content">
					<div class="row">
						<div class="col-lg-3 col-md-3 profile_picture">
							<img class="mid-image" src="<?php if($_SESSION['student']['profile_image'] == "./images/user_template.png"){
								echo $_SESSION["student"]["profile_image"];
							} 
							else
							{
								echo "data:image/jpg;charset=utf8;base64,".base64_encode($_SESSION['student']['profile_image']);
							}
							 ?>" /> 
							
						</div>
						<div class="col-lg-9 col-md-9 profile_info">
							<p class="student_name"><?php echo $_SESSION['student']['first_name']." ".$_SESSION['student']['last_name']; ?></p>
							<p class="classification">Industrial Engineering Major</p>
							<p class="student_bio"><?php echo $_SESSION['student']['description']; ?></p>
							<div class="row">
								<div class="col-lg-12 options row">
									<div class="col-lg-12 row">
										<div class="col-lg-2 col-md-2">
											<p id="edit_info" class="option_title active" data-combine="edit_info">Edit Info</p>
										</div>
										<div class="col-lg-2 col-md-2">
											<p id="work" class="option_title" data-combine="edit_work">Work</p>
										</div>
										<div class="col-lg-2 col-md-2">
											<p id="courses" class="option_title" data-combine="edit_courses">Courses</p>
										</div>
										<div class="col-lg-2 col-md-2">
											<p id="projects" class="option_title" data-combine="edit_projects">Projects</p>
										</div>
										<div class="col-lg-2 col-md-2">
											<p id="surveys" class="option_title" data-combine="surveys">Surveys</p>
										</div>
									</div>
								
									<div class="col-lg-12 col-md-12">
										<div class="edit_info curr_view">
											<h4 for="gpa">Edit Your Info</h4>
											<form method="post" action="process.php">
												<input hidden type="text" name="action" value="update_student_basic_info">
												<label class="input_label" for="student_first_name">
													First Name
												</label>
												<br>
												<input required id="student_first_name" class="update_info" value="<?php echo $_SESSION['student']['first_name']; ?>" type="text" name="student_first_name">
												<label class="input_label" for="student_last_name">
													Last Name
												</label>
												<br>
												<input required id="student_last_name" class="update_info" value="<?php echo $_SESSION['student']['last_name']; ?>" type="text" name="student_last_name">
												<label class="input_label" for="student_last_name">
													Email
												</label>
												<br>
												<input required id="student_email" class="update_info" value="<?php echo $_SESSION['student']['email']; ?>" type="email" name="student_email">
												<label class="input_label" for="student_bio">
													Bio
												</label>
												<br>
												<textarea required id="student_bio" class="update_info" type="text" name="student_bio"><?php echo $_SESSION['student']['description']; ?></textarea>
												<label class="input_label" for="student_gpa">
													GPA
												</label>
												<br>
												<input required id="student_gpa" class="update_info" value="<?php echo $_SESSION['student']['gpa']; ?>" type="text" name="student_gpa">
												<label class="input_label" for="student_class">
													Academic Classification
												</label>
												<br>
												<select class="update_info" id="student_class" name="student_class">
													<option <?php if ($_SESSION['student']['academic_class'] == 1){echo "selected";}; ?>>Freshman</option>
													<option <?php if ($_SESSION['student']['academic_class'] == 2){echo "selected";}; ?>>Sophomore</option>
													<option <?php if ($_SESSION['student']['academic_class'] == 3){echo "selected";}; ?>>Junior</option>
													<option <?php if ($_SESSION['student']['academic_class'] == 4){echo "selected";}; ?>>Senior</option>
												</select>
												<div class="work_experience">
													<h2>
														
													</h2>
													<div class="new_experience">
														
													</div>
												</div>

												<div class="button_holder">
													<button>
														Apply Changes
													</button>
												</div>
											</form>
										</div>
										<div class="edit_work">
											<div class="form-group">
											  	<h4 for="gpa">Add New Work Experience</h4>
												<form method="post" action="process.php">
													<input hidden type="text" name="action" value="update_student_work_experience">
												  	<div class="work_holder">
														<div class="form-group">
														    <input required type="text" class="form-control" name="company_name" placeholder="Company Name">
														</div>
														<div class="form-group">
														    <select class="form-control" name="industry">
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
														    <input required type="text" class="form-control" name="company_position" placeholder="Position">
														</div>
														<div class="form-group">
														    <input required type="text" class="form-control" name="company_location" placeholder="Location">
														</div>
														<div class="form-group">
															<label>Start Date</label>
														    <input required type="date" class="form-control" name="company_start_date">
														</div>
														<div class="form-group">
															<label>End Date</label>
														    <input required type="date" class="form-control" name="company_end_date">
														</div>
														<div class="form-group">
														    <textarea required class="form-control" name="company_role_description" rows="3" placeholder="Role Description"></textarea>
														</div>
														<div class="button_holder">
															<button type="submit" class="add_new_work_experience">
																Add
															</button>
														</div>
														<hr>
													</div>
												</form>
											</div>
										</div>
										<div class="edit_courses">
											<h4 class="centered-header">Add A New Course</h4>
											<div class="centered-content" class="form-row course_input">
											  	<form method="post" action="process.php">
													<input hidden type="text" name="action" value="update_student_courses">
											  		<div class="col">
												     	<input required type="text" list="courses" class="form-control" name="course" placeholder="IE 335">
												    </div>
												    <div class="col">
												      	<select required class="form-control" name="grade">
														  	<option value="" disabled selected hidden>Grade</option>
														  	<option value="A" >A</option>
														  	<option value="B" >B</option>
														  	<option value="C" >C</option>
														</select>
												    </div>
												    <div class="col button_holder">
														<button type="submit" class="add_new_work_experience">Add</button>
												    </div>
											  	</form>
											</div>
											<div class="current_courses">
												
											</div>
										</div>
										<div class="edit_projects">
											<h4 style="text-align: center;">Add A New Project</h4>
											<div style="justify-content: center;" class="form-row course_input">
											  	<form style="width: 80%" method="post" action="process.php">
													<input hidden type="text" name="action" value="update_student_projects">
											  		<div class="form-group">
													    <input type="text" class="form-control" name="project_title" placeholder="Project Title">
													</div>
													<div class="form-group">
													    <textarea class="form-control" name="project_description" rows="3"></textarea>
													</div>
												    <div class="col button_holder">
														<button type="submit" class="add_new_work_experience">Add</button>
												    </div>
											  	</form>
											</div>
											<div class="current_projects">
												
											</div>
										</div>
										<div class="surveys">
											<div class="back">
												<svg class="back_button" width="30" height="30" aria-hidden="true" focusable="false" data-prefix="far" data-icon="arrow-alt-circle-left" class="svg-inline--fa fa-arrow-alt-circle-left fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M8 256c0 137 111 248 248 248s248-111 248-248S393 8 256 8 8 119 8 256zm448 0c0 110.5-89.5 200-200 200S56 366.5 56 256 145.5 56 256 56s200 89.5 200 200zm-72-20v40c0 6.6-5.4 12-12 12H256v67c0 10.7-12.9 16-20.5 8.5l-99-99c-4.7-4.7-4.7-12.3 0-17l99-99c7.6-7.6 20.5-2.2 20.5 8.5v67h116c6.6 0 12 5.4 12 12z"></path></svg>
											</div>
											<div class="survey-options">
												<div style="text-align: center;">
													<button data-match="interest_survey" class="survey-button">
														Interest Survey
													</button>
												</div>
												<div style="text-align: center;">
													<button data-match="company_survey" class="survey-button">
														 Rate Past Employers
													</button>
												</div>
											</div>
											<div class="whole-survey interest_survey">
												<h4 style="text-align: center;">Let Us Know Your Interests</h4>
												<h6 style="text-align: center;">Select Industries</h6>
												<div style="justify-content: center;" class="form-row course_input">
												  	<form method="post" action="process.php">
												  		<label class="block-label">
														<input type="checkbox" name="interests" value="Healthcare">
												  			Healthcare
												  		</label>
												  		<label  class="block-label">
														<input type="checkbox" name="interests" value="Consulting">
												  			Consulting
												  		</label>
												  		<label  class="block-label">
														<input type="checkbox" name="interests" value="Automotive">
												  			Automotive
												  		</label>
												  		<label  class="block-label">
														<input type="checkbox" name="interests" value="Manufacturing">
												  			Manufacturing
												  		</label>
												  		<label  class="block-label">
														<input type="checkbox" name="interests" value="Aerospace">
												  			Aerospace
												  		</label>
												  		<label  class="block-label">
														<input type="checkbox" name="interests" value="Oil & Gas">
												  			Oil & Gas
												  		</label>
												  		<label  class="block-label">
														<input type="checkbox" name="interests" value="Finance">
												  			Finance
												  		</label>
												  		<label  class="block-label">
														<input type="checkbox" name="interests" value="Pharmaceutical">
												  			Pharmaceutical
												  		</label>
												  		<div class="col button_holder">
															<button type="submit" class="add_new_survey">Submit</button>
													    </div>
												  	</form>
												</div>
											</div>
											<div class="whole-survey company_survey">
												<h4 style="text-align: center;">Rate Your Previous Employers</h4>
												<?php
													echo '<h6 style="text-align: center"> Survey have already been completed for: ';
													$entered = false;
													foreach ($survey_completed as $company_rating_set) {
														if (!empty($company_rating_set['score']))
														{
															$entered = true;
															echo $company_rating_set['company']." ";
														}
													}
													if ($entered == false)
													{
														echo "No surveys completed yet";
													}
													echo "</h6>";
												 ?>
													<form>
														<div class="companies_list">
															<?php 
																foreach ($survey_completed as $company_rating_set) {
																	if (empty($company_rating_set['score']))
																	{
																		echo '<div class="company-block">
																				<h2 style="text-align: center;">'.$company_rating_set['company'].'</h2>
																				<input type="text" hidden name="'.$company_rating_set['company'].'">
																				<div id="'.$company_rating_set['id'].'" class="rateYo"></div>
																			</div>';
																	}
																}
															?>
														</div>
														<div class="col button_holder">
															<button type="submit" class="add_new_survey">Submit</button>
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
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script type="text/javascript">
	$('.option_title').click(function() {
		$('.active').removeClass("active");
		$(this).addClass("active");
		var new_class = "."+$(this).attr("data-combine");
		console.log(new_class);
		$(".curr_view").fadeOut().promise().done(function() {
			$(new_class).fadeIn();
			$(new_class).addClass("curr_view");
		})
	})
	$(function () {
 
  	$(".rateYo").rateYo({
	    starWidth: "20px",
	    halfStar: true
	  });
	});

	$('.survey-button').click(function() {
		var associate ="." + $(this).attr('data-match');
		$('.whole-survey').fadeOut('fast', function() {
			$(".survey-options").fadeOut('fast').promise().done(function() {
				$(associate).fadeIn("fast");
				$(".back").fadeIn("fast");
			})
			
		})
	})

	$('.back').click(function() {
		$(this).fadeOut('fast', function() {
			$('.whole-survey').fadeOut('fast').promise().done(function() {
				$(".survey-options").fadeIn('fast');
			})
		})
		
	})

</script>
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