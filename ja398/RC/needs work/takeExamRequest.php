<?php
//Julio "Jay" Arroyo
//CS 490
//March 5, 2018

$db_server 		= "sql1.njit.edu";
$db_username 	= "ja398";
$db_password 	= "flJOYDGVq";
$db_name 		= "ja398";

//Clears the ExamQuestions Table in case you need to remove all the questions. Will be modified to allow removing one question as well.

//Mysqli(server, username, password, database)
try { $db = new mysqli($db_server, $db_username, $db_password, $db_name); }
catch (Exception $e) {
	$message = "Service Unavailable. Error: " . $e;
	echo json_encode($message);
	exit;
}
$query = "DELETE * FROM ExamQuestions;";
$result = mysqli_query($db,$query);
$message = "Exam Clear Successful: " . mysqli_affected_rows($db) . " rows affected.";
echo json_encode($message);
mysqli_close($db);