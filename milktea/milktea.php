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
  <link rel="stylesheet" type="text/css" href="milktea_design.css">
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

<div class="all">
<div class="items">
   <?php
$sql = "SELECT * FROM milktea";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) 
{
  while($row = mysqli_fetch_array($result))
  {
?>
    <div class="milktea">
      <form method="post" action="">

    <img src="<?php echo 'milktea/'.$row["image"]; ?>" style= "width: 100%;height: 300px;object-fit:contain;cursor: pointer;transform: 0.2s ease;" id="img">
      <br>
      <h3 style=" font-size: 35px; font-weight: bold; text-align: center"><?php echo $row['name'];?><br></h3>
      <h3 style="height: 150px; overflow: scroll; overflow-x: hidden;">Description:<br> <?php echo $row['description'];?> <br></h3>

  <select name="size" required="" style="font-size: 25px; border-radius: 25px;width: 25%;">

      <option value="small">Small: ₱<?php echo $row['small_price'];?></option>

      <option value="medium">Medium: ₱<?php echo $row['medium_price'];?></option>

      <option value="large" >Large: ₱<?php echo $row['large_price'];?></option>
    </select>
      <h4>Quantity:<input type="number" name="quantity" class="quantity1" min=0 max=10 required=""></h4>
      <input type="hidden" name="milktea_id" value="<?php echo $row["milktea_id"]; ?>" />
      <input type="hidden" name="name" value="<?php echo $row["name"]; ?>" />
      <input type="hidden" name="description" value="<?php echo $row["description"]; ?>" />
      <input type="submit" name="addtocart" class="addtocart" value="Add to Cart" id="add2cart">
      </form> 
    </div>

<?php
  }
}
?>
</div>
  </div> 

  <script src="js/main.js"></script>
 </body>
 </html>
 <?php
}
else
{
  echo "<script>window.location.href = index.php';</script>";  
}



if(isset($_POST['logout']))
{
    session_destroy();
    unset($_SESSION["login"]);
    
    echo '<script>alert("Logout")</script>';
    echo "<script>window.location.href = 'index.php';</script>";
}

if(isset($_POST['addtocart']))
{
    $mid=$_POST['milktea_id'];
    $name=$_POST['name'];
    $quan=$_POST['quantity'];
    $size=$_POST['size'];



        $sequel = "SELECT * FROM milktea where milktea_id='$mid'";
         $new=mysqli_query($conn,$sequel);
          if (mysqli_num_rows($new) > 0) 
            {
               while($mt = mysqli_fetch_array($new))
              {
                if($size=="small")
                {
                    $price=$mt['small_price'];
                }
                 elseif($size=="medium")
                {
                    $price=$mt['medium_price'];
                }
                  elseif($size=="large")
                {
                    $price=$mt['large_price'];
                }
              }
            }

    $add2cart="INSERT INTO cart (customer_id,milktea_id,name,quantity,size,price) values ('$id','$mid','$name','$quan','$size','$price')";

    if(mysqli_query($conn,$add2cart))
    {
    echo '<script>alert("Milktea is add to your cart")</script>';
    }
    else
    {
    $error = $add2cart.mysqli_error($conn);
    echo '<script>alert("Invalid Input")</script>';
    }
    mysqli_close($conn);


}
?>