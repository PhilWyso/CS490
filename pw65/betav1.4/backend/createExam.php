<?php

  //location: njit.edu/~public/cs490/backend/backend.php/
  header("Content-type: application/json; charset=UTF-8");
  
  $examName = $_POST[examName];
  $idList = $_POST[questionList];

  
  $fail = fail;
  $success = success;
  define('dbhost', 'sql2.njit.edu');
  define('dbuser', 'pw65');
  define('dbpass', 'lester86');
  define('dbtable', 'pw65');


  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);
  
  //check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  //obtaining list of student usernames
  $students = array();
  $sql1 = "SELECT username FROM user WHERE type='student'";
  $result = $conn->query($sql1);

  while($row = $result->fetch_assoc()) { 
      array_push($students, $row['username']);
    }
  

  $sql2 = "INSERT INTO exams(examName, status, idList)
  VALUES('$examName', 'assigned', '$idList')";
 
  //Creates in database the exam question information, and a status for each student for wether or not they completed the exam, and if its released.
  if ($conn->query($sql2) === TRUE) {

        foreach ($students as $studentName){//***

          $sql3 = "INSERT INTO StudentExamStatus(username, examName, status)
          VALUES('$studentName', '$examName', 'assigned')";
          if (!empty($studentName)){//---
              if($conn->query($sql3) === TRUE){
                $status = $success;
              } else {
                $status = $fail;
              }
            }//---
          }//***
  } else {
   	$status = $fail;
	}
      echo json_encode($status);

 

?>