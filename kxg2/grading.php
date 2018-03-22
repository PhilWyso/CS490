<?php
//~kxg2/CS490/grading.php

//i ran this first...        fs sa . <UCID> rlidwk
//then...      fs setacl . http write
//error_reporting(E_ALL);
//ini_set('display_errors',1);

//middleend will be recieving each question individually, and the backend will be storing 
//each question answer individually
//What middleend obtains

$username = $_POST['username'];			//username
$examName = $_POST['examName'];			//examName
$id=$_POST['id'];
$functionName = $_POST['functionName'];		//required name of function
$topic = $_POST['topic'];			//question topic
$parameters=$_POST['parameters'];
$inputRaw = str_replace(' ', '',$_POST['input']);			//raw input string seperated by commas and colons
$outputRaw = str_replace(' ', '',$_POST['output']);			//raw case string seperated by commas
$answer = $_POST['answer'];			//student coding answer
$pointWorth=$_POST['pointWorth'];
						
//==============================================================

$notes="";
$grade=$pointWorth;	//assume grade is out of 10 points, I haven't put in the actual field for putting in a grade yet when creating the question.
$input=explode(":",$inputRaw); //turns into array, which divides up the inputs. input[0] corresponds to output[0] and so on.
$output=explode(":",$outRaw); //turns into array, which divides into sample outputs.
$param=explode(',',$parameters);


/*sample input output and cases
if casesRaw = "inputA,inputB" then, cases => [0]=='inputA',  [1]=='inputB'
if inputRaw = "1,2:3,4:5,6" then, input => [0]=='1,2',  [1]=='3,4',   [2]=='5,6', || use 
explode(",",input[0]) to obtain an array for output 0 which is [0]=='1', and [1]=='2'
if outputRaw = "3:7:11" then, output => [0]=='3',[1]=='7',[2]=='11'
input[0] corresponds to output[0]. In other words if the function is inserted with 
input[0], then the output should be output[0]
*/
// write to python file

foreach($_POST as $k) 
{
	echo $k;
	echo '<br>';
}

$in = explode(':',$inputRaw);
$out = explode(',',$outputRaw);

$count=count($in); # of inputs given
$copy=$answer;

//---------------------

echo '<br>...NOW GRADING<br><br>';

$header=strtok($answer,':');	//extract function header
$tok=strtok($header,'(');

$pos1=strpos($header,'(');
$pos2=strpos($header,')',$pos1+1);
$stuP=substr($header,$pos1+1,$pos2+1);
$sInput=explode(',',$stuP);

echo $header.'<br>';

echo $sInput[0];
$fname=preg_split("/[\s]/",$tok);

//echo $fname[1];
//prelim TESTS
echo '<br>';


  //if(strstr($tok,$functionName)==FALSE)
  if(strcmp($fname[1],$functionName)!=0)
  {
	//$tok=strtok($answer,':');
	$notes=$notes . "You made a mistake in the function header should have function name '$functionName', you provided: '$fname[1]' instead,"; 
	$grade=$grade-1;
  }

  //if(strstr($tok,$param[0])==FALSE)
  if(strcmp($sInput[0],$param[0])!=0)
  {
	$notes=$notes . "You made a mistake within the function header parameters. You provided ' $sInput[0] ' instead of '$param[0]', ";
	$grade=$grade-1;
  }

//GRADING
for($i=0;$i<$count;$i++)
{
  $inners=explode(',',$in[$i]);


  $file = "exec.py";
  $handle = fopen($file, 'w');// or die ('Cannot open file: '.$file);
  fwrite($handle, $copy."\nprint($fname[1]('$inners[0]',$inners[1],$inners[2]))");
  fclose($handle);

  $res=exec("python ./exec.py 2>&1");

  if($res===$out[$i])
	echo 'Correct<br>';
  else
  {
	$notes=$notes."You have failed the $i 'th case. Your answer provided ' $res ' 
instead of $out[$i], ";
	$grade=$grade - ( (1/$count) * $pointWorth);
  }
}

echo "Final grade is $grade<br>";
echo $notes;

/*
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
	curl_setopt($curl, CURLOPT_URL, 
'afsaccess1.njit.edu/~pw65/cs490/backend/storeStudentExam.php');  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $backendArray);
  	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	$responseDB = json_decode(curl_exec($curl));
	curl_close($curl);
	echo json_encode($responseDB);
*/
?>
