<?php
include 'InsertProduct.php';
include 'Connection.php';

// Handle star rating update
if (isset($_POST['update_rating'])) {
    $ProductID = $_POST['ProductID'];
    $MovieRating = $_POST['MovieRating'];
    
    // Update the rating in the database
    $updateRatingQuery = "UPDATE products SET MovieRating = $newRating WHERE ProductID = $ProductID";
    if (mysqli_query($conn, $updateRatingQuery)) {
        // Rating updated successfully
        echo '<script>alert("Rating updated successfully.")</script>';
    } else {
        // Error updating rating
        echo '<script>alert("Error updating rating.")</script>';
    }
}

$select = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="container">
    <div class="product_container">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <h1>Add New Movie</h1>
            <input type="text" placeholder="enter movie name" name="product_name" class="box">
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
            <input type="text" placeholder="enter movie rating" name="product_rating" class="box">
            <input type="text" placeholder="enter movie genre" name="product_genre" class="box">
            <input type="text" placeholder="enter movie description" name="product_description" class="box">
            <input type="text" placeholder="enter movie duration" name="product_duration" class="box">
            <input type="submit" class="btn" name="Add_Product" value="Add Movie">
        </form>
    </div>

    <div class="product-display">
        <table class="product-display-table">
            <thead>
            <tr>
                <th>Movie Name</th>
                <th>Movie Image</th>
                <th>Movie Rating</th>
                <th>Movie Genre</th>
                <th>Movie Description</th>
                <th>Movie Duration</th>
                <th>Action</th>
            </tr>
            </thead>
            <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                <tr>
                    <td> <img src="Image/<?php echo $row['ProductImageName']; ?>" height="100" alt=""></td>
                    <td><?php echo $row['ProductName']; ?></td>
                    <!-- Display star rating -->
                    <td>
                        <div class="star-rating" data-product-id="<?php echo $row['ProductID']; ?>">
                            <?php
                            $rating = $row['MovieRating'];
                            for ($i = 1; $i <= 5; $i++) {
                                $class = ($i <= $rating) ? 'fa-star rated' : 'fa-star-o';
                                echo '<i class="fa ' . $class . '"></i>';
                            }
                            ?>
                        </div>
                       
                    </td>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $row['ProductID']; ?>">
                            <select name="new_rating">
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                            <input type="submit" class="btn" name="update_rating" value="Update Rating">
                        </form>
                    <td><?php echo $row['ProductGenre']; ?></td>
                    <td><?php echo $row['ProductDescription']; ?></td>
                    <td><?php echo $row['ProductDuration']; ?></td>
                    <td>
                        <a href="UpdateProduct.php?edit=<?php echo $row['ProductID']; ?>" class="btn">
                            <i class="fas fa-edit"></i> edit
                        </a>
                        <a href="DeleteProduct.php?delete=<?php echo $row['ProductID']; ?>" class="btn">
                            <i class="fas fa-trash"></i> delete
                        </a>
                        <!-- Add a form to submit star rating changes -->
                        
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
</body>
</html>