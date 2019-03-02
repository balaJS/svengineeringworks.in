<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($this->session->userdata()['sv_amc'])) {
	$this->load->view('header');
	$this->load->view('user/login');
	exit;
}
?>

<section class="main-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2 class="text-center">List of your products</h2>
                </div>
            </div>
        </div>
        <?php
        if(!count($data)) {
            echo "<p class='text-center'><b>You don't have any product. If you add product,check add product button:)</b></p> </div></section>";
            return;
        }
        foreach($data['category'] as $row) { ?>
        <div class="js-category row">
            <a href="<?php echo site_url();?>/products/list_products/<?php echo $row['cat_slug'];?>"><h1><?php echo $row['cat_name'];?></h1></a>
            <?php foreach($data['cat_id-'.$row['cat_id']] as $product) {?>
            <div class="js-product row">
                <div class="col-md-4">
                    <img src="<?php echo base_url();?>static/img/products/<?php echo $product['product_image1'];?>" alt="<?php echo $product['product_name'];?>" class="img img-thumbnail"/>
                </div>
                <div class="col-md-8">
                    <a href="<?php echo site_url();?>/products/view_product/<?php echo $product['product_cat'].'/'.$product['product_slug'];?>" class="js-prod-name">
                        <strong class="text-center"><?php echo $product['product_name'];?></strong>
                    </a>
                    <div class="row">
                    <div class="col-md-6">
                           <strong>Specifications:</strong>
                            <div class="attirubutes_div">
                                <?php 
                                $attributes = json_decode($product['product_spec'], true);
                                foreach(array_keys($attributes) as $key) { 
                                ?>
                                <div><span><?php echo $key;?></span>: <span><?php echo $attributes[$key];?></span></div>
                            <?php } ?>
                            </div>
                    </div>
                    <div class="col-md-3">
                        <strong> Rs <?php echo $product['product_price'];?></strong>
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo site_url('user_products/edit/'.$product['product_cat'].'/'.$product['product_slug']);?>"><i class="fas fa-pen-square btn btn-dark btn-sm" title="Edit product"></i></a>
                        <a href="#" class="js-delete-btn"><i class="fa fa-trash btn btn-dark btn-sm" title="Delete product"></i></a>
                    </div>
                    </div>
                    <div>
                        <a href="<?php echo site_url();?>/Products/view_product/<?php echo $product['product_slug'];?>">Read more</a>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
        
        <?php } ?>
    </div>
</section>