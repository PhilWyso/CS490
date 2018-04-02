<?php
//middleend will be recieving each question individually, and the backend will be storing each question answer individually
//What middleend obtains
$username = $_POST['username'];			//username
$examName = $_POST['examName'];			//examName
$functionName = $_POST['functionName'];		//required name of function
$topic = $_POST['topic'];				//question topic
$parametersRaw = str_replace(' ', '',$_POST['parameters']);			//raw case string seperated by commas, str_replace removes spaces
$inputRaw = str_replace(' ', '',$_POST['input']);			//raw input string seperated by commas and colons
$outputRaw = str_replace(' ', '',$_POST['output']);			//raw case string seperated by commas
$answer = $_POST['answer'];				//student coding answer
$id = $_POST['id'];						//question ID
$maxGrade = $_POST['maxGrade'];
//==============================================================
$notes="";
$grade="0"; //assume grade is out of 10 points, I haven't put in the actual field for putting in a grade yet when creating the question.
$cases=explode(",",$casesRaw); //turns into array with [0] containing the string for the first case, [1] the second, [2] etc...etc.
$input=explode(":",$inputRaw); //turns into array, which divides up the inputs. input[0] corresponds to output[0] and so on.
$output=explode(":",$outRaw); //turns into array, which divides into sample outputs.
/*sample input output and cases
if casesRaw = "inputA,inputB" then, cases => [0]=='inputA',  [1]=='inputB'
if inputRaw = "1,2:3,4:5,6" then, input => [0]=='1,2',  [1]=='3,4',   [2]=='5,6', || use explode(",",input[0]) to obtain an array for output 0 which is [0]=='1', and [1]=='2'
if outputRaw = "3:7:11" then, output => [0]=='3',[1]=='7',[2]=='11'
input[0] corresponds to output[0]. In other words if the function is inserted with input[0], then the output should be output[0]
*/

$notes = "This is where the robot Input will be; yea; yea; no";

//what middlend needs to send to backend
$backendArray = array(
	'username'=>$username,
	'examName'=>$examName,
	'answer'=>$answer,
	'id'=>$id,
	'autoNotes'=>$notes,
	'grade'=>$grade
);

//===========================CURL===================================

$curl = curl_init();
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, 'afsaccess1.njit.edu/~pw65/testb/backend/storeExamRequest.php');  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $backendArray);
  	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	$responseDB = json_decode(curl_exec($curl));
	curl_close($curl);
  

	echo json_encode($responseDB);





?>