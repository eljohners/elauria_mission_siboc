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
      <link rel ="stylesheet" type="text/css" href="order_design.css">
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

   <!-- Table of Milktea -->
   <div id="wholetable">
   <table class="table">
      <tr>
            <th scope="col" id="th">Order_id</th>
            <th scope="col" id="th">Time</th>
            <th scope="col" id="th">Name</th>
            <th scope="col" id="th">Email</th>
            <th scope="col" id="th">Contact</th>
            <th scope="col" id="th">Address</th>
            <th scope="col" id="th">Cart_id</th>
            <th scope="col" id="th">Milktea_id</th>
            <th scope="col" id="th">Milktea</th>
            <th scope="col" id="th">Quantity</th>
            <th scope="col" id="th">Size</th>
            <th scope="col" id="th">price</th>
            <th scope="col" id="th">Total price</th>
            <th scope="col" id="th">Action</th>
          </tr>
<?php
$sqladmin = "SELECT * FROM ordertbl order by order_time asc";
$result = mysqli_query($conn,$sqladmin);

$order_time="";
$order_id_again="";
$nameagain="";
$contactagain="";
$emailagain="";
$addressagain="";
$cart_id="";


$tpagain="";
$deleteagain="";

if (mysqli_num_rows($result) > 0) 
{
    while($row = mysqli_fetch_array($result))
    {
?>
<tr>
            <!--for time check out -->
            <?php       
            if($row['order_id']!==$order_id_again)
            {
            ?>
            <td style="border-bottom: solid grey 2px; border-top: solid black 3px; "><?php echo $row['order_id'];?>
            <input type="hidden" name="order_id" value="<?php echo $row['order_id'];?>"></td>
            <?php $order_id_again=$row['order_id'];?>
            <?php
            }
            else
            {?>
            <td style="border-bottom: solid black 2px; border-top: solid grey 2px;"></td>
            <?php     
            }
            ?>
            <!--end of time check out -->

         

            <?php       
            if($row['order_time']!==$order_time)
            {
            ?>
            <td style="border-bottom: solid grey 2px; border-top: solid black 3px; "><?php echo $row['order_time'];?></td>
            <?php $order_time=$row['order_time'];?>
            <?php
            }
            else
            {?>
            <td style="border-bottom: solid black 2px; border-top: solid grey 2px;"></td>
            <?php     
            }
            ?>

            <!--for customername -->
            <?php       
            if($row['name']!==$nameagain)
            {
            ?>
            <td style="border-bottom: solid grey 2px; border-top: solid black 3px; "><?php echo $row['name'];?></td>
            <?php $nameagain=$row['name'];?>
            <?php
            }
            else
            {?>
            <td style="border-bottom: solid black 2px; border-top: solid grey 2px;"></td>
            <?php     
            }
            ?>
            <!--end of customername -->


              <!--for email -->
            <?php       
            if($row['email']!==$emailagain)
            {
            ?>
            <td style="border-bottom: solid grey 2px; border-top: solid black 3px; "><?php echo $row['email'];?></td>
            <?php $emailagain=$row['email'];?>
            <?php
            }
            else
            {?>
            <td style="border-bottom: solid black 2px; border-top: solid grey 2px;"></td>
            <?php     
            }
            ?>
            <!--end of email -->

            <!--for contactnum -->
            <?php       
            if($row['contact']!==$contactagain)
            {
            ?>
            <td style="border-bottom: solid grey 2px; border-top: solid black 3px; "><?php echo $row['contact'];?></td>
            <?php $contactagain=$row['contact'];?>
            <?php
            }
            else
            {?>
            <td style="border-bottom: solid black 2px; border-top: solid grey 2px;"></td>
            <?php     
            }
            ?>
            <!--end of contactnum -->

            <!--for address -->
            <?php       
            if($row['address']!==$addressagain)
            {
            ?>
            <td style="border-bottom: solid grey 2px; border-top: solid black 3px; "><?php echo $row['address'];?></td>
            <?php $addressagain=$row['address'];?>
            <?php
            }
            else
            {?>
            <td style="border-bottom: solid black 2px; border-top: solid grey 2px;"></td>
            <?php     
            }
            ?>
            <!--end of address -->

              <!--for cart_id -->
            <?php       
            if($row['cart_id']!==$cart_id)
            {
            ?>
            <td style="border-bottom: solid grey 2px; border-top: solid black 3px; "><?php echo $row['cart_id'];?></td>
            <?php $cart_id=$row['cart_id'];?>
            <?php
            }
            else
            {?>
            <td style="border-bottom: solid black 2px; border-top: solid grey 2px;"></td>
            <?php     
            }
            ?>
            <!--end of cart_id -->

            <td><?php echo $row['milktea_id'];?></td>
            <td><?php echo $row['milktea'];?></td>
            <td><?php echo $row['quantity'];?></td>
            <td><?php echo $row['size'];?></td>
            <td>₱ <?php echo $row['price'];?></td>
            <!--for address -->
            <?php       
            if($row['tprice']!==$tpagain)
            {
            ?>
            <td>₱<?php echo $row['tprice'];?></td>
            <?php $tpagain=$row['tprice'];
            $der_id=$row['order_id'];
            ?>
            <td id="deliver"><a href="deliver.php?ord_id=<?php echo $der_id;?>">READY TO DELIVER</a></td>
            <?php
            }
            else
            {?>

            <?php     
            }
            ?>
            <!--end of email -->        
</tr>

<?php
      }
}

?>
</table> 
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