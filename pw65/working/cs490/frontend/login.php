<?php

	$username=$_POST['username'];
	$password=$_POST['password'];
	$check=$_POST['check'];
	$curl = curl_init();
	$info = array('username' => $username,'password' => $password);


	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, 'afsaccess1.njit.edu/~pw65/cs490/backend/backend.php');  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
  	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	
	$response = curl_exec($curl);
	curl_close($curl);

   	echo $response;
?>
