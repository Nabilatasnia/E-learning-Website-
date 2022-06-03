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
		.course__img {
			width: 200px;
			height: 150px;
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
		<h2 class="text-center" >Courses</h2> 
	</div>
	<div class="container my-4">
		<form action="" method="POST">
			<label>Search</label>
			<input type="text" name="search" class="form-control" placeholder="Search By Name" value="">
			<button>Search</button>
		</form>
		
		<?php
			require 'dbConnect.php';
			$query = "select * from courses";

			if(isset($_POST['search'])){
				$string = $_POST["search"];
				$query = "select * from courses where courseName like '%$string%'";
			}
			
		 ?>
	</div>
	<div class="container py-3">
		<div class="row mt-4">
			<?php
				//require 'Database/dbConnect.php';	 <?php echo $_POST['course'];
				$query_run = mysqli_query($conn, $query);
				$check =  mysqli_num_rows($query_run) > 0;
				if(isset($_POST['submit'])){
						$course = $_POST["course"];
				}
				if($check)
				{
					while($row = mysqli_fetch_array($query_run))
					{
						?>
						<div class="col-md-3">
							<div class="card">
								<div class="card-body">
									<img src="Images/<?php echo $row['courseImage']; ?>" class="card-img-top course__img" alt="">
									<h2 class="card-title"> <?php echo $row['courseName']; ?> </h2>
									<!--ADD ID  <p class="card-text">  <?php echo $row['courseDesc']; ?> </p> 
									<?php echo $row['courseName']; ?>
									<a class="btn btn-primary btn-lg" href="coursePage.php" role="button" style="width:150px">Show more </a>
									<form action="coursePage.php" method="POST">
										<button type="submit" style="border-radius: 12px;padding:11px 16px;font-weight:bolder"> Show More </button>-->
										<form action="coursePage.php" method="POST" class="d-inline">
											<input type="hidden" name="course" value=<?php echo $row["courseName"] ?>>
										<button type="submit" style="border-radius: 12px;padding:11px 16px;font-weight:bolder"> Show More </button>
									</form>
								</div>
							</div>
						</div>
						<?php 
							
					}
				}
				else
				{
					echo "No Courses";
				}
			 ?>
		</div>
	</div>
</body>
</html>