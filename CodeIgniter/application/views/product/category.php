<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($this->session->userdata()['sv_amc'])) {
	$this->load->view('header');
	$this->load->view('user/login', ['error_login'=>'Yet not login. Please login']);
	exit;
}
?>

<section class="main-section">
<header class="text-center">
  <h3>Welcome to Printing machine world</h3>
</header>
	<div class="container">
		<div class="row">
		<?php foreach($data as $row) {?>	
			<div class="col-md-3">
				<a href="<?php echo site_url();?>/Products/list_products/<?php echo $row->cat_slug;?>" title="<?php echo $row->cat_name;?>">
					<img src="<?php echo base_url();?>static/img/products/<?php echo $row->cat_image;?>" width="100%" height="auto" alt="<?php echo $row->cat_name;?>">	
					<strong class="text-center"><?php echo $row->cat_name;?></strong>
				</a>
			</div>
		<?php }?>
			<!-- 
			<div class="col-md-3">
				<a href="#" title="Category">
					<img src="<?php echo base_url();?>/static/img/balan.jpeg" width="100%" height="auto">	
				</a>
			</div>
			<div class="col-md-3">
				<a href="#" title="Category">
					<img src="<?php echo base_url();?>/static/img/balan.jpeg" width="100%" height="auto">	
				</a>
			</div>
			<div class="col-md-3">
				<a href="#" title="Category">
					<img src="<?php echo base_url();?>/static/img/balan.jpeg" width="100%" height="auto">	
				</a>
			</div> -->

		</div>
	</div>
</section>
