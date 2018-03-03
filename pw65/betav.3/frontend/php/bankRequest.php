<?php
$array = json_decode($_POST['json_string']);


$curl = curl_init();
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_URL, 'afsaccess1.njit.edu/~pw65/cs490/midend/mid.php');  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $array);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($curl);
curl_close($curl);

echo $response;


?>