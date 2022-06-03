<?php
session_start(); 
?>
<html>
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
		.formcenter{
			max-width: 620px;
  margin: auto;
  padding: 10px;
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
		<h2 class="text-center" >Edit account</h2> 
	</div>
	
<form style="padding-left:600px;padding-top:100px">
<table>
<tr>
<td>Edit name:</td>
<td><Input type="text" name= "editname"/></td>
</tr>
<tr>
<td>Edit password:</td>
<td><Input type="text" name= "editpassword"/></td>
</tr>
<tr>
<td>
</td>
</tr>
<tr>
<td></td>
<td>
<Input type="submit" name="submit" />
</td>
</tr>
<tr>
<td>
</td>
</tr>
<tr>
<td>
Do you want to logout? <button name="logout">Log out</button>
</td>
</tr>
</table>
</form>
<?php
if(isset($_GET['logout']))
{
	session_destroy();
	header('Location: Mainpage.php');
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
		}  		
		
		if(isset($_GET['submit'])){
			
			$editname = $_GET['editname'];
			$editpassword = $_GET['editpassword'];	
			$currentuser= $_SESSION["Username"];
			if(!empty($editname))
			{
				$sql = "UPDATE user SET userName = '$editname' WHERE user.userName = '$currentuser'";
				$_SESSION["Username"]=$editname;
				mysqli_query($conn, $sql);
			}
			if(!empty($editpassword))
			{
				$sql = "UPDATE user SET password = '$editpassword' WHERE user.userName = '$currentuser'";
				mysqli_query($conn, $sql);
			}
 
		
		
	/*	if (mysqli_num_rows($result) > 0) 
		{ 
			 // output data of each row 
			 while($row = mysqli_fetch_assoc($result)) 
			 { 
			$passworderr=0;
			$accounterr=0;
				 if(!strcmp($row['email'],$_GET['mail'])&&!strcmp($row['password'],$_GET['pwd']) )
				 {
					 session_start();
					 $_SESSION["Username"]=$row['userName'];
					 $_SESSION["Pass"]=$row['pwd'];
					   header('Location: dashboard.php'); exit; 
				 }
				else if (strcmp($row['password'],$_GET['pwd']))
				{
					$passworderr=1;
				}				  
				else if (strcmp($row['email'],$_GET['mail']))
				{
					$accounterr=1;
				}
				
			 }
			if ($passworderr==1)
			{
				echo "Wrong Password!";
			}
			else if ($accounterr==1)
			{
				echo "Account not found!";
			}
		} 
		else 
		{ 
			echo "0 results"; 
		}*/
		} 		
		mysqli_close($conn);
		?>
</body>
</html>