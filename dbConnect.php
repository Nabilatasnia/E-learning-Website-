<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php 
		$servername = "localhost"; 
		$username = "root";
		$password = "";
		$dbname = "sdproject";
		// Create connection 
		$conn = mysqli_connect($servername, $username, $password); 
		// Check connection 
		if (!$conn) { 
			die("Connection failed: " . mysqli_connect_error()); 
		} 
		$dbconfig = mysqli_select_db($conn, $dbname);

		/*if($dbconfig)
		{
			echo "Database Connected";
		}
		else
		{
			echo "";
		}*/
	?>

</body>
</html>