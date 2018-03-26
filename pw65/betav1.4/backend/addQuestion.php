<?php

  //location: njit.edu/~public/cs490/backend/backend.php/
  header("Content-type: application/json; charset=UTF-8");
  $qName = $_POST[functionName];
  $question = $_POST[question];
  $topic = $_POST[topic];
  $difficulty = $_POST[difficulty];
  $cases = $_POST[parameters];
  $input = $_POST[input];
  $output = $_POST[output];
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
  
$sql = "INSERT INTO questionBank(qName, question, topic, difficulty, cases, input, output) 
VALUES ('$qName','$question', '$topic', '$difficulty', '$cases', '$input', '$output')";
  
  
  $fail = fail;
  $success = success;

  
 if ($conn->query($sql) === TRUE) {
    echo json_encode($success);
} else {
    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
}
  $conn->close();
  
 

?>