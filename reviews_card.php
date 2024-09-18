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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p class="mb-1"><?=$value['username']?>&nbsp;&nbsp;
                                    <span class="badge bg-success"><?php echo $value['total_rating'] ?><span class="" ><i class="fas fa-star"></i>&nbsp;&nbsp;</span></span>
                                    </p>
                                    <p><?=$value['review']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>


