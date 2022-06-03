<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		.hero__section{
			background: rgba(53,73,150,255);
			color: #FFFFFF;
			padding: 90px 0px;
		}
		.main__section {
			padding:30px 0px;
		}
		.main__section p {
			padding-top: 20px;
		}
		.main__section img {
			width: 200px;
		}
		.name {
			font-weight: bold;
		}
		.price__section {
			font-weight: bold;
			font-size: 25px;
		}

	</style>
</head>
 <?php
 			$string = $_POST['course'];
			require 'dbConnect.php';
			$query = "select * from courses  where courseName = '$string'";
			
		 ?>
<body>
	<div style="height:70px;width: 100%;position:fixed;background-color:white">
		<table class="table table-borderless" style="margin-left:100px;margin-right:150px; width:200px">
			<tr>
				<td>
					<img src="logo.png" style="height:30px"/>
				</td>
				<td class="nav-item" style="font-size:20;padding-left:300px;color:#cc0066">
    				<a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
				</td>  
  				<td class="nav-item" style="font-size:20">
   				 	<a class="nav-link active" aria-current="page" href="courses.php">Courses</a>
  				</td>
  				<td class="nav-item" style="font-size:20">
    				<a class="nav-link active" aria-current="page" href="#programs">Programs</a>
  				</td>
  				<td class="nav-item" style="font-size:20">
    				<a class="nav-link active" aria-current="page" href="account.php">Account</a>
  				</td>
  				
			</tr>
		</table>
	</div>

	<div class="hero__section">
		<?php
				//require 'Database/dbConnect.php';	 <?php echo $_POST['course'];
				$query_run = mysqli_query($conn, $query);
				$check =  mysqli_num_rows($query_run) > 0;
				$row = mysqli_fetch_array($query_run);
				if(isset($_POST['submit'])){
						$course = $_POST["course"];
				}
						?>
		<h2 class="text-center">Welcome to <span id=""> <?php echo $row['courseName']; ?></span></h2> 


	</div>
	<div class="main__section container text-center">
		<img src="Images/<?php echo $row['courseImage']; ?>" alt="">
		<p> <?php echo $row['courseDesc']; ?></p>
		<p>
			Created by <span class="name"> <?php echo $row['courseAuthor']; ?></span>
		</p>

		<p class="price__section">BDT <?php echo $row['coursePrice']; ?></p>
		
		<form action="confirmOrder.php" method="POST" class="d-inline">
			<input type="hidden" name="course" value=<?php echo $row["courseName"] ?>>
			<button class="btn-primary" style="border-radius: 12px;padding:11px 16px;font-weight:bolder">Enroll</button>
		</form>
	</div>


</body>
</html>

