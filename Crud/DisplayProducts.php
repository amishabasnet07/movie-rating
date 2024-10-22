<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Product:</title>
</head>
<body>
<h1>List All Products</h1>
<?php
include 'Connection.php';
$sql = "SELECT * FROM products ORDER BY ProductID DESC";
$qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
$count=mysqli_num_rows($qry);
if($count>=1){
    while($row=mysqli_fetch_array($qry))
    {
        echo $row['ProductName']. " ";
        echo $row['ProductImageName']. " ";
        echo "<img src=\"Image/". "\" alt=".$row['ProductImageName']." width='50px'> ";
        echo $row['ProductRating']. " ";
        echo $row['ProductGenre']. " ";
        echo $row['ProductDescription']. " ";
        echo $row['ProductDuration']. " ";
        echo  "<br/> ";
    }
}
?>