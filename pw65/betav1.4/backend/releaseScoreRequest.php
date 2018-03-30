<?php

  //location: njit.edu/~public/cs490/backend/backend.php/
  header("Content-type: application/json; charset=UTF-8");
  
  $examName = $_POST['examName'];

  $fail = fail;
  $success = success;
  define('dbhost', 'sql2.njit.edu');
  define('dbuser', 'pw65');
  define('dbpass', 'lester86');
  define('dbtable', 'pw65');

  //create connection
  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);
  
  //check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
    $sql2 = "UPDATE StudentExamStatus SET status='released' WHERE examName='$examName'";
    $flag = $conn->query($sql2);
    $sql = "UPDATE exams SET status='released' WHERE examName='$examName'";
  
  	if ($conn->query($sql) === TRUE) {
      echo json_encode($success);
	} else {
   		echo json_encode($fail);
	}
  

?>