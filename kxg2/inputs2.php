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
	$doc=<<<'lol'
def operation(add, a, b):
  if add =='+':
    return a+b
  elif add=='-':
    return a-b
  elif add =='*':
    return a*b
  elif add =='/':
    return a/b
lol;


        $fData=array(
                'header'=>'storeExamRequest',
                'username'=>'student1',
                'id'=>1,
                'examName'=>'MidTerm',
                'functionName'=>'operation',
                'topic'=>'conditionals',
                'parameters'=>'op,a,b',
                'topic'=>'Conditionals',
		'answer'=>$doc,
                'pointWorth'=>10,   
                'input'=>'+,1,2:-,5,2:*,4,5:/,10,2',
                'output'=>'3,3,20,5'
		);
//send
        echo proc($src,$fData);
?>
