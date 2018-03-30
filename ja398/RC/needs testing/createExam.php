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
if (isset($_POST['examName'])) {
	$examName = mysqli_real_escape_string($db, $_POST['examName'];
	$query 	= "SELECT QuestionList FROM Exams WHERE ExamName = '$examName';";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_row($result);
	$id_array = explode(",", $row[0]);
	foreach ($id_array as $id) {
		$id_query 	= "SELECT * FROM QuestionBank WHERE ID = '$id';";
		$id_result = mysqli_query($db, $query);
		while ($row = mysqli_fetch_assoc($id_result)) {
			$i 							   = $row['ID'];
			$row_array[$i]['functionName'] = $row['FunctionName'];
			$row_array[$i]['topic'] 	   = $row['Topic'];
			$row_array[$i]['difficulty']   = $row['Difficulty'];
			$row_array[$i]['question'] 	   = $row['Question'];
			$row_array[$i]['cases'] 	   = $row['Cases'];
			$row_array[$i]['input'] 	   = $row['Input'];
			$row_array[$i]['output'] 	   = $row['Output'];
			$row_array[$i]['pointWorth']   = $row['PointWorth'];
		}
	}
	echo json_encode($row_array);
	//mysqli_free_result($result);
}
mysqli_close($db);
?>
	