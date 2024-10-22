<?php
include 'Connection.php'; 
?>
<?php
if(isset($_POST['Add_Movie'])){
    $MovieName = $_POST['Movie_name'];
    // $MoviePrice = $_POST['Movie_price'];
    $MovieImageName = $_FILES['Movie_image']['name'];
    $MovieRating= $_POST['Movie_Rating'];
    $MovieGenre = $_POST['Movie_Genre'];
    $MovieDescription = $_POST['Movie_Description'];
    $MovieDuration = $_POST['Movie_Duration'];
    
    if(empty($MovieName)  || empty($MovieImageName) || empty($MovieRating) || empty($MovieGenre) || empty($MovieDescription) || empty($MovieDuration)){
        $message[] = 'Please fill out all';
    }
    else{
        $sql = "INSERT INTO Movies(MovieName, MovieImageName,MovieRating,MovieGenre,MovieDescription,MovieDescription,MovieDuration) VALUES ('$MovieName', '$MovieImageName', '$MovieRating', '$MovieGenre', '$MovieDescription', '$MovieDuration')";
        $upload = mysqli_query($conn, $sql);
        if($upload){
            move_uploaded_file($Movie_image_tmp_name, $Movie_image_folder);
            $message[] = 'new Movie added successfully'; 
        }else{
            $message[] = 'could not add the Movie';
        }
    }
}
?>

<?php
if(isset($message)){
    foreach($message as $message){
        echo '<span class = "message">'.$message. '</span>';
    }
}
?>