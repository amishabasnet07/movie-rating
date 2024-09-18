<?php
session_start();
require_once 'Register/config.php';

$rating = $_POST['rating'] ?? 0;
$review_title = $_POST['review_title'] ?? 'sdsd';
$review = $_POST['user_review'] ?? 'xcxx';
$movie_id = $_POST['movie_id'] ?? 1;
$user_id = $_SESSION['user_id'] ;
// var_dump( $user_id);
$date = date('Y-m-d');

$sql = "INSERT INTO `movie_ratings` VALUES ('',$movie_id,$user_id,$rating,'$review','$date')";
$res = mysqli_query($conn,$sql);
if($res == true)
{
    $out = 'true';
}else{
    $out = 'false';
}
echo $out;
?>