<?php

  //location: njit.edu/~public/cs490/backend/backend.php/
  header("Content-type: application/json; charset=UTF-8");
  $username = $_POST[username];
  $password = $_POST[password];
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
  
  $sql = "SELECT username, password, type FROM user WHERE username='$username' and password='$password'";
  
  $result = $conn->query($sql);

  
  $fail = fail;

  
  if ($result->num_rows == 0) { //user doesnt exist
    echo json_encode($fail);
    //output data of each row
 
  } elseif ($result->num_rows > 0) {
  	while($row = $result->fetch_assoc()) { 
      echo json_encode($row['type']);
    }
  }
  
  $conn->close();
  
 

?>
