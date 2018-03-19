<?php
//Julio "Jay" Arroyo
//CS 490
//March 5, 2018

$db_server 		= "sql1.njit.edu";
$db_username 	= "ja398";
$db_password 	= "flJOYDGVq";
$db_name 		= "ja398";

//QuestionBank Columns: QuestionID, Qtype, Difficulty, Title, QPrompt, Choice1, Choice2, Choice3, Choice4, Answer
//The below query(s) will update the question based on the title, or add the question if it doesn't exist
//Qtype determines if how choice1-4 will be used, MC must have 4 choices, TF uses True/False, OE has none

/*
if (isset(  $_POST['title']
		  , $_POST['qprompt']
		  , $_POST['qtype']
		  , $_POST['difficulty']
		  , $_POST['answer'])) { */
	try { $db = new mysqli($db_server, $db_username, $db_password, $db_name); }
	catch (Exception $e) {
		$message = "Service Unavailable. Error: " . $e;
		echo json_encode($message);
		exit;
	}
	$qtype 		= mysqli_real_escape_string($db,$_POST['qtype']);
	$difficulty = mysqli_real_escape_string($db,$_POST['difficulty']);
	$title 		= mysqli_real_escape_string($db,$_POST['title']);
	$qprompt 	= mysqli_real_escape_string($db,$_POST['QPrompt']);
	$answer 	= mysqli_real_escape_string($db,$_POST['answer']);
	$true		= "True";
	$false		= "False";
	
	if ($qtype == 'MC') {
		$choice1 = mysqli_real_escape_string($db,$_POST['choice1']);
		$choice2 = mysqli_real_escape_string($db,$_POST['choice2']);
		$choice3 = mysqli_real_escape_string($db,$_POST['choice3']);
		$choice4 = mysqli_real_escape_string($db,$_POST['choice4']);
		$query = 
		"INSERT INTO QuestionBank (QType, Difficulty, Title, QPrompt, Choice1, Choice2, Choice3, Choice4, Answer) 
		VALUES 
		('$qtype'
  		,'$difficulty'
  		,'$title'
  		,'$qprompt'
  		,'$choice1'
  		,'$choice2'
  		,'$choice3'
  		,'$choice4'
  		,'$answer')
  		ON DUPLICATE KEY UPDATE
			  QType='$qtype'
      		, Difficulty='$difficulty'
  	  		, QPrompt='$qprompt'
  	  		, choice1='$choice1'
  	  		, choice2='$choice2'
  	  		, choice3='$choice3'
  	  		, choice4='$choice4'
  	  		, Answer='$answer'; ";
		mysqli_query($db,$query);
		$message = "Multiple Choice Add/Update Successful: " . mysqli_affected_rows($db) . " rows affected.";

	} elseif ($qtype == 'TF') {
		$choice1 = $true;
		$choice2 = $false;
		$query = 
		"INSERT INTO QuestionBank (QType, Difficulty, Title, QPrompt, Choice1, Choice2, Answer) 
		VALUES 
		('$qtype'
  		,'$difficulty'
  		,'$title'
  		,'$qprompt'
  		,'$choice1'
  		,'$choice2'
  		,'$answer')
  		ON DUPLICATE KEY UPDATE
			  QType='$qtype'
      		, Difficulty='$difficulty'
  	  		, QPrompt='$qprompt'
  	  		, choice1='$choice1'
  	  		, choice2='$choice2'
			, Answer='$answer'; ";
		  //, choice3=NULL
		  //, choice4=NULL	
		mysqli_query($db,$query);
		$message =  "True or False Question Add/Update Successful: " . mysqli_affected_rows($db) . " rows affected.";

	} elseif ($qtype == 'OE') {
		$query = 
		"INSERT INTO QuestionBank (QType, Difficulty, Title, QPrompt, Answer) 
		VALUES 
		('$qtype'
  		,'$difficulty'
  		,'$title'
  		,'$qprompt'
  		,'$answer')
  		ON DUPLICATE KEY UPDATE
			  QType='$qtype'
      		, Difficulty='$difficulty'
  	  		, QPrompt='$qprompt'
			, Answer='$answer'; ";
		  //, choice1=NULL
		  //, choice2=NULL	
		  //, choice3=NULL
		  //, choice4=NULL	
		mysqli_query($db,$query);
		$message = "Open-Ended Question Add/Update Successful: " . mysqli_affected_rows($db) . " rows affected.";

	} else {
		$message = "ADD/UPDATE FAIL";
	}
	echo json_encode($message);
	mysqli_close($db);
//}
?>