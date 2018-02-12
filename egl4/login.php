<?php 
header("Content-type: application/json; charset=UTF-8");
$url = 'https://cp4.njit.edu/cp/home/login'; 
$user = $_POST['username'];
$password = $_POST['password'];
$uuid = '0xACA021';
$location = 'false';
$query = 'pass=' . $password . '&user=' . $user . '&uuid=' . $uuid;
$query1 = 'password=' . $password . '&username=' . $user;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec( $ch );
curl_close($ch);
if (preg_match('~Location: (.*)~i', $response, $match)) {
   $location = 'true';
}
$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, 'https://web.njit.edu/~pw65/cs490/backend/backend.php');
curl_setopt($ch1, CURLOPT_POST, true);
curl_setopt($ch1, CURLOPT_POSTFIELDS, $query1);
//curl_setopt($ch1, CURLOPT_HEADER, true);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$data = json_decode(curl_exec($ch1));
$data1 = curl_exec($ch1);
curl_close($ch1);
//DB
//$toreturn = $data['0'] . $location; 

$test = array(
  'NJIT' => $location,
  'BD' => $data
);
echo json_encode($test);
?>