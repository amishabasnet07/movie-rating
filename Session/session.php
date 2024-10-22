<?php
session_start();
?>

<h3> Login </h3>
<form method = "POST" action = "login.php">
    <input type = "text" name = "txtUser" value = ''/>
    <input type = "password" name = "txtpass" />
    <input type = "submit" name = "sublogin" value = "Login"/>
</form>
<?php
if(isset($_SESSION['Username']))
{
    header('location:loginForm.php');
}
?>