<?php
require('Connection.php');

if(isset($_POST['sublogin'])){
    $username = $_POST['txtUser'];
    $password = $_POST['txtpass'];

    $sql = "SELECT * FROM users WHERE Username = '$username' && Password = '$password' ";
    
    $qry = mysqli_query($conn, $sql) or die ("loogin problem");
    $count = mysqli_num_rows($qry);
    if($count==1)
    {
        $_SESSION['Username'] = $username;
        header('location:session.php');
    }
}
?>
