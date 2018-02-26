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
  $sql = "SELECT questionID FROM exam WHERE examName = '$examName'";
  $result = $conn->query($sql);
  $i = -1;
  $fail = fail;
  $i = -1
  if ($result->num_rows == 0) {
    echo json_encode($fail);
  } elseif ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
      $i++;
      $selection = array(
          $row["questionID"]
      );  
    }
  }
  $count = count($selection);



for($j=0; $j<$count; $j++){
  $sql = "SELECT qName, question, topic, id, difficulty, input, output, cases FROM questionBank WHERE id='$selection[j]'";

  
  $fail = fail;
  $i = -1
  if ($result->num_rows == 0) {
    $output[$i] = $fail;
    echo json_encode($fail);
  } elseif ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
      $i++;
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
}
  echo json_encode($output);
  
  $conn->close();
  
 
?>