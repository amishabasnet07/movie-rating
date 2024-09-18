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
      <?php include_once('movies_list.php');?>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
   
  });
</script>
<?php  include_once("./footer.php");?>
