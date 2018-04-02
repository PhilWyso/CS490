<?php
$array = [];
foreach ($_POST as $key => $value)
{
	switch($key)
	{
		case 'header':
			$array['header'] =$value;
			break;
		case 'username':
			$array['username'] =$value;
			break;
		case 'password':
			$array['password'] =$value;
			break;
		case 'examName':
			$array['examName'] =$value;
			break;
		case 'functionName':
			$array['functionName']=$value;
			break;
		case 'question':
			$array['question']=$value;
			break;
		case 'topic':
			$array['topic'] =$value;
			break;
		case 'difficulty':
			$array['difficulty'] =$value;
			break;
		case 'parameters':
			$array['parameters']=$value;
			break;
		case 'input':
			$array['input'] =$value;
			break;
		case 'output':
			$array['output'] =$value;
			break;
		case 'grade':
			$array['grade'] =$value;
			break;
		case 'maxGrade':
			$array['maxGrade']=$value;
			break;
		case 'question':
			$array['question'] =$value;
			break;	
		case 'cases':
			$array['cases'] =$value;
			break;
		case 'teacherNotes':
			$array['testName'] =$value;
			break;
		case 'status':
			$array['status']=$value;
			break;
		case 'pointWorth':
			$array['pointWorth']=$value;
			break;
		case 'answer':
			$array['answer']=$value;
			break;


/*
		case 'questionList'
			$array['questionList']=$value;
			break;
		case 'pointList'
			$array['pointList']=$value;
			break;

*/		
		default:
			break;
	}
}

$url='';
$flag = false;
switch($array['header'])
{
	//------------------------------------------------------------------------
	case 'login':
		$url = 'afsaccess2.njit.edu/~ja398/CS490/rc/login.php';
		break;
	//------------------------------------------------------------------------
	case 'studentExamReqest':
		$url = 'afsaccess2.njit.edu/~ja398/CS490/rc/studentExamListRequest.php';
		break;
	//------------------------------------------------------------------------	
	case 'takeExamRequest':
		$url = 'afsaccess2.njit.edu/~ja398/CS490/rc/takeExamRequest.php';
		break;
	//------------------------------------------------------------------------





	case 'storeExamRequest':
		break;




	//------------------------------------------------------------------------
	case 'reviewExamRequest':
		$url = 'afsaccess2.njit.edu/~ja398/CS490/rc/reviewExamRequest.php';
		break;
	//------------------------------------------------------------------------
	case 'teacherExamListRequest':
		$url = 'afsaccess2.njit.edu/~ja398/CS490/rc/teacherExamListRequest.php';
		break;
	//------------------------------------------------------------------------
	case 'addQuestionRequest':
		$url = 'afsaccess2.njit.edu/~ja398/CS490/rc/addQuestionRequest.php';
		break;
	//------------------------------------------------------------------------
	case 'questionBankRequest':
		$url = 'afsaccess2.njit.edu/~ja398/CS490/rc/questionBankRequest.php';
		break;	
	case 'createExam':
		$url = 'afsaccess2.njit.edu/~ja398/CS490/rc/createExam.php';
		break;
	case 'examUpdateRequest':
		$url = 'afsaccess2.njit.edu/~ja398/CS490/rc/examUpdateRequest.php';
		break;
	case 'examReleaseRequest':
		$url = 'afsaccess2.njit.edu/~ja398/CS490/rc/examReleaseRequest.php';
		break;

	default:
		$flag = true;
		break;
}


if ($flag != true){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, $url);  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $array);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	$response = curl_exec($curl);	
	curl_close($curl);

	echo $response;
} else 
	echo "Failure: Mid cannot reach ;; $url";
?>
