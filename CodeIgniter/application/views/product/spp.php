<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($this->session->userdata()['sv_amc'])) {
	$this->load->view('header');
	$this->load->view('user/login');
	exit;
}
$product = $data[0][0];
$category = $data[1][0];
$name = $product->product_name;
$prod_slug = $product->product_slug;
$img = $product->product_image1;
$spec = json_decode($product->product_spec);
$spec_class = $product->product_spec ? 'display' : 'hidden';
$desc = $product->product_desc;
$desc_class = $product->product_desc ? 'display' : 'hidden';
$price = $product->product_price;
$price_class = $product->product_price ? 'display' : 'hidden';
$vendor_email = $product->email;
$vendor_mobile = $product->mobile;
$vendor_address = $product->address ? $product->address.',' : '';
$vendor_city = $product->city ? $product->city.',' : '';
$vendor_state = $product->state ? $product->state.',' : '';
$company_name = $product->company_name;
?>

<section class="spp-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <img src="<?php echo base_url();?>static/img/products/<?php echo $img;?>" width="100%" height="510em" alt="<?php echo $name;?>"/>
            </div>
            <div class="col-md-5">
                <br />
                <div><h3 class="text-center"><b><?php echo $name;?></b></h3></div>
                <div>Category: <a href="<?php echo site_url();?>/Products/list_products/<?php echo $category->cat_slug;?>"><b><?php echo $category->cat_name;?></b></a></div>
                <div class="<?php echo $price_class;?>">Price: 
                    <b><?php echo $price;?></b><br />
                    <b class="text-danger">Price will be vary from above amount.</b>
                </div>
                <div class="<?php echo $spec_class;?>">
                    Specification: 
                    <?php foreach($spec as $sp) {?>
                        <div><?php echo $sp->key;?> : <b><?php echo $sp->value;?></b></div>
                    <?php } ?>
                </div>
                <div class="<?php echo $desc_class;?>">
                    Desc: 
                    <p><?php echo $desc;?></p>
                </div>
                <div>
                    <a href="#"><h3 class="text-center"><b><?php echo $company_name;?></b></h3></a>
                    <div>
                        <p>Address</p>
                        <ul class="list-unstyled">
                            <li><?php echo $company_name;?></li>
                            <li><?php echo $vendor_address;?></li>
                            <li><?php echo $vendor_city;?></li>
                            <li><?php echo $vendor_state;?></li>
                            <li><?php echo 'India.';?></li>
                        </ul>
                    </div>
                    <div>
                        Contact them:
                        <?php if(isset($vendor_email) && !empty($vendor_email)) { ?>
                            <a class="btn btn-dark" href="mailto:<?php echo $vendor_email;?>">Mail</a>
                        <?php } ?>
                        <?php if(isset($vendor_mobile) && !empty($vendor_mobile)) { ?>
                            <a class="btn btn-dark" href="tellto:<?php echo $vendor_mobile;?>">Call</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>