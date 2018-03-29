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
	$message = "Service Unavailable. Error: " . $e;
	echo json_encode($message);
	exit;
}
if (isset($_POST['searchBy'], $_POST['searchTerm']) {
    $searchBy	= mysqli_real_escape_string($db, $_POST['searchBy']);
    $searchTerm = mysqli_real_escape_string($db, $_POST['searchTerm']);

    if ($searchBy == 'keyword') {
        $query = "SELECT * FROM QuestionBank WHERE Question LIKE '%$searchTerm%';";
    } else {
        $query = "SELECT * FROM QuestionBank WHERE $searchBy = '$searchTerm';";
    }
    $result = mysqli_query($db, $query);
    $data   = "string"; //array();
    
    while($row = mysqli_fetch_assoc($result)) {
        $i = $row['id'];
        $row_array[$i]['id'] 		 = $row['id'];
        $row_array[$i]['topic'] 	 = $row['topic'];
        $row_array[$i]['difficulty'] = $row['difficulty'];
        $row_array[$i]['question'] 	 = $row['question'];
        $row_array[$i]['choice1'] 	 = $row['choice1'];
        $row_array[$i]['choice2'] 	 = $row['choice2'];
        $row_array[$i]['choice3'] 	 = $row['choice3'];
        $row_array[$i]['choice4'] 	 = $row['choice4'];
        $row_array[$i]['cases'] 	 = $row['cases'];
        $row_array[$i]['input'] 	 = $row['input'];
        $row_array[$i]['output'] 	 = $row['output'];
    
        array_push($data,$row_array[$i]);
    }
    echo json_encode($data);
}
mysqli_free_result($result);
mysqli_close($db);
?>