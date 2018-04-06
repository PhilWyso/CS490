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
if (isset($_POST['examName'], $_POST['username'])) {
    $examName   = mysqli_real_escape_string($db, $_POST['examName']);
    $username   = mysqli_real_escape_string($db, $_POST['username']);
	$query 	    = "SELECT QuestionList, PointList FROM Exams WHERE ExamName = '$examName';";
	$result     = mysqli_query($db, $query);
	$row        = mysqli_fetch_row($result);
	$id_array   = explode(",", $row[0]);
	$pt_array   = explode(",", $row[1]);

	for ($i=0; $i <= count($id_array) - 1; $i++) {
		$id		  = $id_array[$i];
		$pt		  = $pt_array[$i];
		$id_query = "SELECT * FROM QuestionBank 
                        INNER JOIN StudentAnswers ON QuestionBank.ID = StudentAnswers.ID
                     WHERE StudentAnswers.Username = '$username' 
                        AND QuestionBank.ID = '$id';";
		$id_result = mysqli_query($db, $id_query);

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
            $row_array[$id]['pointWorth']	= $pt;
            $row_array[$id]['teacherNotes'] = $row['TeacherNotes'];
            $row_array[$id]['autoNotes']    = $row['AutoNotes'];
            $row_array[$id]['grade']        = $row['Grade'];
            $row_array[$id]['answer']       = $row['Answer'];
		}
    }
    echo json_encode($row_array);
}
mysqli_close($db);
?>