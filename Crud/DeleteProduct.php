<?php
//include 'Connection.php';
//if(isset($_GET['delete'])){
    //$ProductID = $_GET['delete'];
    //mysqli_query($conn, "DELETE FROM products Where ProductID = $ProductID");
    //header('location:Crud.php');
//};

//checking id and action is set or not
if(isset($_GET['delete']))
{
    $delid=$_GET['delete'];
    //SQL Statement for Delete
    $sql = "DELETE FROM products WHERE ProductID =$delid";
    //making connection
    include_once("Connection.php");
    //executing query
    $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if($qry)
    {
        header("location:Crud.php");
    }
}
else
{
    header("location:Crud.php");
}
?>
