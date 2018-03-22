<?php
//~kxg2/CS490/kxg2/inputs.php

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
        $src='https://web.njit.edu/~kxg2/CS490/kxg2/grading.php';
        
	$fData=array(
        	'username'=>'username',
        	'examName'=>'examName',
        	'qname'=>'Name of question',
        	'topic'=>'Topic',
		'answer'=>3,
		'id'=>300,

		'cases'=>'UKWN',
		'input'=>'1,2:3,4:5,6',
		'output'=>'3:7:11'
);
//send
        echo proc($src,$fData);
?>
