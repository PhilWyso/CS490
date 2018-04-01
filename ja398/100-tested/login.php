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
if (isset($_POST['username'], $_POST['password'])) {
	$username = mysqli_real_escape_string($db,$_POST['username']);
    $password = mysqli_real_escape_string($db,$_POST['password']); 
	$query 	  = "SELECT `UserStatus` FROM `Users` WHERE Username = '$username' and Password = '$password';";
	$result   = mysqli_query($db,$query);
	$count 	  = mysqli_num_rows($result);
	
	//If matched, must be one (1) row and returns 'teacher' or 'student', else 'fail'.
    if($count == 1) { $message = mysqli_fetch_row($result); }
	else { $message = "fail"; }

	echo json_encode($message);
	//mysqli_free_result($result);
	mysqli_close($db);
}
?>