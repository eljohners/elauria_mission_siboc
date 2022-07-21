<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "milktea";
$conn =mysqli_connect($servername,$username, $password, $db);
session_start();
if(isset($_SESSION["login"]))
{ 
$orderid=uniqid();
$id=$_SESSION["login"]; 

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mang Juan's MilkTea</title>
  <link rel="stylesheet" type="text/css" href="checkout.css">
  <link rel="icon" type="image" href="images/logo2.png">
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
  <style>
    body {
      background-color: #eff8ff;  
    }
  </style>
  <nav class="navbar-style navbar-fixed-top">
        <div class="container" id="head">
            <div class="navbar-header">
                
             <a href="index.php"><img class="logo" src="logo2.png"><p id="h3">Mang Juan's <br> MilkTea</p></a>
             </div>

        </div>
    </nav><br><br><br><br><br>


<div class="all_info">
  <h1 id="del">Delivery details:</h1>
  <?php
  $query = "SELECT * FROM customer WHERE customer_id='$id'";
  $result=mysqli_query($conn,$query);
  while($row=mysqli_fetch_assoc($result))
     {
      $fn=$row['firstname'];
      $ln=$row['lastname'];
      $contact=$row['contact'];
      $address=$row['address'];
      $email=$row['email'];
      $fullname=$row['firstname']." ".$row['lastname'] ;
     }
  ?>
  <table id="customer">
    <tr>
      <td id="customer_details"><h2><b>Customer Name:</b></h2> </td>
      <td id="customer_details"><b><?php echo " ".$fn." ".$ln  ?></b></td>
    </tr>
    <tr>
      <td id="customer_details"><h2><b>Contact Number:</b></h2></td>
      <td id="customer_details"><b><?php echo " ".$contact ?></b></td>
    </tr>
    <tr>
      <td id="customer_details"><h2><b>Email Address:</b></h2></td>
      <td id="customer_details"><b><?php echo $email ?></b></td>
    </tr>
    <tr>
      <td id="customer_details"><h2><b>Address:</h2></b></td>
      <td id="customer_details"><b><?php echo $address ?></b></td>
    </tr>
  </table>
  <h1 id="del">Order details:</h1>
  
  <div id="order">
  <table id="table">
    <thead>
      <tr>
            <td id="td"><h1>Milktea</h1></td>
            <td id="td"><h1>Size</h1></td>
            <td id="td"><h1>Quantity</h1></td>
            <td id="td"><h1>Price</h1></td>
            <td id="td"><h1>Total Price</h1></td>
      </tr>
    </thead>
<?php
  $tp=0;
  $sql = "SELECT * FROM cart WHERE customer_id='$id'";
  $sqlresult=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_assoc($sqlresult))
     {?>
     <tr>
      <input type="hidden" name="cart_id" value="<?php echo $row['cart_id'];?>">
      <input type="hidden" name="milktea_id" value="<?php echo $row['milktea_id'];?>">
      <td id="order_details"><h2><?php echo $row['name'];?></h2></td>
      <input type="hidden" name="name" value="<?php echo $row['name'];?>">
      <td id="order_details"><h2><?php echo $row['size']; ?></h2></td>
      <input type="hidden" name="size" value="<?php echo $row['size'];?>">
      <td id="order_details"><h2><?php echo $row['quantity']; ?></h2></td>
      <td id="order_details"><h2><?php echo $row['price']." Each"; ?></h2></td>
      <input type="hidden" name="price" value="<?php echo $row['price'];?>">
      <td id="order_details"><h2>₱<?php echo $row['quantity'] * $row['price'];?></h2></td>
      <?php $tp= $tp + ($row['price'] * $row['quantity']); ?>
    </tr>
  <?php 
     }
  ?>
     <tr>
      <td id="order_details" colspan="2"><h2>Amount To Pay:</h2></td>
      <td id="order_details"><h2>Shipping Fee: ₱50</h2></td>
      <td id="order_details" colspan="2" style="color: red;"><h2>Total of ₱<?php echo $tp+50; $total=$tp+50;?></h2></td>

    </tr>
  </table>
  </div>
  <form method="POST" action="" onSubmit="return confirm('Are you sure?')">
  <button id="buy" name="order">Order</button>
  </form>
</div>
<script src="js/main.js"></script>
 </body>
 </html>
 <?php 
}
else
{
  echo "<script>window.location.href = 'index.php';</script>";  
}

if(isset($_POST['order']))
{
  $show = "SELECT * FROM cart WHERE customer_id='$id'";
  $showing=mysqli_query($conn,$sql);
  while($det=mysqli_fetch_assoc($showing))
     {
    $cart_id=$det['cart_id'];
    $milktea_id=$det['milktea_id'];
    $milktea_name=$det['name'];
    $size=$det['size'];
    $price=$det['price'];
    $quantity=$det['quantity'];
    


$insert = "INSERT INTO ordertbl(order_id,name,email,contact,address,cart_id,milktea_id,milktea,quantity,size,price,tprice) VALUES ('$orderid','$fullname','$email','$contact','$address','$cart_id','$milktea_id','$milktea_name','$quantity','$size','$price','$total')";

    if(mysqli_query($conn,$insert))
    {
        $sql = "DELETE From cart Where cart_id = '$cart_id'";
        if(mysqli_query($conn, $sql))
        {
        echo '<script>alert("A Milktea successfully remove from the menu"); window.location="index.php";</script>';
        }

    }
    else
    {
    $error = $insert.mysqli_error($conn);
    echo '<script>alert("Error:  '.$error.'")</script>';
    }
 }

}
?>
