<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "milktea";
$conn =mysqli_connect($servername,$username, $password, $db);
session_start();
if(isset($_SESSION["login"]))
{   
  $milktea_id=$_GET['id'];
  
?>
<!DOCTYPE html>
 <html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mang Juan's Milktea</title>
  <link rel="stylesheet" type="text/css" href="new_milktea_design.css">
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
   <br> <br>

   <!-- FORM --->
  <div class="container" id="sendmessage">

    <div class="row">
      <div class="col-sm-4" id="border">
        <h1 style="text-align: center;">Edit Milktea</h1>
        <form method="POST" action="" id="contactus" enctype="multipart/form-data" onSubmit="return confirm('Do you want to submit?')">
            <?php
    $sqladmin = "SELECT * FROM milktea where milktea_id ='$milktea_id'";
    $result = mysqli_query($conn,$sqladmin);
    if (mysqli_num_rows($result) > 0) 
    {
    while($row = mysqli_fetch_array($result))
    {
    ?>
          <h3>Name of Milktea*</h3>
          <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br>
          <h3>Description*</h3>
          <textarea name="description" id="message" required><?php echo $row['description']; ?></textarea><br>
          <h3>Price for Smallcup</h3>
          <input type="number" id="subject" name="sprice" value="<?php echo $row['small_price']; ?>">
          <h3>Price for Mediumcup</h3>
          <input type="number" id="subject" name="mprice" value="<?php echo $row['medium_price']; ?>">
          <h3>Price for Large</h3>
          <input type="number" id="subject" name="lprice" value="<?php echo $row['large_price']; ?>"><br><br>
          <input type="submit" name="submit" value="SUBMIT" id="submit">
      <?php 
      }
    }
      ?>
        </form>

      </div>
    </div>  
  </div>

<!-- End of FORM --->
   <script src="../js/main.js"></script>
 </body>
 </html>
<?php
}
else
{
  header("location:adminlogin.php?");
}

if(isset($_POST['submit']))
{
  $name=$_POST['name'];
  $desc=$_POST['description'];
  $sprice=$_POST['sprice'];
  $mprice=$_POST['mprice'];
  $lprice=$_POST['lprice'];
    $update = "UPDATE milktea SET name = '$name', description = '$desc', small_price = '$sprice',medium_price = '$mprice', large_price = '$lprice' WHERE milktea_id='$milktea_id'";
    if (mysqli_query($conn,$update))
    {
       echo '<script>alert("Milktea successfully edit"); window.location="milktea_admin.php";</script>';
    }
    else
    {
    $error = $sql.mysqli_error($conn);
    echo '<script>alert("Error:  '.$error.'")</script>';
    }

}


if(isset($_POST['logout']))
{
    unset($_SESSION["login"]);
    session_destroy();
    echo "<script>window.location.href = 'adminlogin.php';</script>";

}
?>