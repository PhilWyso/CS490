<?php
  //location: njit.edu/~public/cs490/backend/backend.php/
  header("Content-type: application/json; charset=UTF-8");
 
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
  
  $sql = "SELECT qName, question, topic, id, difficulty, input, output, cases FROM questionBank";
  $result = $conn->query($sql);
  
  $fail = fail;
  $i = -1
  if ($result->num_rows == 0) {
    echo json_encode($fail);
  } elseif ($result->num_rows > 0) {
  	while($row = $result->fetch_assoc()) { 
      $i++;
      $output = array(
       '$i' => (
          'id' => $row["id"];
          'name' = $row["qName"];
          'question' = $row["question"];
          'topic' = $row["topic"];
          'difficulty' = $row["difficulty"];
          'cases' = $row["cases"];
          'input' = $row["input"];
          'output' = $row["output"];
          )
      );
    
      
    }
  }
  echo json_encode($output);
  
  $conn->close();
  
 
?>
