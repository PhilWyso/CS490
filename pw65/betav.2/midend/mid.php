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
		$url = 'afsaccess1.njit.edu/~pw65/cs490/backend/login.php';
		break;
	//------------------------------------------------------------------------
	case 'bankRequest':
		$url = 'afsaccess1.njit.edu/~pw65/cs490/backend/qbRequest.php';
		break;
	//------------------------------------------------------------------------	
	case 'addQuestion':
		$url = 'afsaccess1.njit.edu/~pw65/cs490/backend/addQuestion.php';
		break;
	//------------------------------------------------------------------------
	case 'createTest':
		$url = 'afsaccess1.njit.edu/~pw65/cs490/backend/createExam.php';
		break;
	//------------------------------------------------------------------------
	case 'requestExamList':
		$url = 'afsaccess1.njit.edu/~pw65/cs490/backend/examListRequest.php';
		break;
	//------------------------------------------------------------------------
	case 'requestStudentExamList':
		$url = 'afsaccess1.njit.edu/~pw65/cs490/backend/studentExamListRequest.php';
		break;
	//------------------------------------------------------------------------
	case 'takeExamRequest':
		$url = 'afsaccess1.njit.edu/~pw65/cs490/backend/takeExamRequest.php';
		break;
	//------------------------------------------------------------------------
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
	echo $url;

}





?>