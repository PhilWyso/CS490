<?php
//Julio "Jay" Arroyo
//CS 490
//Release Candidate

$db_server 	 = "sql1.njit.edu";
$db_username = "ja398";
$db_password = "flJOYDGVq";
$db_name 	 = "ja398";

try { $db = new mysqli($db_server, $db_username, $db_password, $db_name); }
catch (Exception $e) {
	$message = "Service Unavailable. Error: " . $e;
	echo json_encode($message);
	exit;
}
$functionName = mysqli_real_escape_string($db,$_POST['functionName']);
$topic 		  = mysqli_real_escape_string($db,$_POST['topic']);
$difficulty   = mysqli_real_escape_string($db,$_POST['difficulty']);
$question 	  = mysqli_real_escape_string($db,$_POST['question']);
$cases 		  = mysqli_real_escape_string($db,$_POST['cases']);
$input 		  = mysqli_real_escape_string($db,$_POST['input']);
$output 	  = mysqli_real_escape_string($db,$_POST['output']);

$query = "INSERT INTO QuestionBank (FunctionName, Topic, Difficulty, Question, Cases, Input, Output) 
			VALUES ('$functionName','$topic','$difficulty','$question','$cases','$input','$output');";

if(mysqli_query($db,$query)) { $message = "success"; }
else { $message = "fail"; }

echo json_encode($message);
mysqli_free_result($result);
mysqli_close($db);
?>