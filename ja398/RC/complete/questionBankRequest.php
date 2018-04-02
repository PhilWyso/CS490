<?php
//Julio "Jay" Arroyo
//CS 490
//Release Candidate

try { $db = new mysqli("sql1.njit.edu", "ja398", "flJOYDGVq", "ja398"); }
catch (Exception $e) {
	$message = "Service Unavailable. Error: " . $e;
	echo json_encode($message);
	exit;
}
$query	= "SELECT * FROM QuestionBank;";
$result	= mysqli_query($db, $query);

while($row = mysqli_fetch_assoc($result)) { 
	$i 							   = $row['ID'];
    $row_array[$i]['functionName'] = $row['FunctionName'];
    $row_array[$i]['topic'] 	   = $row['Topic'];
    $row_array[$i]['difficulty']   = $row['Difficulty'];
    $row_array[$i]['question'] 	   = $row['Question'];
	  $row_array[$i]['parameters'] 	   = $row['Cases'];
  	$row_array[$i]['input'] 	   = $row['Input'];
  	$row_array[$i]['output'] 	   = $row['Output'];
}
echo json_encode($row_array);
//mysqli_free_result($result);
mysqli_close($db);
?>