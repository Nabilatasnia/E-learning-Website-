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
				if(($_REQUEST["ucourse_name"]=="")||($_REQUEST["ucourse_desc"]=="")||($_REQUEST["ucourse_author"]=="")||($_REQUEST["ucourse_duration"]=="")||($_REQUEST["ucourse_original_price"]=="")||($_REQUEST["ucourse_price"]==""))
				{
					$msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill all fields</div>';					
				}
				else
				{
					$cid=$_REQUEST['course_id'];
					$cname=$_REQUEST['ucourse_name'];
					$cdesc=$_REQUEST['ucourse_desc'];
					$cauthor=$_REQUEST['ucourse_author'];
					$cduration=$_REQUEST['ucourse_duration'];
					$cprice=$_REQUEST['ucourse_price'];
					$corgprice=$_REQUEST['ucourse_original_price'];
					$cimg='Images/'.$_FILES['ucourse_img']['name'];
				
					$sql="UPDATE courses SET courseName='$cname', courseDesc='$cdesc', courseAuthor='$cauthor', courseImage='$cimg' WHERE courseID='$cid'";
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
		<h2 class="text-center" >Edit Course</h2>
		</div>
		<table>
		<tr>
		

						
		<!--edit existing courses-->
		
		
		
		<div class="col-sm-11 mt-5 ml-3 jumbotron">
		<h3 class="text-center">Update course details</h3>
		
		<?php
		
		if(isset($_REQUEST['view']))
		{
			$sql="SELECT * FROM courses WHERE courseID = {$_REQUEST['id']}";
			$query_run = mysqli_query($conn, $sql);
			$check =  mysqli_num_rows($query_run) > 0;
			$row = mysqli_fetch_array($query_run);			
		}
		
		?>
		
		<form action="" method="POST" enctype="multipart/form-data">	
		<div class="form-group">
			<label for="course_id">Course ID</label>
			<input type="text" class="form-control" id="course_id" name="course_id" value="<?php if(isset($row['courseID'])){ echo $row['courseID'];} ?>" readonly>
			</div>
			<div class="form-group">
			<label for="course_name">Course Name</label>
			<input type="text" class="form-control" id="ucourse_name" name="ucourse_name" value="<?php if(isset($row['courseName'])){ echo $row['courseName'];} ?>">
			</div>
			<div class="form-group">
			<label for="course_desc">Course Description</label>
			<textarea class="form-control" id="ucourse_desc" name="ucourse_desc" row=2><?php if(isset($row['courseDesc'])){ echo $row['courseDesc'];} ?></textarea>
			</div>
			<div class="form-group">
			<label for="course_author">Course Author</label>
			<input type="text" class="form-control" id="ucourse_author" name="ucourse_author" value="<?php if(isset($row['courseAuthor'])){ echo $row['courseAuthor'];} ?>">
			</div>
			<div class="form-group">
			<label for="course_duration">Course Duration</label>
			<input type="text" class="form-control" id="ucourse_duration" name="ucourse_duration" value="<?php if(isset($row['courseDuration'])){ echo $row['courseDuration'];} ?>">
			</div>
			<div class="form-group">
			<label for="course_original_price">Course Original Price</label>
			<input type="text" class="form-control" id="ucourse_original_price" name="ucourse_original_price" value="<?php if(isset($row['courseOrgPrice'])){ echo $row['courseOrgPrice'];} ?>">
			</div>
			<div class="form-group">
			<label for="course_price">Course Selling Price</label>
			<input type="text" class="form-control" id="ucourse_price" name="ucourse_price" value="<?php if(isset($row['coursePrice'])){ echo $row['coursePrice'];} ?>">
			</div>
			<div class="form-group">
			<label for="course_img">Course Image</label>
			<img src="<?php if(isset($row['courseImage'])){ echo $row['courseImage'];} ?>" alt="" class="img-thumbnail">
			<input type="file" class="form-control-file" id="ucourse_img" name="ucourse_img">
			</div>
			<div class="text-center">
			<button type="submit" class="btn btn-danger" id="requestupdate" name="requestupdate">Update</button>
			<a href="admincourses.php" class="btn btn-secondary">Close</a>
			</div>
			
		</form>



</body>
</html>