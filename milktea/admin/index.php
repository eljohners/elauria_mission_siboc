<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "milktea";
$conn =mysqli_connect($servername,$username, $password, $db);
session_start();
if(isset($_SESSION["login"]))
{   
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<title>Mang Juan's MilkTea</title>
      <link rel ="stylesheet" type="text/css" href="index_design.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta charset="utf-8">
    <link rel="icon" type="image" href="logo2.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

        <link rel="manifest" href="../manifest.json">
  <link rel="icon" type="image" href="logo2.png">
  <link rel="apple-touch-icon" href="logo2.png">
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
                
             <a href="index.php"><img class="logo" src="logo2.png"><p id="h3">Mang Juan's <br> MilkTea</p></a>
             </div>
             <div class="collapse navbar-collapse" id="micon">
             <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Home</a></li>
            <li><a href="order.php">Orders</a></li>
            <li><a href="milktea_admin.php">MilkTea</a></li>
            <li><a href="new_milktea.php">Add new MilkTea</a></li>
            <li><a><form method="POST" action=""><input type="submit" name="logout" value="LOGOUT" id="logout"></form></a> </li>
             </ul>
          </div>
        </div>
    </nav>

   <br> <br><br> <br>
<?php
$sql = "SELECT * FROM Milktea";
if ($customer=mysqli_query($conn,$sql)) 
{
    $tbl=mysqli_num_rows($customer);
}

$contact = "SELECT * FROM ordertbl";
if ($contacting=mysqli_query($conn,$contact)) 
{
    $contactcount=mysqli_num_rows($contacting);
}


?>
<div class="container" style=" width: 80%; margin-top: 5%;">
	<div class="row">

        <a href="milktea_admin.php">
		<div class="col-sm-3" id="schedule">
            <i class="bi bi-cup-straw"></i>
            <h1><?php echo $tbl;?> Number of Milktea in Menu</h1>
		</div></a>

        <a href="order.php">
		<div class="col-sm-3" id="contact">
            <i class="bi bi-menu-up"></i>
            <h1><?php echo $contactcount;?> New Orders</h1>			
		</div></a>

		
	</div>
</div>
<script src="../js/main.js"></script>
</body>
</html>
<?php
}


else
{
    header("location:adminlogin.php?");
}

if(isset($_POST['logout']))
{
    unset($_SESSION["login"]);
    session_destroy();
    echo "<script>window.location.href = 'adminlogin.php';</script>";
}

?>