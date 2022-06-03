<!DOCTYPE html>
<?php
session_start();
if($_SESSION["is_admin_login"]!=true)
{
	 header('Location: Mainpage.php'); exit; 
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
	
	
	<div class="hero__section">
		<h2 class="text-center" >Courses</h2>
		</div>
								
		<!--add course-->
		<div class="col-sm-11 mt-5 ml-3 jumbotron">
		<h3 class="text-center">Add New Course</h3>
		<form action="" method="POST" enctype="multipart/form-data">	
			<div class="form-group">
			<label for="course_name">Course Name</label>
			<input type="text" class="form-control" id="course_name" name="course_name">
			</div>
			<div class="form-group">
			<label for="course_desc">Course Description</label>
			<textarea class="form-control" id="course_desc" name="course_desc" row=2></textarea>
			</div>
			<div class="form-group">
			<label for="course_author">Course Author</label>
			<input type="text" class="form-control" id="course_author" name="course_author">
			</div>
			<div class="form-group">
			<label for="course_duration">Course Duration</label>
			<input type="text" class="form-control" id="course_duration" name="course_duration">
			</div>
			<div class="form-group">
			<label for="course_original_price">Course Original Price</label>
			<input type="text" class="form-control" id="course_original_price" name="course_original_price">
			</div>
			<div class="form-group">
			<label for="course_price">Course Selling Price</label>
			<input type="text" class="form-control" id="course_price" name="course_price">
			</div>
			<div class="form-group">
			<label for="course_img">Course Image</label>
			<input type="file" class="form-control-file" id="course_img" name="course_img">
			</div>
			<div class="text-center">
			<button type="submit" class="btn btn-danger" id="courseSubmitBtn" name="courseSubmitBtn">Submit</button>
			<a href="admincourses.php" class="btn btn-secondary">Close</a>
			</div>
			
		</form>
		<?php if (isset($msg))
			{echo $msg;} ?>
		</div>
		<?php
		$servername = "localhost"; 
		$username = "root";
		$password = "";
		$dbname = "sdproject";
		// Create connection 
		
		$conn = mysqli_connect($servername, $username, $password,$dbname);
		if (!$conn) { 
			die("Connection failed: " . mysqli_connect_error()); 
		}  		
		
		if(isset($_POST["courseSubmitBtn"])){
		if(	($_POST["course_name"]=="")||($_POST["course_desc"]=="")||($_POST["course_author"]=="")||($_POST["course_duration"]=="")||($_POST["course_original_price"]=="")||($_POST["course_price"]==""))
		{
			$msg= '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill all fields</div>';
		}
		else{
			$courseName=$_POST["course_name"];
			$courseDescription=$_POST["course_desc"];
			$courseauthor=$_POST["course_author"];
			$courseDuration=$_POST["course_duration"];
			$coursePrice=$_POST["course_price"];
			$courseorgprice=$_POST["course_original_price"];		
			$courseImage=$_FILES['course_img']['name'];
			$courseImageTemp=$_FILES['course_img']['tmp_name'];
			$img_folder='Images/'.$courseImage;
			move_uploaded_file($courseImageTemp,$img_folder);
			
			$sql="INSERT INTO COURSES (courseName,courseDesc,courseAuthor,courseImage,courseDuration,coursePrice,courseOrgPrice) Values ('$courseName','$courseDescription','$courseauthor','$img_folder','$courseDuration','$coursePrice','$courseorgprice')";
			
		 	mysqli_query($conn, $sql);	
		}
		}
		
			 		
		mysqli_close($conn);
		?>	
	</div>


</body>
</html>