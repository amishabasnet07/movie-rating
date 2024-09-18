<?php
include_once("./header.php");
?>

<div class="container">
  <div class="row">
    <div class="col-sm-12 mb-4">
      <nav class="navbar navbar-light" style="background-color: rgb(156, 128, 132) !important;">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="logo.jpg" alt="" width="100" height="100" class="d-inline-block align-text-center">
            Morate
          </a>
        </div>
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-3">
      <?php include_once('sidebar.php');?>
    </div>
    <div class="col-sm-9">
      <?php
      $user_id = $_SESSION['user_id'];
      $sql = "SELECT *, COUNT(*) as review_count
              FROM movies
              LEFT JOIN movie_ratings ON movies.id = movie_ratings.movie_id
              LEFT JOIN registration ON registration.ID = movie_ratings.user_id
              WHERE movie_ratings.user_id = $user_id
              GROUP BY movie_ratings.movie_id
              ORDER BY review_count DESC"; // Order by the number of reviews in descending order
      $query = mysqli_query($conn, $sql);
      
      $movies_array = array();
      if(mysqli_num_rows($query) > 0){
        while($movies = mysqli_fetch_assoc($query)){
          $sql = "SELECT *, SUM(rating) AS total_rating, COUNT(*) as total_records
                  FROM movie_ratings
                  WHERE movie_id = $movies[movie_id]";
          $query1 = mysqli_query($conn, $sql);
          $result = mysqli_fetch_assoc($query1);
          
          $movies['total_records'] = $result['total_records'];
          if($result['total_records'] > 0){
            $movies['total_rating'] = ceil($result['total_rating'] / $result['total_records']);
          }else{
            $movies['total_rating'] = ceil($result['total_rating']);
          }
          $movies_array[] = $movies;
        }
      }else{
        echo "<div class='alert alert-danger'>NO Movies Here</div>";
      }
      ?>
      <?php include_once('reviews_card.php');?>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
   
  });
</script>
<?php include_once("./footer.php");?>
