<?php
  header("Content-type: application/json; charset=UTF-8");

  $username=$_POST['username'];
 
  define('dbhost', 'sql2.njit.edu');
  define('dbuser', 'pw65');
  define('dbpass', 'lester86');
  define('dbtable', 'pw65');

  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);
  
 
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "SELECT examName, status FROM StudentExamStatus WHERE username='$username'";
  $result = $conn->query($sql);
  
  $fail = fail;
  $i = 0;
  if ($result->num_rows == 0) {
    echo json_encode($fail);
  } elseif ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
      $i++;
      $output[$i]['examName'] = $row["examName"];
      $output[$i]['status'] = $row["status"];
    }
  }
  echo json_encode($output);
  
  $conn->close();
  
 ?>