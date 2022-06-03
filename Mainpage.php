<html>
<head>
<title>Shokh</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
.vl {
  border-left: 2px solid black;
  height: 350px;
  align: center;
  margin-left:40px;
}
.v2 {
  border-left: 2px solid black;
  height: 650px;
  align: center;
  margin-left:40px;
}
</style>
</head>
<body>
<div style="height:70px;width:100%;position:fixed;background-color:white">
<table class="table table-borderless" style="margin-left:100px;margin-right:150px; width:200px">
<tr>
<td>
<img src="logo.png" style="height:30px"/>
</td>
<td class="nav-item" style="font-size:20;padding-left:300px;color:#cc0066">
    <a class="nav-link active" aria-current="page" href="#home">Home</a>
</td>  
  <td class="nav-item" style="font-size:20">
    <a class="nav-link active" aria-current="page" href="#courses">Courses</a>
  </td>
  <td class="nav-item" style="font-size:20">
    <a class="nav-link active" aria-current="page" href="#programs">Programs</a>
  </td>
  <td class="nav-item" style="font-size:20">
    <a class="nav-link active" aria-current="page" href="#teachers">Teacher</a>
  </td>
  <td class="nav-item" style="padding-left:200px;padding right:50px">
  <a class="btn btn-primary btn-lg" href="#contactus" role="button" style="width:200px;background-color:#cc0066">Contact us</a>

</td>
</tr>
</table>

</div>
<section id="home" style="padding-top:70px;width: max-width; height: 700px; background-color: rgba(53,73,150,255)">
<div class="container" style="padding-top:100px;padding-left:100px">
<div class="row">
<div class="col-lg-5" style="background-color:white;height:450px; padding-top:130px">
<h1>Login</h1>
        
        <form>
          <table>
            <tr>
              <th style="text-align: left;">E-mail</th>
              <td><input type="text" name="mail"></td>
            </tr>
            <tr>
              <th style="text-align: left;">Password</th>
              <td><input type="password" name="loginpassword"></td>
            </tr>

          </table>
          <br>
	
          <button style="border-radius: 12px;padding:11px 16px;font-weight:bolder;margin-left:250px" type="submit" name="submit" value="submit">Log in</button>
        </form>
		
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
			$email = $_GET['mail'];
			$password = $_GET['loginpassword'];	
			
			$sql1 = "SELECT * FROM admin";
			$passworderr=0;
			$accounterr=0;
			$result = mysqli_query($conn, $sql1); 

		if (mysqli_num_rows($result) > 0) 
		{ 
			 // output data of each row 
		while($row = mysqli_fetch_assoc($result)) 
		{ 
			$passworderr=0;
			$accounterr=0;
				 if(!strcmp($row['adminemail'],$_GET['mail'])&&!strcmp($row['password'],$_GET['loginpassword']))
				 {
					 session_start();
					 $_SESSION["is_admin_login"]=true;
					 $_SESSION["AdminID"]=$row['adminID'];
					
					 $_SESSION["AdminPass"]=$row['password'];
					 $_SESSION["AdminEmail"]=$row['adminmeail'];
					 
					   header('Location: adminpage.php'); exit; 
				 }
				else if (strcmp($row['password'],$_GET['loginpassword']))
				{
					$passworderr=1;
				}				  
				else if (strcmp($row['adminemail'],$_GET['mail']))
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
		}
		 	
		$sql = "SELECT * FROM user";
		$result = mysqli_query($conn, $sql); 
		
		
		if (mysqli_num_rows($result) > 0) 
		{ 
			 // output data of each row 
			 while($row = mysqli_fetch_assoc($result)) 
			 { 
			$passworderr=0;
			$accounterr=0;
				 if(!strcmp($row['email'],$_GET['mail'])&&!strcmp($row['password'],$_GET['loginpassword']) )
				 {
					 session_start();
					 $_SESSION["Username"]=$row['userName'];
					 $_SESSION["Pass"]=$row['pwd'];
					 $_SESSION["Email"]=$row['mail'];
					 
					   header('Location: dashboard.php'); exit; 
				 }
				else if (strcmp($row['password'],$_GET['loginpassword']))
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
		}
		} 		
		mysqli_close($conn);
		?>
</div>
<div class="col-lg-5" style="background-color:white;height:450px; padding-top:130px">
<h1>Sign up</h1>
        
        <form>
          <table>
            <tr>
              <th style="text-align: left;">Username </th>
              <td><input type="text" name="uid"/></td>
            </tr>
            <tr>
              <th style="text-align: left;">E-mail </th>
              <td>
			  <input type="email" id="email" name="visitor_email" placeholder="your-account@email.com" required>
			  </td>
            </tr>
            <tr>
              <th style="text-align: left;">Password </th>
              <td><input type="password" name="pwd" pattern=".{6,}" required></td>
			 
            </tr>
			<tr>
			<td></td>
			<td>password must be at least 6 characters long</td>
			</tr>
            <tr>
              <th style="text-align: left;">Repeat Password </th>
              <td><input type="password" name="pwd-repeat"></td>
            </tr>
          </table>
          <br>
          <button style="border-radius: 12px;padding:11px 16px;font-weight:bolder;margin-left:250px" type="submit" name="signup-submit">Signup</button>
        </form>
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
		
		if(isset($_GET['signup-submit'])){
			$username = $_GET['uid'];
			$mail = $_GET['visitor_email'];	
			$signuppassword = $_GET['pwd'];	
			$conpassword = $_GET['pwd-repeat'];				
			
			 
			if(!strcmp($signuppassword,$conpassword))
			{
				$sql = "INSERT INTO user (userName, email, password) VALUES ('$username', '$_GET[visitor_email]', '$signuppassword')";
				
				if (!mysqli_query($conn, $sql)) 
				{ 
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
				else
				{
					 session_start();
					 $_SESSION["Username"]=$username;
					 $_SESSION["Pass"]=$signuppassword;
					 $_SESSION["Email"]=$mail;
					 
					   header('Location: dashboard.php'); exit; 
					header('Location: dashboard.php'); exit;
				}					
			}
			else
			{
				echo "passwords do not match";
			}				
	
		 		
		}
			 		
		mysqli_close($conn);
		?>
</div>
</div>
</section>

<!-- About-->
<section id="courses" style="width: max-width; height: 700px;padding-top:70px; background-color: rgb(235, 242, 252)">
  <div class="container py-3">
    <div class="row mt-4">
      <?php
        $query = "select * from courses";
        require 'dbConnect.php';
        $query_run = mysqli_query($conn, $query);
        $check =  mysqli_num_rows($query_run) > 0;
		$counter=4;
        if($check)
        {
			
			
          while($counter)
          {
			  $row = mysqli_fetch_array($query_run);
			  $counter=$counter-1;
            ?>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <img src="Images/<?php echo $row['courseName']; ?>.jpg" class="card-img-top" alt="">
                  <h2 class="card-title"> <?php echo $row['courseName']; ?> </h2>
                  <p class="card-text">  <?php echo $row['courseDesc']; ?> </p>
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
       <div class="container text-center" style="padding:10px">
          <a class="btn btn-primary btn-lg" href="Courses.php" role="button" style="width:150px;background-color:#cc0066">Show more </a>
       </div>
    
                
</section>
<!--experience-->
<section id="programs" style="width: max-width; height: 750px; padding-top:50px; background-color: rgb(157, 179, 212);">
                        
</section>

<!---education--->
<section id="teachers" style="width: max-width; height: 500px;padding-top:50px; background-color: rgb(132, 163, 209)">
                            
</section>

<!--skill-->
<section id="contactus" style="width: max-width; height: 750px;padding-top:50px; background-color: rgb(157, 179, 212)">
        <form style="padding-top:200px;padding-left:500px">
  
  <div>
    <label for="name">Your Name</label>
    <input type="text" id="name" name="visitor_name" placeholder="John Doe" pattern=[A-Z\sa-z]{3,20} required>
  </div>
  <div>
    <label for="email">Your E-mail</label>
    <input type="email" id="email" name="visitor_email" placeholder="john.doe@email.com" required>
  </div>
  <div>
    <label for="title">Reason For Contacting Us</label>
    <input type="text" id="title" name="email_title" required placeholder="Unable to Reset my Password" pattern=[A-Za-z0-9\s]{8,60}>
  </div>
  <div>
    <label for="message">Write your message</label>
    <textarea id="message" name="visitor_message" placeholder="Say whatever you want." required></textarea>
  </div>
  <button type="submit" name="contactus-submit">Send Message</button>
  </div>
</form>      
<?php
 /* 
if(isset($_GET['contactus-submit'])) {
    $visitor_name = "";
    $visitor_email = "";
    $email_title = "";
    $visitor_message = "";
    $email_body = "<div>";
      
    if(isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Visitor Name:</b></label>&nbsp;<span>".$visitor_name."</span>
                        </div>";
    }
 
    if(isset($_POST['visitor_email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Visitor Email:</b></label>&nbsp;<span>".$visitor_email."</span>
                        </div>";
    }
      
    if(isset($_POST['email_title'])) {
        $email_title = filter_var($_POST['email_title'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Reason For Contacting Us:</b></label>&nbsp;<span>".$email_title."</span>
                        </div>";
    }
      
    
      
    if(isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
        $email_body .= "<div>
                           <label><b>Visitor Message:</b></label>
                           <div>".$visitor_message."</div>
                        </div>";
    }
      
   
        $recipient = "tasnianabila3121@gmail.com";
    
      
    $email_body .= "</div>";
 
    $headers  = 'MIME-Version: 1.0' . "\r\n".'Content-type: text/html; charset=utf-8' . "\r\n".'From: ' . $visitor_email . "\r\n";
      
    if(mail($recipient, $email_title, $email_body, $headers)) {
        echo "<p>Thank you for contacting us, $visitor_name. You will get a reply within 24 hours.</p>";
    } 
	else {
        echo '<p>We are sorry but the email did not go through.</p>';
    }
      
	}
	else {
		echo '<p>Something went wrong</p>';
	}*/
	
	/*$to_email = "tasnianabila3121@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "test email";
$headers = "From: helaluddin208@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}*/
?>
                
</section>
</body>
</html>