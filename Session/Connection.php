<?php
session_start();
$username = "root";
$host = "localhost";
$password = "";
$database = "wat2022";

$conn = mysqli_connect($host, $username, $password, $database) or die("Unable to connect to database");

?>