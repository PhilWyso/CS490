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
	$examName 	= mysqli_real_escape_string($db, $_POST['examName']);
	$query 		= "SELECT QuestionList, PointList FROM Exams WHERE ExamName = '$examName';";
	$result		= mysqli_query($db, $query);
	$row 		= mysqli_fetch_row($result);
	$id_array 	= explode(",", $row[0]);
	$pt_array 	= explode(",", $row[1]);
	$j 			= 0;

	foreach ($id_array as $id) {
		$id_query 	= "SELECT * FROM QuestionBank WHERE ID = '$id';";
		$id_result = mysqli_query($db, $query);

		while ($row = mysqli_fetch_assoc($id_result)) {
			$id 						    = $row['ID'];
			$row_array[$id]['id']		    = $row['ID'];
			$row_array[$id]['functionName'] = $row['FunctionName'];
			$row_array[$id]['topic'] 	    = $row['Topic'];
			$row_array[$id]['difficulty']   = $row['Difficulty'];
			$row_array[$id]['question'] 	= $row['Question'];
			$row_array[$id]['cases'] 	    = $row['Cases'];
			$row_array[$id]['input'] 	    = $row['Input'];
			$row_array[$id]['output'] 	    = $row['Output'];
			$row_array[$id]['pointWorth']	= $pt_array[$j];
			$j++;
		}
	}
	echo json_encode($row_array);
}
mysqli_close($db);
?>
	