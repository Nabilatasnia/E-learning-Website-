<!DOCTYPE html>
<?php
session_start(); 
if($_SESSION["is_admin_login"]!=true)
{
	 header('Location: Mainpage.php'); exit; 
}
		$servername = "localhost"; 
		$username = "root";
		$password = "";
		$dbname = "sdproject";
		// Create connection 
		
		$conn = mysqli_connect($servername, $username, $password,$dbname);
		if (!$conn) { 
			die("Connection failed: " . mysqli_connect_error()); 
		} 
		//update
		if(isset($_REQUEST['requestupdate']))
		{
				if(($_REQUEST["user_id"]=="")||($_REQUEST["user_name"]=="")||($_REQUEST["user_email"]=="")||($_REQUEST["user_password"]==""))
				{
					$msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill all fields</div>';					
				}
				else
				{
					$uid=$_REQUEST['user_id'];
					$uname=$_REQUEST['user_name'];
					$uemail=$_REQUEST['user_email'];
					$upassword=$_REQUEST['user_password'];
				
					$sql="UPDATE user SET userName='$uname', email='$uemail', password='$upassword' WHERE userID='$uid'";
					//echo $sql;
					if(mysqli_query($conn, $sql))
					{
						$msg='<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';						
					}
					else 
					{
						$msg='<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Unable to update</div>';
					}
				}
		}

 		?>
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
		<h2 class="text-center" >Edit Student</h2>
		</div>
		<table>
		<tr>
		

						
		<!--edit existing courses-->
		
		
		
		<div class="col-sm-11 mt-5 ml-3 jumbotron">
		<h3 class="text-center">Update student details</h3>
		
		<?php
		
		if(isset($_REQUEST['view']))
		{
			$sql="SELECT * FROM user WHERE userID = {$_REQUEST['id']}";
			$query_run = mysqli_query($conn, $sql);
			$check =  mysqli_num_rows($query_run) > 0;
			$row = mysqli_fetch_array($query_run);			
		}
		
		?>
		
		<form action="" method="POST" enctype="multipart/form-data">	
		<div class="form-group">
			<label for="user_id">Student ID</label>
			<input type="text" class="form-control" id="user_id" name="user_id" value="<?php if(isset($row['userID'])){ echo $row['userID'];} ?>" readonly>
			</div>
			<div class="form-group">
			<label for="user_name">Student Name</label>
			<input type="text" class="form-control" id="user_name" name="user_name" value="<?php if(isset($row['userName'])){ echo $row['userName'];} ?>">
			</div>
			<div class="form-group">
			<label for="user_email">Student Email</label>
			<input type="text" class="form-control" id="user_email" name="user_email" value="<?php if(isset($row['email'])){ echo $row['email'];} ?>" readonly>
			</div>
			<div class="form-group">
			<label for="user_password">Student Password</label>
			<input type="text" class="form-control" id="user_password" name="user_password" value="<?php if(isset($row['password'])){ echo $row['password'];} ?>">
			</div>

			<div class="text-center">
			<button type="submit" class="btn btn-danger" id="requestupdate" name="requestupdate">Update</button>
			<a href="adminstudents.php" class="btn btn-secondary">Close</a>
			</div>
			
		</form>



</body>
</html>