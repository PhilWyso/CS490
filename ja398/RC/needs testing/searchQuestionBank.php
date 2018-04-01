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
if (isset($_POST['keyword'], $_POST['topic'], $_POST['difficulty']) {
    $difficulty = mysqli_real_escape_string($db, $_POST['difficulty']);
    $topic      = mysqli_real_escape_string($db, $_POST['topic']);
    $keyword    = mysqli_real_escape_string($db, $_POST['difficulty']);

    if($difficulty  != '') $query_array[] = "Difficulty = '$difficulty'";
    if($topic       != '') $query_array[] = "Topic = '$topic'";
    if($keyword     != '') $query_array[] = "Question LIKE  = '%$keyword%";
    
    $query_list = implode(" AND ", $query_array);
    $query      = "Select * from assignments WHERE $query_list;";
    $result     = mysqli_query($db, $query);

    while($row = mysqli_fetch_assoc($result)) {
        $i = $row['id'];
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
    
        array_push($row_array);
    }
    echo json_encode($row_array);
}
mysqli_close($db);
?>