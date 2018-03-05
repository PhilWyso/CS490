	<?php
 #!/usr/bin/python
  echo "Trying to call helloworld.py <br>";
	exec('python helloworld.py 2>&1' , $output);
	print_r($output);
	echo "<br>Trying to call helloworld.py again <br>";
	$output = exec('python helloworld.py');
	print_r($output);
 ?>
