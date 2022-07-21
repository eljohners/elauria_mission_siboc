<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "milktea";
$conn =mysqli_connect($servername,$username, $password, $db);
session_start();
if(isset($_SESSION["login"]))
{ 
$id=$_SESSION["login"]; 
?>
<!DOCTYPE html>
 <html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mang Juan's MilkTea</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="icon" type="image" href="images/logo2.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
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
            <li><a href="milktea.php">MilkTea</a></li>
            <?php 
            $query = "SELECT * FROM customer WHERE  customer_id ='$id'";
            $result=mysqli_query($conn,$query);
            if (mysqli_num_rows($result) > 0) 
              {
               while($row = mysqli_fetch_array($result))
              {?>
              <li><a href=""><?php echo $row['firstname']." ". $row['lastname']; ?></a></li>
              <?php
              }
              }
            ?>
            <li><a><form method="POST" action=""><input type="submit" name="logout" value="LOGOUT" id="logout"></form></a> </li>
            <li><a href="cart.php"><i class="bi bi-cart" style="font-size: 35px;"></i></a></li>
             </ul>
          </div>
        </div>
    </nav>
   <br> <br><br> <br><br> <br>
    <div class="container" >
      <div class="row" style="width: 100%;">
        <div class="col-sm-5 ">

            <h1 class="big-text">Mang Juan's </h1>
            <p class="big-text">MilkTea</p>
            <a href="milktea.php" id="book">Order Now</a><br><br>
        </div>
        <div class="col-sm-5 ">
          <img src="images/mj.jpg" class="img-responsive" id="maruya">
          </div>
        
      </div>
    </div>

 </body>
 </html>
 <?php 
}
else
{?>

<!DOCTYPE html>
 <html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mang Juan's MilkTea</title>
  <link rel="stylesheet" type="text/css" href="style.css">
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
                
             <a href="index.php"><img class="logo" src="logo2.png"><p id="h3">Mang Juan's <br> MilkTea</p></a>
             </div>
             <div class="collapse navbar-collapse" id="micon">
             <ul class="nav navbar-nav navbar-right">
            <li><a href="">Home</a></li>
            <li><a href="">MilkTea</a></li>
            <li><a href="login.php">Login</a></li>
             </ul>
          </div>
        </div>
    </nav>
   <br> <br> <br> <br> <br> <br>
    <div class="container" >
      <div class="row" style="width: 100%;">
        <div class="col-sm-5 ">
            <h1 class="big-text">Mang Juan's </h1>
            <p class="big-text">MilkTea</p>
            <a href="" id="book">Order Now</a><br><br>
        </div>
        <div class="col-sm-5 ">
          <img src="images/mj.jpg" class="img-responsive" id="maruya">
          </div>
        
      </div>
    </div>
<script src="js/main.js"></script>
 </body>
 </html>

<?php
}


if(isset($_POST['logout']))
{
    session_destroy();
    unset($_SESSION["login"]);
    
    echo '<script>alert("Logout")</script>';
    echo "<script>window.location.href = 'index.php';</script>";
}
?>




