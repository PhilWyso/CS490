<?php
	header("Content-type: application/json; charset=UTF-8");
	$username=$_POST[username];
	$password=$_POST[password];
	
	
//============= Back End ==================
	$info = array('username' => $username,'password' => $password);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, 'afsaccess1.njit.edu/~pw65/cs490/backend/backend.php');  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
  	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

	$responseDB = json_decode(curl_exec($curl));
	curl_close($curl);

//============== NJIT Spoof ================

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://cp4.njit.edu/cp/home/login");
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
			"user" => $username,
			"pass" => $password,
			"uuid" => "0xACA021"
		)));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$responseNJIT = curl_exec($ch);
	curl_close($ch);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://cp4.njit.edu/up/Logout?uP_tparam=frm&frm=");
	curl_exec($ch);
	curl_close($ch);



//============= processing data ============
	
	$response = array(
		'NJIT' => false,
		'DB' => $responseDB
	);

	if (strpos($responseNJIT, 'Login Successful') !== false) {
    $response['NJIT'] = True;
} else {
	$response['NJIT'] = False;
}

   	echo json_encode($response);

?>