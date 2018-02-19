<?php

  //location: njit.edu/~public/cs490/backend/backend.php/
  header("Content-type: application/json; charset=UTF-8");
  
  $examName = $_POST[examName];
  $number = $_POST[number];
  $id = $_POST[id];
  $flag = false;

  $fail = fail;
  $success = success;
  define('dbhost', 'sql2.njit.edu');
  define('dbuser', 'pw65');
  define('dbpass', 'lester86');
  define('dbtable', 'pw65');

  //sample logins
  //username || password
  //pw65 || abc
  //test || test
  
  //create connection
  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);
  
  //check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

  }
  for ( $i = 0; $i < $number; i++ ) {
  	$sql = "INSERT INTO exam(examName, questionID) VALUES ('$examName','$id[i]')";
  	$result = $conn->query($sql);

  	if ($conn->query($sql) === TRUE) {
    
	} else {
   		echo json_encode($fail);
   		$flag = true
   		return;
	}


  }
if ($flag == false) {
	echo json_encode($true);
}
  


  
  $fail = fail;
  $success = success;

  
 

?>
