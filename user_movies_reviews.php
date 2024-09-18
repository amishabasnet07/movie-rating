<?php  include_once("./header.php");?>
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
        $user_id =$_SESSION['user_id'] ;
        $movie_id =$_GET['movie_id'] ?? 0 ;
        $sql = "SELECT * FROM movies WHERE id = $movie_id";
        $query = mysqli_query($conn, $sql);
           $movies_array = array();
        if(mysqli_num_rows($query)>0){
            while($movies = mysqli_fetch_assoc($query)){
               $sql = "SELECT *,rating AS user_rating FROM movie_ratings
                LEFT JOIN registration ON registration.ID =movie_ratings.user_id   WHERE movie_ratings.movie_id = $movies[id]";
                $query1 = mysqli_query($conn, $sql);
                 while ($row = mysqli_fetch_array($query1)){
                    $movies['user_reviews'][] = $row;
                }
              
                // echo"<pre>";print_r($result);
                $movies_array[] = $movies;
            }
        }else{
            echo "<div class='alert alert-danger'>NO Movies Here</div>";
        }
        // echo"<pre>";print_r($movies_array);die;

        ?>
      
    <?php foreach ($movies_array as $key => $value): ?>
        <div class="card mb-3" style="width:100%">
            <div class="row g-0">
                <div class="col-md-4">
                <img src="<?=$value['image'] ?>" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?=$value['movie_name']?></h5>
                        <p class="card-text"><?=$value['description']?></p>
                        <p class="card-text"><b>Casts:</b> <?=$value['cast']?></p>
                        <p class="card-text"><b>Genre:</b> <?=$value['genre']?></p>
                        <p class="card-text"><b>Directors:</b> <?=$value['director']?></p>
                            
                        <p class="card-text"><small class="text-muted"> <b>Duration:</b> <?=$value['duration']?></small></p>
                        <p class="card-text"><small class="text-muted">Release On:&nbsp;<?=$value['released_on']?></small></p>
                        <p>
                        <?php
                        // for ($i=1; $i <=5; $i++) { 
                        //     if($i <=$value['user_rating'] )
                        //     echo '<span class="" style="color:orange"><i class="fas fa-star"></i>&nbsp;&nbsp;</span>';
                        //     else
                        //     echo '<span class="" ><i class="fas fa-star"></i>&nbsp;&nbsp;</span>';

                        // }
                        ?>
                        </p>
                        <?php if(isset($value['user_reviews'])): ?>
                        <?php foreach ($value['user_reviews'] as $key => $value) :?>
                            <div class="row mb-2">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="mb-1"><?=$value['username']?>&nbsp;&nbsp;
                                        <span class="badge bg-success"><?php echo $value['user_rating'] ?><span class="" ><i class="fas fa-star"></i>&nbsp;&nbsp;</span></span>
                                        </p>
                                        <p><?=$value['review']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
   
  });
</script>
<?php  include_once("./footer.php");?>
