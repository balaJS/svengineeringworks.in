<?php include 'header.php';
  $sql="select * from product where status=? limit 3";
  $query=$conn->prepare($sql);
  $query->execute(array('Y'));
  $banner_alt = $description;
?>
    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active">
            <img class="js-lazy-load" data-src="<?php echo resourceUrl.'/images/banner-1.jpg'; ?>" width="100%" height="auto" alt="<?php echo $banner_alt;?>">
            <div class="carousel-caption d-none d-md-block">
              <h3>Buy and sell second hand machinaries</h3>
              <p>S.V Engineering</p>
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item">
            <img class="js-lazy-load" data-src="<?php echo resourceUrl.'/images/banner-2.jpg'; ?>" width="100%" height="auto">
            <div class="carousel-caption d-none d-md-block">
              <h3>For printing press spareparts ...</h3>
              <p>PRINTING MACHINE WORLD @ 9843317798</p>
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item">
            <img src="<?php echo resourceUrl.'/images/banner-3.jpg'; ?>" width="100%" height="auto">
            <div class="carousel-caption d-none d-md-block">
              <h3>Your all search, rectified here...</h3>
              <p>PRINTING MACHINE WORLD @ 9843317798</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4">Welcome to S.V Engineering</h1>

      <!-- Portfolio Section -->
      <h2>Secondary machinaries here</h2>

      <div class="row">
        <?php while($data=$query->fetch(PDO::FETCH_ASSOC)){?>
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100"><!-- 700*300 -->
            <a href="#"><img class="card-img-top js-lazy-load" data-src="<?php echo resourceUrl.'/images/'.$data['product_image1']; ?>" alt="Buy or sell <?php echo $data['product_name']; ?>"></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="javascript:void(0);"><?php echo $data['product_name']; ?></a>
              </h4>
              <p class="card-text"><?php echo $data['product_desc'];?></p>
              <div class="card-footer">
              <a class="btn btn-lg btn-secondary btn-block" href="tel:<?php echo $mobile1;?>">Make call</a>
              <a class="btn btn-lg btn-secondary btn-block" href="whatsapp://send?text=Machinary name : <?php echo $data['product_name'].' '.baseUrl;?>">Share whatsapp</a>
            </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <!-- /.row -->

      <hr>
    </div>
    <!-- /.container -->

<?php include 'footer.php';?>