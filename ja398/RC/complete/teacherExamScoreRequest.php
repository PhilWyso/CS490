<?php
  header("Content-type: application/json; charset=UTF-8");
  $examName=$_POST['examName'];
 
  define('dbhost', "sql1.njit.edu");
  define('dbuser', "ja398");
  define('dbpass', "flJOYDGVq");
  define('dbtable', "ja398");
  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);
  
 
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "SELECT ExamStatus, Username FROM ExamList WHERE ExamName='$examName'";
  $sql2 = "SELECT PointList FROM Exams WHERE ExamName='$examName'";

  $result=$conn->query($sql2);
  if ($result->num_rows == 0) {
  } elseif ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
      $pointString = $row["PointList"];
    }
  }

  $pointArray = explode(",",$pointString);
  $total = array_sum($pointArray);

  

  $result = $conn->query($sql);
  $fail = fail;
  $i = -1;
  if ($result->num_rows == 0) {
  echo json_encode("3");
  } elseif ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
      $i++;
      $output[$i]['username'] = $row["Username"];
      $output[$i]['status'] = $row["ExamStatus"];
      $output[$i]['total'] = $total;
    }
  }
 

  for($j =0; $j <= $i; $j++){
    $username = $output[$j]['username'];
    $sql3 ="SELECT grade FROM StudentAnswers WHERE ExamName='$examName' AND Username='$username'";
    $result = $conn->query($sql3);
    $grade=0;
    while($row = $result->fetch_assoc()) { 
      $output[$j]['grade'] = $grade+$row['grade'];
    }
  }
  
  echo json_encode($output);
  
  $conn->close();
  
 ?>