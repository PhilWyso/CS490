<?php
//Julio "Jay" Arroyo
//CS 490
//Release Candidate

try { $db = new mysqli("sql1.njit.edu", "ja398", "flJOYDGVq", "ja398"); }
catch (Exception $e) {
	$message = "Service Unavailable. Error: " . $e;
	echo json_encode($message);
	exit;
}
$functionName = mysqli_real_escape_string($db, $_POST['functionName']);
$topic 		  = mysqli_real_escape_string($db, $_POST['topic']);
$difficulty   = mysqli_real_escape_string($db, $_POST['difficulty']);
$question 	  = mysqli_real_escape_string($db, $_POST['question']);
$parameters   = mysqli_real_escape_string($db, $_POST['parameters']);
$input 		  = mysqli_real_escape_string($db, $_POST['input']);
$output 	  = mysqli_real_escape_string($db, $_POST['output']);

$query = "INSERT INTO QuestionBank (FunctionName, Topic, Difficulty, Question, Cases, Input, Output) 
		  VALUES ('$functionName','$topic','$difficulty','$question','$parameters','$input','$output');";

if(mysqli_query($db, $query)) { $message = "success"; }
else { $message = "fail"; }

echo json_encode($message);
mysqli_close($db);
?>