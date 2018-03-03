<?php
 
  header("Content-type: application/json; charset=UTF-8");
 
  define('dbhost', 'sql2.njit.edu');
  define('dbuser', 'pw65');
  define('dbpass', 'lester86');
  define('dbtable', 'pw65');

  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);
  
 
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "SELECT qName, question, topic, id, difficulty, input, output, cases FROM questionBank";
  $result = $conn->query($sql);
  
  $fail = fail;
  
  if ($result->num_rows == 0) {
    echo json_encode($fail);
  } elseif ($result->num_rows > 0) {
  	while($row = $result->fetch_assoc()) { 
      $i = $row["id"];
      $output[$i]['id'] = $row["id"];
      $output[$i]['qName'] = $row["qName"];
      $output[$i]['question'] = $row["question"];
      $output[$i]['topic'] = $row["topic"];
      $output[$i]['difficulty'] = $row["difficulty"];
      $output[$i]['cases'] = $row["cases"];
      $output[$i]['input'] = $row["input"];
      $output[$i]['output'] = $row["output"];
      
    }
  }
  echo json_encode($output);
  
  $conn->close();
  
 ?>