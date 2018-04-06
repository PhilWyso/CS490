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
if (isset($_POST['examName'])) {
    $examName = mysqli_real_escape_string($db, $_POST['examName']);
    $examStatus = "Released";
    $query  = "UPDATE ExamList SET ExamStatus = '$examStatus' WHERE ExamName = '$examName';";
    $query2 = "UPDATE Exams SET ExamStatus = '$examStatus' WHERE ExamName = '$examName';";

    if(mysqli_query($db, $query) && mysqli_query($db, $query2) ) { $message = "success"; }
    else { $message = "fail"; }
    echo json_encode($message);
}
mysqli_close($db);
?>