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
if (isset($_POST['examName'], $_POST['username'], $_POST['id'], $_POST['answer'], $_POST['autoNotes'], $_POST['grade'])) {
    $examName   = mysqli_real_escape_string($db, $_POST['examName']);
    $username   = mysqli_real_escape_string($db, $_POST['username']);
    $id         = mysqli_real_escape_string($db, $_POST['id']);
    $answer     = mysqli_real_escape_string($db, $_POST['answer']);
    $autoNotes  = mysqli_real_escape_string($db, $_POST['autoNotes']);
    $grade      = mysqli_real_escape_string($db, $_POST['grade']);

    $query = "INSERT INTO StudentAnswers (ExamName, Username, ID, Answer, AutoNotes, Grade) 
              VALUES ('$examName','$username','$id','$answer','$autoNotes','$grade');";

    if(mysqli_query($db,$query)) { $message = "success"; }
    else { $message = "fail"; }
}
echo json_encode($message);
mysqli_close($db);
?>