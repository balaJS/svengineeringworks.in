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
		<?php 
		foreach($data as $row) { 
			if($row->hadProducts) {
				$opacity = '';
				$href = site_url().'/Products/list_products/'.$row->cat_slug;
				$title= $row->cat_name;
			} else {
				$opacity = 'style="opacity: 0.4"';
				$href = 'javascript:void()';
				$title = 'No products';
			}
		?>	
			<div class="col-md-3" <?php echo $opacity;?>>
				<a href="<?php echo $href;?>" title="<?php echo $title;?>">
					<img src="<?php echo base_url();?>static/img/products/<?php echo $row->cat_image;?>" width="100%" height="auto" alt="<?php echo $row->cat_name;?>">	
					<strong class="text-center"><?php echo $row->cat_name;?></strong>
				</a>
			</div>
		<?php }?>
		</div>
	</div>
</section>
