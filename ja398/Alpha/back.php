<?php
//Julio "Jay" Arroyo
//CS 490
//February 12, 2018

//Sending/Receiving from: https://web.njit.edu/~kxg2/alpha/middle.php

if (isset($_POST['ucid'], $_POST['password'])) {
	//Mysqli(server, username, password, database)
	$db = new Mysqli("sql1.njit.edu", "ja398", "flJOYDGVq", "ja398");
	$username = mysqli_real_escape_string($db,$_POST['ucid']);
    $password = mysqli_real_escape_string($db,$_POST['password']); 
	$query = "SELECT id FROM users WHERE username = '$username' and password = '$password'";
	$result = mysqli_query($db,$query);
    $count = mysqli_num_rows($result);
    // If result matched $username and $password, table row must be 1 row
    if($count == 1) {
		$message->mess="SQL OK";
		$reply=json_encode($message);
		echo $reply;
    }
	else {
		$message->mess="SQL FAIL";
		$reply=json_encode($message);
		echo $reply;
	}
}
?>