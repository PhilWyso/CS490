<?php
//Julio "Jay" Arroyo
//CS 490
//March 5, 2018

$db_server 		= "sql1.njit.edu";
$db_username 	= "ja398";
$db_password 	= "flJOYDGVq";
$db_name 		= "ja398";

//This php file allows you to either receive one correct answer from the table's answer key or to receive all of them.
//Provide the title of the question to get the answer to that question in an array
//OR just call the file to get all of the answers in an array.

//Mysqli(server, username, password, database)
try { $db = new mysqli($db_server, $db_username, $db_password, $db_name); }
catch (Exception $e) {
	$message = "Service Unavailable. Error: " . $e;
	echo json_encode($message);
	exit;
}
//if (isset($_POST['title'])) {
	$title	= mysqli_real_escape_string($db,$_POST['title'];
	$query	= "SELECT Answer FROM ExamQuestions WHERE Title='$title';";
//} else { $query	= "SELECT Answer FROM ExamQuestions;"; }

$result	= mysqli_query($db,$query);
$data 	=  array();

while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
echo json_encode($data);
mysqli_close($db);
?>