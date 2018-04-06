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
if (isset($_POST['id'])) {
    $id     = mysqli_real_escape_string($db, $_POST['id']);
    $query  = "DELETE FROM QuestionBank WHERE ID = '$id';";

    if(mysqli_query($db, $query)) { $message = "success"; }
    else { $message = "fail"; }

    echo json_encode($message);
}
mysqli_close($db);
?>