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
   <br> <br><br> <br><br> <br>

   <!-- FORM --->
  <div class="container" id="sendmessage">

    <div class="row">
      <div class="col-sm-4" id="border">
        <h1 style="text-align: center;">ADD Milktea</h1>
        <form method="POST" action="" id="contactus" enctype="multipart/form-data" onSubmit="return confirm('Do you want to submit?')">
          <h3>Image (jpg, png, jpeg, gif file only)</h3>
          <input type="file" id="img" name="file"><br>
          <h3>Name of Milktea*</h3>
          <input type="text" id="name" name="name" required><br>
          <h3>Description*</h3>
          <textarea name="description" id="message" placeholder="" required></textarea><br>
          <h3>Price for Smallcup</h3>
          <input type="number" id="subject" name="sprice">
          <h3>Price for Mediumcup</h3>
          <input type="number" id="subject" name="mprice">
          <h3>Price for Large</h3>
          <input type="number" id="subject" name="lprice"><br><br>
          <input type="submit" name="submit" value="SUBMIT" id="submit">
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
  if(isset($_FILES['file']))
  {
  $name=$_POST['name'];
  $description=$_POST['description'];
  $sprice=$_POST['sprice'];
  $mprice=$_POST['mprice'];
  $lprice=$_POST['lprice'];


  $img_name = $_FILES['file']['name'];
  $img_size = $_FILES['file']['size'];
  $tmp_name = $_FILES['file']['tmp_name'];
  $error = $_FILES['file']['error'];

  if ($error === 0)
   {
    //Para sa size

      $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_ex_lc = strtolower($img_ex);

      $allowed_exs = array("jpg", "jpeg", "png", "gif"); 

      if (in_array($img_ex_lc, $allowed_exs)) 
      {
        //ito na yung magpapangalan sa file
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        //kung saan iaaupload, dito upload folder
        $img_upload_path = '../milktea/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);


        // Insert into Database
        $sql = "INSERT INTO milktea(name,image,description,small_price,medium_price,large_price)VALUES('$name','$new_img_name','$description','$sprice','$mprice','$lprice')";
        if(mysqli_query($conn, $sql))
        {
        echo '<script>alert("New Milktea added to Menu"); window.location="index.php";</script>';
        }
        else
        {
          echo '<script>alert("ERROR"); window.history.back();</script>';
        }
      }
      else 
      {
        echo '<script>alert("JPG, JPEG , PNG file can only upload"); window.history.back();</script>';
      }

  }
  else
  {
    echo '<script>alert("error"); window.history.back();</script>';
  }

    }
    else
    {
       echo '<script>alert("walang file"); window.history.back();</script>';
    }
}

if(isset($_POST['logout']))
{
    unset($_SESSION["login"]);
    session_destroy();
    echo "<script>window.location.href = 'adminlogin.php';</script>";

}
?>