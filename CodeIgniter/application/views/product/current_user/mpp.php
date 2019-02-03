<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($this->session->userdata()['sv_amc'])) {
	$this->load->view('header');
	$this->load->view('user/login');
	exit;
}

?>

<section class="user-spp">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2 class="text-center">List of your products</h2>
                </div>
            </div>
        </div>
        <?php foreach($data['category'] as $row) { ?>
        <section class="category">
            <a href="<?php echo site_url();?>/products/list_products/<?php echo $row['cat_slug'];?>"><h1><?php echo $row['cat_name'];?></h1></a>
            <?php foreach($data['cat_id-'.$row['cat_id']] as $product) {?>
            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo base_url();?>static/img/products/<?php echo $product['product_image1'];?>" alt="<?php echo $product['product_name'];?>" class="img img-thumbnail"/>
                </div>
                <div class="col-md-8">
                    <a href="<?php echo site_url();?>/products/view_product/<?php echo $product['product_slug'];?>">
                        <strong class="text-center"><?php echo $product['product_name'];?></strong>
                    </a>
                    <div class="row">
                    <div class="col-md-6">
                           <strong>Specifications:</strong>
                            <div class="attirubutes_div">
                                <?php 
                                $attributes = json_decode($product['product_spec'], true);
                                foreach($attributes as $att) { 
                                ?>
                                <div><span><?php echo $att['key'];?></span>: <span><?php echo $att['value'];?></span></div>
                            <?php } ?>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <strong> Rs <?php echo $product['product_price'];?></strong>
                    </div>
                    </div>
                    <div>
                        <a href="<?php echo site_url();?>/Products/view_product/<?php echo $product['product_slug'];?>">Read more</a>
                    </div>
                </div>
            </div>
            <?php }?>
        </section>
        
        <?php } ?>
    </div>
</section>