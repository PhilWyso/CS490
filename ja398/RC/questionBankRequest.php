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
$data 	= array();

while($row = mysqli_fetch_assoc($result)) { 
    $row_array['id'] 		   = $row['ID'];
    $row_array['functionName'] = $row['FunctionName'];
    $row_array['topic'] 	   = $row['Topic'];
    $row_array['difficulty']   = $row['Difficulty'];
    $row_array['question'] 	   = $row['Question'];
	$row_array['cases'] 	   = $row['Cases'];
	$row_array['input'] 	   = $row['Input'];
	$row_array['output'] 	   = $row['Output'];

	array_push($data, $row_array);
}
echo json_encode($data);
mysqli_free_result($result);
mysqli_close($db);
?>