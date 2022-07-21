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
  <title></title>
  <link rel="stylesheet" type="text/css" href="cart_design.css">
  <link rel="icon" type="image" href="logo2.png">
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

 <?php
    $query = "SELECT * FROM cart WHERE customer_id='$id'";
    $result=mysqli_query($conn,$query);
    $count = mysqli_num_rows($result);
    
    if($count==0)
    {
        echo "<h1 id='empty'> Your Cart is Empty!</h1>";
    }
    else
    {
?>
        <table>
    <thead>
        <tr>
            <td id="td">Milktea</td>
            <td id="td">Size</td>
            <td id="td">Quantity</td>
            <td id="td">Price</td>
            <td id="td">Total Price</td>
            <td id="td">Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $total=0;
        $ord = "SELECT * FROM cart WHERE  customer_id ='$id'";
        $result=mysqli_query($conn,$ord);
        while($details=mysqli_fetch_assoc($result))
         {?>
         <tr>
            <form method="POST" action="">
            <input type="hidden" name="cart_id" value=<?php echo $details["cart_id"];?>>
            <td><?php echo $details["name"]; ?></td>
            <td><?php echo $details["size"]; ?></td>
            <td><?php echo $details["quantity"]; ?></td>
            <td><?php echo $details["price"]; ?></td>
            <td><?php echo $details["quantity"] * $details["price"] ; ?></td>
            <?php $total = $total + ($details["quantity"] * $details["price"]);?>
            <td><button name="delete" id="delete">x</button></td>
            </form>
        </tr>
        
  <?php
        }?>
        <tr>
        <form method="POST" action="checkout.php">
        <input type="hidden" name="total" value="<?php  $total?>"/>
        <td colspan="4" id="total" >Total</td>
        <td align="right">₱<?php echo $total; ?></td>
        <td><button name="checkout" style="padding: 5px 30px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  border-radius: 10px;
  font-size: 20px;
  position: relative;
  margin: 0 auto; 
  transition: 0.2s all;">Checkout</button>
            
        </td>
        </form>
        </tr>
<?php
    }

if(isset($_POST['delete']))
{
    $del_id=$_POST['cart_id'];
    $delete = "DELETE FROM cart WHERE cart_id='$del_id'";

    if (mysqli_query($conn,$delete)) 
    {
        echo '<script>alert("A product has been removed from your cart")</script>';
        $url1=$_SERVER['REQUEST_URI'];
        header("Refresh: 0; URL=$url1");
    } 
    else 
    {
        echo "Error deleting record: ";
    }

}





    ?>
    </tbody>
</table>
<script src="js/main.js"></script>
 </body>
 </html>
 <?php
}
else
{
  echo "<script>window.location.href = 'index.php';</script>";  
}



if(isset($_POST['logout']))
{
    session_destroy();
    unset($_SESSION["login"]);
    
    echo '<script>alert("Logout")</script>';
    echo "<script>window.location.href = 'index.php';</script>";
}
?>