<?php
//Julio "Jay" Arroyo
//CS 490
//Release Candidate

$db_server 	 = "sql1.njit.edu";
$db_username = "ja398";
$db_password = "flJOYDGVq";
$db_name 	 = "ja398";

try { $db = new mysqli($db_server, $db_username, $db_password, $db_name); }
catch (Exception $e) {
	$message = "Service Unavailable. Error: ". $e;
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
	$row_array[$i]['cases'] 	   = $row['Cases'];
	$row_array[$i]['input'] 	   = $row['Input'];
	$row_array[$i]['output'] 	   = $row['Output'];
}
echo json_encode($row_array);
//mysqli_free_result($result);
mysqli_close($db);
?>