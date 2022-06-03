<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Confirm Order</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
		.hero__section{
			background: rgba(53,73,150,255);
			color: #FFFFFF;
			padding: 90px 0px;
		}
		.checkout__main {
			background: #eee;
		}
		form {
			padding: 50px 0px;
			text-align: center;
			font-size: 20px;
		}
		form img {
			width: 150px;
			padding: 5px 0px
		}
		form button {
			font-size: 16px;
		}
		form span {
			font-weight: bold;
		}
		#price,#date {
			font-weight: normal;
		}
		form label{
			font-size: 16px;
		}

	</style>
</head>
		<?php
 			$string = $_POST['course'];
			require 'dbConnect.php';
			$queryCourse = "select * from courses  where courseName = '$string'";
				//require 'Database/dbConnect.php';	 <?php echo $_POST['course'];
				$query_run = mysqli_query($conn, $queryCourse);
				$check =  mysqli_num_rows($query_run) > 0;
				$row = mysqli_fetch_array($query_run);
						
		?>
<body>
	<div class="hero__section">
		<h2 class="text-center" >Confirm Purchase</h2> 
		<?php 
	if(isset($_GET['submit'])){
			$bkashNumber = $_GET['bkashNumber'];
			$date = date("d-m-Y");
			$amount = $row['coursePrice'];
			$courseID = $row['courseID'];
			$query = "insert into orders (courseID, userEmail, orderDate, amount, bkashNumber) values (1, '@', '$orderDate', 100, '$bkashNumber')";
			$query_run = mysqli_query($conn, $query);
	}
 ?>
	</div>
	<div class="container checkout__main">
		<form>
			<img src="Images/<?php echo $row['courseImage']; ?>" alt="">
			<p> <span>Course Name :</span> <?php echo $row['courseName']; ?></p>
			<p> <span>Price :</span>  <span id="price"><?php echo $row['coursePrice']; ?></span> tk</p>
			<p> <span>Date Purchased:</span>  <span id="date"><?php echo date("d-m-Y"); ?></span></p>
			<label>
				<span>Bkash Number : </span>
				<input type="text" name="bkashNumber">
			</label>
			<br> <br>
			<form action="" method="GET">
				<button style="border-radius: 12px;padding:11px 16px;font-weight:bolder" class="btn-primary text-center" type="submit" name="Confirm" value="">Confirm</button>
				</form>
		</form>
	</div>
</body>
</html>


