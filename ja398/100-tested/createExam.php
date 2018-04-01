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

 $examName     = mysqli_real_escape_string($db, $_POST['examName']);
 $questionList = mysqli_real_escape_string($db, $_POST['questionList']);
 $pointList    = mysqli_real_escape_string($db, $_POST['pointList']);
 $examStatus = "Assigned";
 
  $students = array();
  $sql1 = "SELECT Username FROM Users WHERE UserStatus='student'";
  $result = $db->query($sql1);
  while($row = $result->fetch_assoc()) { 
      array_push($students, $row['Username']);
    }


  foreach ($students as $studentName){
       $sql3 = "INSERT INTO ExamList(Username, ExamName, ExamStatus)
          VALUES('$studentName', '$examName', '$examStatus')";
          if (!empty($studentName)){//---
              if($db->query($sql3) === TRUE){
                $status = $success;
              } else {
                $status = $fail;
              }
            }//---
          }
  

if (isset($_POST['examName'], $_POST['questionList'], $_POST['pointList'])) {
   
    $examInsert = "INSERT INTO Exams (ExamName, QuestionList, PointList, ExamStatus) 
                   VALUES ('$examName','$questionList','$pointList', '$examStatus');";
                   

    $assignExam = "UPDATE ExamList SET ExamStatus = '$examStatus' WHERE ExamName = '$examName';";
    if(mysqli_query($db, $examInsert) && mysqli_query($db, $assignExam)) { $message = "success"; }
    else { $message = "fail"; }
    echo json_encode($message);
}







mysqli_close($db);
?>