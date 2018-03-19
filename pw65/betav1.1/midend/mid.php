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
		case 'qName':
			$array['qname'] =$value;
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
		case 'cases':
			$array['cases'] =$value;
			break;
		case 'testName':
			$array['testName'] =$value;
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
		$url = 'afsaccess2.njit.edu/~pw65/cs490/backend/login.php';
		break;
	//------------------------------------------------------------------------
	case 'bankRequest':
		$url = 'afsaccess2.njit.edu/~pw65/cs490/backend/qbRequest.php';
		break;
	//------------------------------------------------------------------------	
	case 'addQuestion':
		$url = 'afsaccess2.njit.edu/~pw65/cs490/backend/addQuestion.php';
		break;
	//------------------------------------------------------------------------
	case 'createTest':
		$url = 'afsaccess2.njit.edu/~pw65/cs490/backend/createExam.php';
		break;
	//------------------------------------------------------------------------
	case 'requestExamList':
		$url = 'afsaccess2.njit.edu/~pw65/cs490/backend/examList.php';
		break;
	//------------------------------------------------------------------------
	case 'requestStudentExamList':
		$url = 'afsaccess2.njit.edu/~pw65/cs490/backend/studentExamList.php';
		break;
	//------------------------------------------------------------------------
	case 'takeExamRequest':
		$url = 'afsaccess2.njit.edu/~pw65/cs490/backend/takeExam.php';
		break;
	//------------------------------------------------------------------------	
	case 'examStudentList':
		$url = 'afsaccess2.njit.edu/~pw65/cs490/backend/studentExamRequest.php';
		break;
	//------------------------------------------------------------------------
	case 'teacherReviewRequest':
		$url = 'afsaccess2.njit.edu/~pw65/cs490/backend/teacherReviewRequest.php';
		break;
	//------------------------------------------------------------------------	
	case 'examUpdateRequest':
		$url = 'afsaccess2.njit.edu/~pw65/cs490/backend/examUpdateRequest.php';
		break;
	//------------------------------------------------------------------------
	case 'releaseScore':
		$url = 'afsaccess2.njit.edu/~pw65/cs490/backend/releaseScoreRequest.php';
		break;
		//------------------------------------------------------------------------
	case 'requestTeacherExamList':
		$url='afsaccess2.njit.edu/~pw65/cs490/backend/teacherExamReviewList.php';
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