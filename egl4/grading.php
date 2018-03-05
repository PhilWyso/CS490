<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
//middleend will be recieving each question individually, and the backend will be storing each question answer individually
//What middleend obtains
$username = $_POST['username'];			//username
$examName = $_POST['examName'];			//examName
$functionName = $_POST['qName'];		//required name of function
$topic = $_POST['topic'];				//question topic
$casesRaw = str_replace(' ', '',$_POST['cases']);			//raw case string seperated by commas, str_replace removes spaces
$inputRaw = str_replace(' ', '',$_POST['input']);			//raw input string seperated by commas and colons
$outputRaw = str_replace(' ', '',$_POST['output']);			//raw case string seperated by commas
$answer = $_POST['answer'];				//student coding answer
$id = $_POST['id'];						//question ID
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
// write to python file [grade.py]
$outputs = "";

$array = explode(':',$inputRaw);
$points = 10/count($array);
foreach ($array as $value)
{
//for each sample case
  //write to file
  $file = "grade.py";
  $handle = fopen($file, 'w');// or die ('Cannot open file: '.$file);
  $data1 = $answer."\n";
  $data2 = "solution = ". $value;
  $data3 = "\nprint(solution)";
  fwrite($handle, $data1);
  fwrite($handle, $data2);
  fwrite($handle, $data3);
  fclose($handle);
  exec("/usr/bin/python grade.py middle" , $output);
  $outputs .= $value . " " . $output . ":";
}
$grade = $outputs;


//what middlend needs to send to backend
$backendArray = array(
	'username'=>$username,
	'examName'=>$examName,
	'answer'=>$answer,
	'id'=>$id,
	'notes'=>$notes,
	'grade'=>$grade
);
//===========================CURL===================================
$curl = curl_init();
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, 'afsaccess1.njit.edu/~pw65/cs490/backend/storeStudentExam.php');  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $backendArray);
  	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	$responseDB = json_decode(curl_exec($curl));
	curl_close($curl);
	echo json_encode($responseDB);
?>
