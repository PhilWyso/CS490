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
if (isset($_POST['examName'], $_POST['username'], $_POST['id'], $_POST['grade'], $_POST['teacherNotes'])){
    $examName     = mysqli_real_escape_string($db,$_POST['examName']);
    $username     = mysqli_real_escape_string($db,$_POST['username']);
    $id           = mysqli_real_escape_string($db,$_POST['id']);
    $grade        = mysqli_real_escape_string($db,$_POST['grade']);
    $teacherNotes = mysqli_real_escape_string($db,$_POST['teacherNotes']);
    
    $query =   "UPDATE StudentAnswers 
                SET Grade = '$grade', TeacherNotes = '$teacherNotes'
                WHERE ExamName = '$examName' AND Username = '$username' AND ID = '$id';";

    if(mysqli_query($db, $query)) { $message = "success"; }
    else { $message = "fail"; }
    echo json_encode($message);
}
mysqli_close($db);
?>