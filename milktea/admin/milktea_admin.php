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
  <link rel="stylesheet" type="text/css" href="milktea_admin_design.css">
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
   <!-- Table of Milktea -->
   <div id="wholetable">
   <table class="table">
      <tr>
            <th scope="col" id="th">Image</th>
            <th scope="col" id="th">Name</th>
            <th scope="col" id="th">description</th>
            <th scope="col" id="th">price for Small cup</th>
            <th scope="col" id="th">price for Medium cup</th>
            <th scope="col" id="th">price for Large cup</th>
            <th scope="col" id="th">Action</th>
          </tr>

    <tr>
    <?php
    $sqladmin = "SELECT * FROM milktea Order by milktea_id ASC ";
    $result = mysqli_query($conn,$sqladmin);
    if (mysqli_num_rows($result) > 0) 
    {
    while($row = mysqli_fetch_array($result))
    {
    ?>
    <form method="POST" class="booking" action="" name="action" onSubmit="return confirm('Are you sure')" >
    <input type="hidden" name="id" value=<?php echo $row["milktea_id"]; $new_id=$row["milktea_id"];?>>
    <td scope="row" id="th4"><img src="<?php echo '../milktea/'.$row['image']; ?>" id="img_milktea"></td><input type="hidden" name="img" value=<?php echo $row["image"]; ?>>
    <td id="th4"><?php echo $row['name'];?></td><input type="hidden" name="name" value=<?php echo $row["name"]; ?>>
    <td id="th3"><div style="max-height: 100px"><?php echo $row['description'];?></td><input type="hidden" name="desc" value=<?php echo $row["description"]; ?>></div>
    <td id="th4"><?php echo $row['small_price'];?></td><input type="hidden" name="sprice" value=<?php echo $row["small_price"]; ?>>
    <td id="th4"><?php echo $row['medium_price'];?></td><input type="hidden" name="mprice" value=<?php echo $row["medium_price"]; ?>>
    <td id="th4"><?php echo $row['large_price'];?></td><input type="hidden" name="lprice" value=<?php echo $row["large_price"]; ?>>
    <td id="deliver"><a href="edit_milktea.php?id=<?php echo $new_id;?>" ><input type="button" value="Edit" id="button"></a><br><br><input type="submit" name="delete" value="Delete" id="button" onSubmit="return confirm('Are you sure')" ></td>
    </form>
    </tr>
    <?php
    }
    }
    ?>
   </table>
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

if(isset($_POST['delete']))
{
  $id=$_POST['id'];
   $sql = "DELETE From milktea Where milktea_id = '$id'";
        if(mysqli_query($conn, $sql))
        {
        echo '<script>alert("A Milktea successfully remove from the menu"); window.location="milktea_admin.php";</script>';
        }
        else
        {
          echo '<script>alert("ERROR"); window.history.back();</script>';
        }
}

if(isset($_POST['logout']))
{
    unset($_SESSION["login"]);
    session_destroy();
    echo "<script>window.location.href = 'adminlogin.php';</script>";

}
?>