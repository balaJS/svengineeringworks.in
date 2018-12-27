<?php include 'header.php';
$sql="select * from product where status=? ";
$query=$conn->prepare($sql);
$query->execute(array('Y'));
?>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Machinaries
        <!-- <small>Subheading</small> -->
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo baseUrl;?>">Home</a>
        </li>
        <li class="breadcrumb-item active">Machinaries</li>
      </ol>

      <?php 
        while($data=$query->fetch(PDO::FETCH_ASSOC)){
          $alt = strtolower($data['product_name']);
        ?>
      <!-- Project One -->
      <div class="row prod_row">
        <div class="col-md-5">
          <!-- <a href="#"> -->
            <!-- img-fluid  -->
            <!-- <img class="rounded mb-3 mb-md-0 js-lazy-load img_6_5" data-src="<?php echo resourceUrl.'/images/'.$data['product_image1'];?>" alt="<?php echo $alt;?>" style="width: 96%;height: 50%;"> -->
          <!-- </a> -->
          <img class="rounded mb-3 mb-md-0 js-lazy-load img_6_5" data-src="<?php echo resourceUrl.'/images/'.$data['product_image1'];?>" alt="<?php echo $alt;?>" style="width: 96%;">
          </a>
        </div>
        <div class="col-md-4">
          <h3><?php echo $data['product_name'];?></h3>
          <p><?php echo $data['product_desc'];?></p>
          <a class="btn btn-primary" href="tel:<?php echo $mobile1;?>">Call more details
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
        <div class="col-md-3">
          //vendor
        </div>
      </div>
      <!-- /.row -->
      <hr>
      <?php }?>

    </div>
    <!-- /.container -->

<?php include 'footer.php';?>