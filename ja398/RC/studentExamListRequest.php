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
if(isset($_POST['username'])) {
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$query	  = "SELECT ExamName, ExamStatus FROM ExamList WHERE Username = '$username';";
	$result	  = mysqli_query($db, $query);
	$data 	  = array();

	while($row = mysqli_fetch_assoc($result)) { 
		$row_array['examName'] = $row['examName'];
		$row_array['status']   = $row['status'];
	
		array_push($data, $row_array);
	}
	echo json_encode($data);
}
mysqli_close($db);
?>