<!DOCTYPE html>
<?php
session_start();
if($_SESSION["is_admin_login"]!=true)
{
	 header('Location: Mainpage.php'); exit; 
} 
?>
<?php
		$servername = "localhost"; 
		$username = "root";
		$password = "";
		$dbname = "sdproject";
		// Create connection 
		
		$conn = mysqli_connect($servername, $username, $password,$dbname);
		if (!$conn) { 
			die("Connection failed: " . mysqli_connect_error()); 
		}  		?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		.hero__section{
			background: rgba(53,73,150,255);
			color: #FFFFFF;
			padding: 90px 0px;
		}
		/* plus button at the right-bottom*/
		.box 
		{
			position: fixed;
			bottom: 10px;
			right: 20px;
			margin-bottom: 30px;
		}
	</style>
</head>
<body>
	<div style="height:70px;width: 100%;position:fixed;background-color:white">
		<table class="table table-borderless" style="margin-left:100px;margin-right:150px; width:200px">
			<tr>
				<td>
					<img src="logo.png" style="height:30px"/>
				</td>
				<td class="nav-item" style="font-size:20;padding-left:180px;color:#cc0066">
    				<a class="nav-link active" aria-current="page" href="adminpage.php">Dashboard</a>
				</td>  
  				<td class="nav-item" style="font-size:20">
   				 	<a class="nav-link active" aria-current="page" href="admincourses.php">Courses</a>
  				</td>
  				<td class="nav-item" style="font-size:20">
    				<a class="nav-link active" aria-current="page" href="adminlessons.php">Lessons</a>
  				</td>
  				<td class="nav-item" style="font-size:20">
    				<a class="nav-link active" aria-current="page" href="adminstudents.php">Students</a>
  				</td>
				<td class="nav-item" style="font-size:20">
    				<a class="nav-link active" aria-current="page" href="adminfeedback.php">Feedback</a>
  				</td>
				<td class="nav-item" style="font-size:20">
    				<a class="nav-link active" aria-current="page" href="adminaccount.php">Account</a>
  				</td>
				
  				<td class="nav-item" style="padding-left:200px;padding right:50px">
  					<form method="GET" class="d-inline"><button class="btn btn-primary btn-lg active" name="logout">LogOut</button></form>
				</td>
			</tr>
		</table>

	</div>
	<?php
if(isset($_GET['logout']))
{
	session_destroy();
	header('Location: Mainpage.php');
}
?>
	<div class="hero__section">
		<h2 class="text-center" >Students</h2>
		</div>
		<table>
		<tr>
		

						
		<!--existing courses-->
<div class="mx-5 mt-5 text-center">
<!--table-->
<p class="bg-dark text-white p-2">List of students</p>
<?php
$sql="SELECT * FROM user"; 
$query_run = mysqli_query($conn, $sql);
$check =  mysqli_num_rows($query_run) > 0; 
if($check){
?>
<table class="table">
<tr>
<th scope="col"> Student ID </th>
<th scope="col"> Student Name </th>
<th scope="col"> Student Email </th>
</tr>
<?php
while($row = mysqli_fetch_array($query_run)){ 
echo '<tr>';
echo '<th scope="row">'.$row['userID'].'</th>';
echo '<td>'.$row['userName'].'</td>';
echo '<td>'.$row['email'].'</td>';

echo '<td><form action="editStudent.php" method="POST" class="d-inline"><input type="hidden" name="id" value='.$row['userID'].'><button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="fa fa-edit"></i></form><form method="POST" class="d-inline"><input type="hidden" name="id" value='.$row['userID'].'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="fa fa-trash"></i></form></td></tr>';
 } ?>
</table><?php } else {
	echo "0 Result";
} 

if (isset($_REQUEST['delete']))
	{
		$sql="DELETE FROM user WHERE userID={$_REQUEST['id']}";
		if(mysqli_query($conn, $sql))
		{
			echo '<meta http-equiv="refresh" content="0;URL=?deleted"/>';
		}
		else
		{
			echo "Unable to delete data";
		}
	}


?>
<div>
<a class="btn btn-danger box" href="addstudent.php"><i class="fa fa-plus fa-2x"></i></a></div>
</div>
		
						
	</div>



</body>
</html>