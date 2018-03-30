<?php
//~kxg2/CS490/kxg2/inputs2.php

//simulated front
function proc($link,$d)
{
        $send = curl_init();
        curl_setopt($send, CURLOPT_URL, $link);
        curl_setopt($send,CURLOPT_POST,1);
        curl_setopt($send,CURLOPT_POSTFIELDS,$d);
        curl_setopt($send,CURLOPT_RETURNTRANSFER,1);
        $RET=curl_exec($send);
        curl_close($send);
        return $RET;
}
        $src='https://web.njit.edu/~kxg2/CS490/kxg2/mid.php';

//front needs to format the student answers as such... don't need to worry about escape chars
//php nowdoc
/*
	$doc=<<<'lol'
def operation(op, a, b):
  if op =='+':
    return a+b
  elif op=='-':
    return a-b
  elif op =='*':
    return a*b
  elif op =='/':
    return a/b;;
lol;
*/



/*
$doc=<<<'lol'
def operation(a, b):
  if a[0]==b[0]:
    return True
  else:
    end1=len(a)-1
    end2=len(b)-1
    if a[end1]==b[end2]:
        return True
  return False
lol;
*/

/*
$doc=<<<'lol'
def operation(a, b):
  if int(a)+int(b)==10 or a==10 or b==10:
    return True
  return False
lol;
*/

$doc="def operation(op, a, b):
  if op =='+':
    return a+b
  elif op=='-':
    return a-b
  elif op =='*':
    return a*b
  elif op =='/':
    return a/b";

        $fData=array(
                'header'=>'storeExamRequest',
                'username'=>'student1',
                'id'=>1,
                'examName'=>'MidTerm',
                'functionName'=>'operation',
                'parameters'=>'op,a,b',
                'topic'=>'Loops',
		'answer'=>$doc,
                'pointWorth'=>10,   


//		'input'=>'9,10:9,9:9,1',		
//		'output'=>'True,False,True'



		//'input'=>'[1,2,3]?[7,3]:[1,2,3]?[7,3,2]:[1,2,3]?[1,3]',
//		'output'=>'True,False,True'

                'input'=>'+,1,2:-,5,2:*,4,5:/,10,2',
                'output'=>'3,3,20,5'
		);
//send
        echo proc($src,$fData);
?>
