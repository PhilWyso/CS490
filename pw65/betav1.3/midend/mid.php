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
			$array['functionName'] =$value;
			break;
		case 'topic':
			$array['topic'] =$value;
			break;
		case 'difficulty':
			$array['difficulty'] =$value;
			break;
		case 'input':
			$array['input'] =$value;
			break;
		case 'output':
			$array['output'] =$value;
			break;
		case 'questionList':
			$array['questionList'] =$value;
			break;
		case 'question':
			$array['question'] =$value;
			break;	
		case 'parameters':
			$array['parameters'] =$value;
			break;
		case 'maxGrade':
			$array['maxGrade'] =$value;
			break;
		case 'grade':
			$array['grade'] =$value;
			break;
		case 'teacherNotes':
			$array['teacherNotes'] =$value;
			break;
		case 'id':
			$array['id'] =$value;
			break;
		case 'status':
			$array['status'] =$value;
			break;
		case 'pointWorth':
			$array['pointWorth'] =$value;
			break;
		case 'pointList':
			$array['pointList'] =$value;
		case 'autoNotes':
			$array['pointList'] =$value;

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
		$url = 'afsaccess2.njit.edu/~pw65/release/backend/login.php';
		break;
	//------------------------------------------------------------------------
	case 'questionBankRequest':
		$url = 'afsaccess2.njit.edu/~pw65/release/backend/qbRequest.php';
		break;
	//------------------------------------------------------------------------	
	case 'addQuestionRequest':
		$url = 'afsaccess2.njit.edu/~pw65/release/backend/addQuestion.php';
		break;
	//------------------------------------------------------------------------
	case 'createExam':
		$url = 'afsaccess2.njit.edu/~pw65/release/backend/createExam.php';
		break;
	//------------------------------------------------------------------------
	case "teacherExamListRequest":
		$url = 'afsaccess2.njit.edu/~pw65/release/backend/examList.php';
		break;
	//------------------------------------------------------------------------
	case 'studentExamListRequest':
		$url = 'afsaccess2.njit.edu/~pw65/release/backend/studentExamList.php';
		break;
	//------------------------------------------------------------------------
	case 'takeExamRequest':
		$url = 'afsaccess2.njit.edu/~pw65/release/backend/takeExam.php';
		break;
	//------------------------------------------------------------------------	
	case 'examStudentList':
		$url = 'afsaccess2.njit.edu/~pw65/release/backend/studentExamRequest.php';
		break;
	//------------------------------------------------------------------------
	case 'reviewExamRequest':
		$url = 'afsaccess2.njit.edu/~pw65/release/backend/teacherReviewRequest.php';
		break;
	//------------------------------------------------------------------------	
	case 'examUpdateRequest':
		$url = 'afsaccess2.njit.edu/~pw65/release/backend/examUpdateRequest.php';
		break;
	//------------------------------------------------------------------------
	case 'examReleaseRequest':
		$url = 'afsaccess2.njit.edu/~pw65/release/backend/releaseScoreRequest.php';
		break;
		//------------------------------------------------------------------------
	case 'teacherExamScoreRequest':
		$url='afsaccess2.njit.edu/~pw65/release/backend/teacherExamReviewList.php';
		break;
	//=========================================================================

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
} else {
	$array['url']=$url;
	echo json_encode($array);

}






?>