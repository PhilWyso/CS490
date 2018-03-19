<?php
 
  header("Content-type: application/json; charset=UTF-8");
 
  define('dbhost', 'sql2.njit.edu');
  define('dbuser', 'pw65');
  define('dbpass', 'lester86');
  define('dbtable', 'pw65');

  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);

  $username = $_POST[username];
  $examName = $_POST[examName];
 /* $username = 'student1';
  $examName = 'TestNumber1';*/

 
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

//First obtain and Parse through question ID string in exams
$sql1 = "SELECT idList FROM exams WHERE examName = '$examName'";
$result = $conn->query($sql1);
while($row = $result->fetch_assoc()) {
  $idString = $row["idList"];
}
$idString = str_replace(' ', '', $idString);
$idList = explode(",", $idString);

$output= [];

foreach ($idList as $i){

  $sql2 = "SELECT qName, question, topic, id, difficulty, input, output, cases FROM questionBank WHERE id = '$i'";
  $result = $conn->query($sql2);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) { 
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
  $sql3="SELECT answer, teacherNotes, notes, grade FROM answers WHERE examName = '$examName' AND username = '$username' AND id ='$i'";
  $result =$conn->query($sql3);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
      $output[$i]['answer'] = $row["answer"];
      $output[$i]['teacherNotes'] = $row["teacherNotes"];
      $output[$i]['autoNotes'] = $row["notes"];
      $output[$i]['grade'] = $row["grade"];
    }
  }
}

$conn->close();

echo json_encode($output);

  
 ?>