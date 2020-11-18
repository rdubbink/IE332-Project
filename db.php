<?php
//define constants for db_host, db_user, db_pass, and db_database
//adjust the values below to match your database settings
session_start();
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root'); //set DB_PASS as 'root' if you're using mac
define('DB_DATABASE', 'boilermatch'); //make sure to set your database
require './vendor/autoload.php';
use TeamTNT\TNTSearch\TNTSearch;

$tnt = new TNTSearch;

$tnt->loadConfig([
    'driver'    => 'mysql',
    'host'      => DB_HOST,
    'database'  => DB_DATABASE,
    'username'  => DB_USER,
    'password'  => DB_PASS,
    'storage'   => __DIR__.'/',
    'stemmer'   => \TeamTNT\TNTSearch\Stemmer\PorterStemmer::class
]);

$indexer = $tnt->createIndex('name.index');
$indexer->query('SELECT id, title FROM jobs;');$indexer->run();



//connect to database host
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

//make sure connection is good or die
if ($connection->connect_errno) 
{
    die("Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error);
}

function get_specific_job_info($job_id)
{
	$student_id = $_SESSION['student']['id'];
	$class_match_array = ["Freshman", "Sophomore", "Junior", "Senior"];
	$query = "SELECT jobs.id, jobs.title, jobs.location, jobs.description, jobs.academic_classification, jobs.industry, jobs.minimum_gpa, employers.company, employers.company_logo, group_concat(courses.name) as courses FROM jobs LEFT JOIN required_courses on jobs.id = required_courses.job_id LEFT JOIN courses on required_courses.course_id = courses.id INNER JOIN employers on employers.id = jobs.employer_id where jobs.id='{$job_id}' GROUP BY jobs.id, jobs.title, jobs.academic_classification, jobs.location, jobs.minimum_gpa, jobs.description, jobs.industry, employers.company, employers.company_logo";
	$record = fetch_record($query);
	$record['academic_classification'] = $class_match_array[(int)$record['academic_classification'] - 1];

	$record['match_value'] = calculate_match($record['courses'], $record['academic_classification'], $record['minimum_gpa'], $record['industry'], $record['company']);
	return $record;
}

 /*
	name: get_work_is_survey_completed
	params: None
	return value: Boolean
	description: This function is used to determine whether or not a student has taken the survey to rate their past employers. The function will return true if there is a rating for all the students past employers. Otherwise it will return false.
 */
function get_work_is_survey_completed()
{
	//select the work experiences and find the corresponding rating if available
	$student_id = $_SESSION['student']['id'];
	$query = "SELECT work_experience.company, employers.id, score from work_experience LEFT JOIN employers on employers.company = work_experience.company LEFT JOIN ratings on employers.id = ratings.employer_id where work_experience.student_id = '{$student_id}' GROUP BY work_experience.company, employers.id, score";
	$rating_records = fetch_all($query);
	return $rating_records;
}

 /*
	name: get_courses
	params: None
	return value: Array of courses
	description: This function is used to retrieve all the courses that can be specified as required by employers or regarded as taken by students.
 */
function get_courses()
 {
 	return fetch_all("SELECT * FROM courses");
 }

 /*
	name: get_jobs
	params: None
	return value: Array of jobs
	description: This function is used to retrieve all the jobs for a specific employer.
 */
 function get_jobs()
 {
 	$id = $_SESSION['employer']['id'];
 	return fetch_all("SELECT * FROM jobs where employer_id = {$id} ORDER BY id DESC");
 }

 /*
	name: cmp
	params:
		$a -> first item to be compared
		$b -> item to be compared against
	return value: -1, 0 or 1
	description: This function is used to compare two elements by the uasort() method, which also takes an array. Elements in the array are compared to each other user the function, which is used to sort whatever array it is associated with in descending order.

 */
 function cmp($a, $b) {
    if ($a['match_value'] == $b['match_value']) {
        return 0;
    }
    return ($a['match_value'] < $b['match_value']) ? 1 : -1;
}

/* 
	name: get_job_matches
	params: 
		$id -> The id of the student of which to find jobs for
	return value: NONE
	description: This function serves the purpose of retrieving all the available jobs for a particular student and creating match values for each job in terms of how well a particular student qualifies for said job. The match will be based on the students work eperience, courses taken, gpa and academic class. 

	TODO: There will be an implementation of a more intricate matching algorithm. Job experiences with a requirement of sophomore class or greater will have work experience represent 30% of the match score. The 30% will factor in how much jobs as person has had as well as the similarity in industries between previous jobs and the current position being applied for.
 */
function get_job_matches($id)
{
	$class_matcher = array("Freshman", "Sophomore", "Junior", "Senior");
	//Get all available jobs
	$query  = "SELECT jobs.id, jobs.title, jobs.location, jobs.description, jobs.academic_classification, jobs.industry, jobs.minimum_gpa, employers.company, employers.company_logo, group_concat(courses.name) as courses FROM jobs LEFT JOIN required_courses on jobs.id = required_courses.job_id LEFT JOIN courses on required_courses.course_id = courses.id LEFT JOIN employers on employers.id = jobs.employer_id GROUP BY jobs.id, jobs.title, jobs.academic_classification, jobs.location, jobs.minimum_gpa, jobs.description, jobs.industry, employers.company, employers.company_logo;";
	$all_jobs = fetch_all($query);

	

	foreach ($all_jobs as $key => $value) {
		
		$all_jobs[$key]['match_value'] =  calculate_match($value['courses'], $value['academic_class'], $value['minimum_gpa'], $value['industry'], $value['company']);

	}
	uasort($all_jobs, 'cmp');
	return $all_jobs;

}

function calculate_match($courses, $classification, $minimum_gpa, $industry, $company)
{
	$student_id = $_SESSION['student']['id'];
	$student_gpa = $_SESSION['student']['gpa'];
	$student_class = $_SESSION['student']['academic_class'];
	//Get student work experience
	$query = "SELECT work_experience.company, work_experience.industry FROM work_experience WHERE student_id = '{$student_id}'";
	$work_experience = fetch_all($query);

	//Create an array consisting of the unique industries this student has worked in
	$worked_industries = array_count_values(array_map(function($array){ return $array['industry'];}, $work_experience));

	//Create an array consisting of the unique companies this student has worked in
	$worked_companies = array_unique(array_map(function($array){ return strtolower($array['company']);}, $work_experience));
	//Get student courses
	$query = "SELECT taken_courses.course_name FROM taken_courses WHERE student_id = '{$student_id}'";
	$taken_courses = fetch_all($query);
	$taken_courses = array_map(function($array){ return $array['course_name'];}, $taken_courses);

		$match = 0;
		$required_courses_for_job = explode(",", $courses);

		//Courses are a preparation for a type of work, so they'll account for 50% of the match
		$number_of_required_courses = sizeof($required_courses_for_job);
		if (!empty($courses))
		{
			$class_match_increments = 50 / $number_of_required_courses;
			foreach ($required_courses_for_job as $class) {
				if (in_array($class, $taken_courses))
				{
					$$match += $class_match_increments;
				}
			}
		}
		else {
			$match += 50;
		}

		//Gpa accounts for 15%
		if ((float)$student_gpa >= (float)$minimum_gpa)
		{
			$match += 15;
		}
		else {
			//If you don't meet the minimum gpa, you will be capped at 75% of the 15 match points
			$match += 0.75 * 15 * (float)$student_gpa / (float)$minimum_gpa;
		}
	
		//Academic class accounts for 10%
		if ((float)$student_class >= (float)$classification)
		{
			$match += 10;
		}
		else {
			//If you don't meet the minimum class, you will be capped at 75% of the 10 match points
			$match += 0.75 * 10 * (float)$student_class / (float)$classification;
		}
		

		if (isset($worked_industries[$industry]))
		{
			//The student will receive 15 extra match points for the number of jobs they have worked in the same industry
			$match += $worked_industries[$industry] * 15; 
		}

		if (in_array($company, $worked_companies))
		{
			//If the student has previously worked at the company, 10 extra match points
			$match += 10;
		}

		//Make sure to cap the match at 100%
		if ($match > 100)
		{
			$match = 100;
		}
		return round($match, 2);
}

 /* 
	name: get_employee_matches
	params: 
		$id -> The id of the job for which student matches will be retrieved
	return value: 
		TYPE: Array
		Value: Students
	description: 
		This function serves the purpose of getting all of the students in the database and giving them match score based on the requirements of this particular job. The match algorithm is currently as follows: 50% of the match is allocated to required courses for the job. If there are 5 courses, then each course will be worth 10%. Each course weight is therefore 50%/n where n is the number of required courses. Gpa accounts for 30% of the match and academic class accounts for 20% of the match. If the gpa of a student is less than the required gpa of the job, a simple percentage factor is utilized instead. This is the same process for academic classification.

	TODO: There will be an implementation of a more intricate matching algorithm. Job experiences with a requirement of sophomore class or greater will have work experience represent 30% of the match score. The 30% will factor in how much jobs as person has had as well as the similarity in industries between previous jobs and the current position being applied for.
 */
 function get_employee_matches($id)
 {
 	/*Get the required information for a specific job */
 	$class_matcher = array("Freshman", "Sophomore", "Junior", "Senior");
 	$job_info_query = "SELECT jobs.academic_classification, jobs.minimum_gpa, group_concat(courses.name) as required_class from jobs inner join required_courses on required_courses.job_id = jobs.id inner join courses on courses.id  = required_courses.course_id where jobs.id = '{$id}'";
 	$job_info = fetch_record($job_info_query);
 	$required_classes = explode(",", $job_info['required_class']);
 	$class_increments = 50 / sizeof($required_classes);

 	//Get all the required courses for a job and group them together
 	$required_courses_for_job = "SELECT courses.name as course_name from required_courses INNER JOIN courses on required_courses.course_id = courses.id where required_courses.job_id = '{$id}'";


 	//Get all the students from DB and group them with their taken courses
 	$candidates_query = "SELECT students.id, students.first_name, students.last_name, students.profile_image, students.email, students.academic_class, students.gpa, students.description, group_concat(taken_courses.course_name) as courses_taken  FROM boilermatch.students inner join taken_courses on taken_courses.student_id = students.id GROUP by students.id";
 	$candidates = fetch_all($candidates_query);

 	//Calculate match score
 	foreach ($candidates as $key => $value) {
 		$candidates[$key]['match_value'] = 0;
 		$candidates[$key]['courses_taken'] = explode(",", $candidates[$key]['courses_taken']);
 		foreach ($candidates[$key]['courses_taken'] as $value) {
 			if(in_array($value, $required_classes)) {
 				$candidates[$key]['match_value'] += $class_increments;
 			}
 		}
 		if ((float)$candidates[$key]['gpa'] >= (float)$job_info['minimum_gpa'])
 		{
 			$candidates[$key]['match_value'] += 30;
 		}
 		else
 		{
 			$candidates[$key]['match_value'] += (float)$candidates[$key]['gpa'] / (float)$job_info['minimum_gpa'] * 30;
 		}

 		if ((float)$candidates[$key]['academic_class'] >= (float)$job_info['academic_classification'])
 		{
 			$candidates[$key]['match_value'] += 20;
 		}
 		else
 		{
 			$candidates[$key]['match_value'] += (float)$candidates[$key]['academic_class'] / (float)$job_info['academic_classification'] * 20;
 		}
 		$candidates[$key]['match_value'] = round($candidates[$key]['match_value'], 2);
 		$candidates[$key]['academic_class'] = $class_matcher[$candidates[$key]['academic_class'] - 1];
 	}
 	uasort($candidates, 'cmp');
 	//Add a property to the array for matches and sort the array based on the match value
 	//Criteria
 	//Courses form the basis of matching, and accounts for 50%, least flexibility
 	//Gpa accounts for 30%, more flexibility
 	//Academic class accounts for 20%, Most flexibility
 	return $candidates;
 }

//used when expecting multiple results
function fetch_all($query)
{
	$data = array();
	global $connection;
	$result = $connection->query($query);
	 
	//while($row = $result->fetch_assoc())
	while($row = mysqli_fetch_assoc($result)) 
	{
		$data[] = $row;
	}
	return $data;
}

//use when expecting a single result
function fetch_record($query)
{
	global $connection;
	$result = $connection->query($query);
	return mysqli_fetch_assoc($result);
	//return $result->fetch_assoc();
}

//use to run INSERT/DELETE/UPDATE, queries that don't return a value
//notice this function returns a value.  This value will be equal to the ID of the most recent query item 
//ran by your PHP code.
function run_mysql_query($query)
{
	global $connection;
 	$result = $connection->query($query);
 	return $result;
}

//This function will return an escaped string.  IE the string "That's crazy!" Will be returned as:
// "That\'s crazy!...This helps secure your database!
function escape_this_string($string)
{
	global $connection;
	return $connection->real_escape_string($string);
}


?>