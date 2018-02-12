<?php
 $fp = fopen('php://input', 'r');
 $rawData = stream_get_contents($fp);


 echo "Login obtained";



?>