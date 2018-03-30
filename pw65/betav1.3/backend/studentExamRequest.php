<?php
 
  header("Content-type: application/json; charset=UTF-8");
 
  define('dbhost', 'sql2.njit.edu');
  define('dbuser', 'pw65');
  define('dbpass', 'lester86');
  define('dbtable', 'pw65');

  $examName = $_POST['examName'];

  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
//Obtain username and status
  $sql = "SELECT username, status FROM StudentExamStatus WHERE examName='$examName'";
  $result = $conn->query($sql);
  
  $fail = fail;
  $tracker = -1;
  if ($result->num_rows == 0) {
    echo json_encode($fail);
  } elseif ($result->num_rows > 0) {
  	while($row = $result->fetch_assoc()) { 
      $tracker++;
      $output[$tracker]['username'] = $row["username"];
      $output[$tracker]['status'] = $row["status"];      
    }
  }

for($i=0;$i<=$tracker;$i++){
  $count=0;
  $user = $output[$i]['username'];
  $sql2 = "SELECT grade FROM answers WHERE username='$user' AND examName='$examName'";
  $result=$conn->query($sql2);
  if ($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      $count++;
      $output[$i]['grade'] = $output[$i]['grade']+$row["grade"];
    }
  }
  $output[$i]['total'] = $count*10;
}

  



 /* $result=$conn->query($sql);
  if ($result->num_rows >0){
    while($row = $result->fetch_assoc()){
      $loopCount++;
      $count++;
      $grade=$grade+$row["grade"]; 
  }
  $count = $count*10;
  $string = $grade."/".$count;
  $output[$j]['grade'] = $string;
  $output[$j]['test'] = $loopCount;
  }+


}
*/
   $conn->close();

  echo json_encode($output);
 
  
 ?>