<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['username']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $ageRange = $_POST['age'];
   $term = $_POST['terms'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $usertype = $_POST['user_type'];
   
   $checkuser = "SELECT * FROM registration WHERE email = '$email'";
   $resultt =mysqli_query($conn, $checkuser);
   $count = mysqli_num_rows($resultt);
   if($count>0){
    echo "Error";
   }
   
      if(!isset($_POST['terms'])) {
         echo "please accept the terms and conditions";
      }
      if($pass != $cpass)
      {
         $error[] = 'password not matched!'. "<br>";
      }
      else{
            $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,12}$/';
            if(preg_match($pattern,$pass) == false){
               $error[] = 'Password is not strong!';
           }
           else{
               $password = md5($pass);
               $insert = "INSERT INTO registration(username, email, age, password, user_type) VALUES('$name','$email', '$ageRange','$password', '$usertype')";
               mysqli_query($conn, $insert);
               echo "Successful Inserted";
               header('location:login.php');
           }
        
      };
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="username" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <label for = "ageRange"> Age range: </label>
      <select name = "age" id = "ageRange" required>
         <option value = "under-18"> under-18</option>
         <option value = "18-24"> 18-24 </option>
         <option value = "25-34"> 25-34 </option>
         <option value = "35-44"> 35-44 </option>
         <option value = "45-54"> 45-54 </option>
         <option value = "55-64"> 55-64 </option>
         <option value = "65+"> 65+</option>
   </select>
   <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
   <input type = "checkbox" name = "terms" value = "0" required> I accept the terms and conditions
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>