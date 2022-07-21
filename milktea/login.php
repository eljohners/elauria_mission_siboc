<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "milktea";
$conn =mysqli_connect($servername,$username, $password, $db);
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mang Juan's MilkTea</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="login_design.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

   <link rel="manifest" href="/manifest.json">
  <link rel="icon" type="image" href="logo2.png">
  <link rel="apple-touch-icon" href="logo2.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="white"/>
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="green">
  <meta name="apple-mobile-web-app-title" content="Mang Juan Milktea">
  <meta name="msapplication-TileImage" content="logo2.png">
  <meta name="msapplication-TileColor" content="#green">
</head>
<body>
<nav class="navbar-style navbar-fixed-top">
        <div class="container" id="head">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#micon"> 
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>

                </button>
                
             <a href="admin/index.php"><img class="logo" src="logo2.png"><p id="h3">Mang Juan's <br> MilkTea</p></a>
             </div>
             <div class="collapse navbar-collapse" id="micon">
             <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php">MilkTea</a></li>
            <li><a href="login.php">Login</a></li>
             </ul>
          </div>
        </div>
    </nav>

   <br> <br> <br> <br> <br> <br>
   <h2 style="text-align: center;">Login Form</h2>

<form action="" method="post">

  <div class="container" id="cont">
  	<div class="row">
  		<div class="col-sm-5">
  			<img src="logo2.png" id="logogo">
  		</div>
  		<div class="col-sm-5">
    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
     <input type="submit" name="submit" value="Login" class="sub">   
    <h5 style="text-align:center;">No Account?<a href="signup.php"> Signup</a></h5>
    	</div>
	</div>
  </div>
</form>

<script src="js/main.js"></script>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
	
	$email=$_POST['email'];
	$password=$_POST['psw'];
	$query = "SELECT * FROM customer WHERE email='$email' AND password ='$password'";
	$result=mysqli_query($conn,$query);
	$count =mysqli_num_rows($result);

	if ($count == 0)
		{
			echo '<script>alert("WRONG Username or Password")</script>';
		}

		else
		{
            if (mysqli_num_rows($result) > 0) 
              {
               while($row = mysqli_fetch_array($result))
              {
              	$id=$row['customer_id'];
              }
              }

			 $_SESSION["login"]=$id;
			echo '<script>alert("Welcome to Mang Juans Milktea !")</script>';
			 echo '<script type="text/javascript"> window.location="index.php";</script>';
			/*echo '<script type="text/javascript"> window.location="schedule.php?login=$username";</script>';*/
		}	

}
?>
