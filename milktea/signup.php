<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "milktea";
$conn =mysqli_connect($servername,$username, $password, $db);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mang Juan's MilkTea</title>
  <link rel="stylesheet" type="text/css" href="signup_design.css">
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


    <!-- body -->
<div class="box">
<h1 id="header">Create An Account</h1>
<form method="POST" class="booking" action="" name="appointment"  onSubmit="return confirm('Do you want to submit?')">
<div class="fullname">
  <div class="firstname">
  <p id="fn">FIRST NAME*</p> 
  <input type="text" name="fname" id="fname" placeholder="" required="">
  </div>

  <div class="lastname">
  <p id="ln">LAST NAME*</p>
  <input type="text" name="lname" id="lname" placeholder="" required="">
  </div>
</div>

<div class="fullname">
  <div class="firstname">
  <p id="ln">Email*</p>
  <input type="email" name="emailadd" id="fname" placeholder="" required="">
  </div>
    <div class="lastname">
  <p id="fn">password*</p> 
  <input type="password" name="password" id="fname" required="">
  </div>
  
</div>

<div class="firstname">
  <p id="fn">Phone*</p> 
  <input type="tel" name="contact" id="fname"  placeholder="09000000000" pattern="[0-9]{4}[0-9]{3}[0-9]{4}" required="" style="width: 50%;">
  </div>


<div class="address">
  <p id="fn">Address</p> 
  <input type="text" name="address" id="fname">
  </div>
<input type="submit" name="sure" value="SUBMIT" id="submit">
</form>
</div>

</div>
<script src="js/main.js"></script>
 </body>
 </html>

<?php
/*if the button click */
if(isset($_POST['sure']))
{
 /*Getting variables from form*/
  $fn=$_POST['fname'];
  $ln=$_POST['lname'];
  $contact=$_POST['contact'];
  $password=$_POST['password'];
  $email=$_POST['emailadd'];
  $address=$_POST['address'];

/*Inserting data on Database*/
$sql="INSERT INTO customer (firstname,lastname,contact,email,password,address) values ('$fn','$ln','$contact','$email','$password','$address')";

    /*If Inserting data is successfull */
    if(mysqli_query($conn,$sql))
    {
      echo '<script type="text/javascript">'; 
      echo 'alert("account has been created");';
      echo 'window.location.href = "login.php";';
      echo '</script>';
    }
    /*If Inserting data is NOT successfull */
    else
    {
    $error = $sql.mysqli_error($conn);
    echo '<script>alert("Error:  '.$error.'")</script>';
    mysqli_close($conn);
    }
}
?>