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

$sql = "SELECT * FROM movies";
$query = mysqli_query($conn, $sql);
// $movies = mysqli_fetch_assoc($query);
// echo"<pre>";print_r($movies);
$movies_array = array();
if(mysqli_num_rows($query)>0){
   while($movies = mysqli_fetch_assoc($query)){
       $movies_array[] = $movies;
   }
}
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
               
           </div>
           </div>
       </div>
   </div>
<?php endforeach ?>
    </div>
  </div>
</div>

<?php  include_once("./footer.php");?>

<!-- Footer -->
<!-- rate product modal-->
<div class="modal fade" id="RateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Rating and Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <span class="error_info"></span>
        <form action="" method="post">
        <div class="form-group">
          <label>Review Title</label>
          <input type="text" class="form-control" id="review_title">
        </div>
          <div class="form-group">
              <label for="">Give Rating</label>
              <br>
              <span class="one_star"><i class="fas fa-star"></i>&nbsp;&nbsp;</span>
              <span class="two_star"><i class="fas fa-star"></i>&nbsp;&nbsp;</span>
              <span class="three_star"><i class="fas fa-star"></i>&nbsp;&nbsp;</span>
              <span class="four_star"><i class="fas fa-star"></i>&nbsp;&nbsp;</span>
              <span class="five_star"><i class="fas fa-star"></i></span>
            
          </div>
         
          <div class="form-group">
          <label for="">Write Review </label>
            <textarea name="" id="user_review" cols="30" rows="5" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-primary" name="SubmitReview">Submit Review</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- rate product modal end-->

<script>
  $(document).ready(function() {
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

          if(email == '' || email == null)
          {
            
            email_check = false;
          }else{

            email_check = true;
          }

          if(review_title == '' || review_title == null)
          {
            
            review_title_check = false;
          }else{

            review_title_check = true;
          }

          if(rating_check == false || email_check == false || review_title_check == false){

            $('.error_info').html('<div class="alert alert-danger rating_msg">Rating, title and Email Required</div>');
          }else{

             $.ajax({
              url: 'user_rating_process.php',
              method: 'post',
              data: {review_title:review_title,email:email,rating:rating,user_review:user_review},
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
