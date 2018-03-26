<?php

  //location: njit.edu/~public/cs490/backend/backend.php/
  header("Content-type: application/json; charset=UTF-8");
  
  $examName = $_POST['examName'];
  $id = $_POST['id'];
  $username = $_POST['username'];
  $teacherNotes = $_POST['teacherNotes'];
  $grade =$_POST['grade'];

  $array[examName] = $_POST['examName'];
  $array[id] = $_POST['id'];
  $array[username] = $_POST['username'];
  $array[teacherNotes] = $_POST['teacherNotes'];
  $array[grade] =$_POST['grade'];


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
    $sql = "UPDATE answers SET teacherNotes='$teacherNotes', grade='$grade' WHERE username='$username' AND examName='$examName' AND id='$id'";

  	if ($conn->query($sql) === TRUE) {
      echo json_encode($array);
	} else {
   		echo json_encode($fail);
	}
  

?>

