<?php 
$user_id =$_SESSION['user_id'] ;
 $sql = "SELECT * FROM movies";
 $query = mysqli_query($conn, $sql);
// $movies = mysqli_fetch_assoc($query);
$movies_array = array();
if(mysqli_num_rows($query)>0){
    while($movies = mysqli_fetch_array($query)){
        $sql = "SELECT *,SUM(rating) AS total_rating,COUNT(*) as total_records FROM movie_ratings WHERE movie_id = $movies[id]";
        $query1 = mysqli_query($conn, $sql);
        // $num_rows = mysqli_num_rows($query1);
        // echo $num_rows;die;
        $result = mysqli_fetch_array($query1);
        // echo"<pre>";print_r($result);
        if($result['total_records']>0){
          $movies['total_rating'] = ceil($result['total_rating']/$result['total_records']);
        }else{
            $movies['total_rating'] = ceil($result['total_rating']);
        }
        $movies_array[] = $movies;
    }
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
                  for ($i=1; $i <=5; $i++) { 
                    if($i <=$value['total_rating'] )
                    echo '<span class="" style="color:orange"><i class="fas fa-star"></i>&nbsp;&nbsp;</span>';
                    else
                    echo '<span class="" ><i class="fas fa-star"></i>&nbsp;&nbsp;</span>';

                  }
                ?>
                </p>
                <button type="button" id="" class="btn btn-danger OpenRateModal" movie_id="<?=$value['id']?>"  data-bs-toggle="modal" data-bs-target="#RateModal">Rate this movie</button>
                <a href="user_movies_reviews.php?movie_id=<?=$value['id']?>" type="button" id="" class="btn btn-success OpenRateModal ms-3" movie_id="<?=$value['id']?>" >See User Reviews <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- rate product modal-->
<!-- Modal -->
<div class="modal fade" id="RateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <span class="error_info"></span>
        <form action="" method="post">
        <div class="form-group">
          <label>Review Title</label>
          <input type="text" class="form-control" id="review_title">
        </div>
          <div class="form-group mt-3">
              <label for="">Give Rating</label>
              <br>
              <span class="one_star"><i class="fas fa-star"></i>&nbsp;&nbsp;</span>
              <span class="two_star"><i class="fas fa-star"></i>&nbsp;&nbsp;</span>
              <span class="three_star"><i class="fas fa-star"></i>&nbsp;&nbsp;</span>
              <span class="four_star"><i class="fas fa-star"></i>&nbsp;&nbsp;</span>
              <span class="five_star"><i class="fas fa-star"></i></span>
            
          </div>
          <!-- <div class="form-group mt-3">
            <label for="">Email</label>
            <input type="text" class="form-control" id="ReviewEmail" value="<?= $_SESSION['username'] ?? '';   ?>" readonly>
          </div> -->
          <div class="form-group mt-3">
          <label for="">Write Review </label>
            <textarea name="" id="user_review" cols="30" rows="5" class="form-control"></textarea>
          </div>
          <div class="mt-3">
            <button type="button" class="btn btn-primary" name="SubmitReview">Submit Review</button>
          </div>
        </form>
      </div>
    
    </div>
  </div>
</div>
<!-- rate product modal end-->
<script>
    $(document).ready(function(){
      var movie_id ='';
       $('#OpenRateModal').click(function(){
          
       });
       $(document).on('click','.OpenRateModal',function(){
        movie_id = $(this).attr('movie_id');
       });
        $('.one_star').mouseover(function(){
                  $(this).css("color","orange");
                  $(".two_star,.three_star,.four_star,.five_star").css("color","");
                  rating =1;
              });

              $('.two_star').mouseover(function(){
                 $('.one_star,.two_star').css("color","orange");
                   $(".three_star,.four_star,.five_star").css("color","");
                   rating =2;

              });

              $('.three_star').mouseover(function(){
                  $('.one_star, .two_star, .three_star').css("color","orange");
                   $(".four_star,.five_star").css("color","");
                   rating=3;
              });


              $('.four_star').mouseover(function(){
                 $('.one_star,.two_star,.three_star,.four_star').css("color","orange");
                   $(".five_star").css("color","");
                   rating =4;
              });

              $('.five_star').mouseover(function(){
                 $('.one_star,.two_star,.three_star,.four_star,.five_star').css("color","orange");
                  rating =5;
              });
              var rating =0;
              $('button[name=SubmitReview]').click(function(){
                    
                    var review_title = $('#review_title').val();
                    var email = $('#ReviewEmail').val();
                    var user_review = $('#user_review').val();

                    var rating_check = false;
                    var email_check = false;
                    var review_title_check = false;

                    if(rating == 0)
                    {
                      
                      rating_check = false;
                    }else{

                      rating_check = true;
                    }

                    // if(email == '' || email == null)
                    // {
                      
                    //   email_check = false;
                    // }else{

                    //   email_check = true;
                    // }

                    if(review_title == '' || review_title == null)
                    {
                      
                      review_title_check = false;
                    }else{

                      review_title_check = true;
                    }

                    if(rating_check == false ||  review_title_check == false){

                      $('.error_info').html('<div class="alert alert-danger rating_msg">Rating, title Required</div>');
                    }else{

                      $.ajax({
                        url: 'user_rating_process.php',
                        method: 'post',
                        data: {review_title:review_title,rating:rating,user_review:user_review,movie_id:movie_id},
                        dataType: 'text',
                        success: function(data){
                              if(data == 'false')
                              {
                                $('.error_info').html('<div class="alert alert-danger rating_msg">Error Occured</div>');
                              }else{

                                alert("review Submitted! Thanku");
                                $('#RateModal').modal('hide');
                              }

                        }
                    });
                    }

                    window.setTimeout(function(){

                      $('.rating_msg').hide();
                    },2000);
                });
    });
</script>