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
	<title>LogIn</title>

	<link rel="stylesheet" type="text/css" href="adminlogindesign.css">

  <link rel="manifest" href="../manifest.json">
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
	<form action="" method="POST">
		<h1 id="welcome">Welcome <br>Mang Juan!!</h1><img src="logo2.png" id="logo">
		<p id="sign">USERNAME</p>
		<input type="text" name="username" class="tb1"  required> <br>
		<p id="sign">PASSWORD</p>
		<input type="password" name="loginpassword" class="tb1" required>
		<br>
		<input type="submit" name="login" value="Login" class="tb2">
	
	</form>
	<script src="../js/main.js"></script>
</body>
</html>

<?php
if(isset($_POST['login']))
{
	$username=$_POST['username'];
	$password=$_POST['loginpassword'];
	$query = "SELECT * FROM admin WHERE username='$username' AND password ='$password'";
	$result=mysqli_query($conn,$query);
	$count =mysqli_num_rows($result);

	if ($count == 0)
		{
			echo '<script>alert("WRONG Username or Password")</script>';
		}

		else
		{
			 $_SESSION["login"]=$username;
			echo '<script>alert("Welcome admin!")</script>';
			 echo '<script type="text/javascript"> window.location="index.php";</script>';
			/*echo '<script type="text/javascript"> window.location="schedule.php?login=$username";</script>';*/
		}	

}
?>