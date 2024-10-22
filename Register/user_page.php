<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <!-- custom css file link  -->

   <link rel="stylesheet" href="dashboard.css">

</head>
<body>
<div class="container">
    <div class="outer-rectangle">
        <div class="inner-rectangle">
          <div class="logo">
            <img src="./images/logo1.jpg" alt="Logo">
            <span class="logo-name">MoRate</span>
          </div>

          <div class="logo-container">
              <div class="logo2">
              <img  src="images/home.jpg" alt="Logo 1" class="logo3">
              <!-- <a href="user.php">Dashboard</a> -->
              <span class="logo2-name" >Dashboard </span>
            
              <img  src="images/myrates.png" alt="Logo 2">
              <span class="logo2-name" >My Rates </span>
           
              <img src="images/myreviews.png" alt="Logo 3">
              <span class="logo2-name">My Reviews</span>
           
              <img src="images/settings.png" alt="Logo 4">
              <span class="logo2-name">Settings</span>
           
              <img  src="images/logout.jpg" alt="Logo 5">
              <span class="logo2-name">Logout</span>
              </div>
          </div> 



         
         <div class="line">
          <span></span>
          <span></span>
          <span></span>
        </div> 
        </div>
      </div>
    </div>
   
<div class="container">

   <div class="content">
      <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>This is an user page</p>
      <a href="login.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html>