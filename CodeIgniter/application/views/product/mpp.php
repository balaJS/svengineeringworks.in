<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($this->session->userdata()['sv_amc'])) {
	$this->load->view('header');
	$this->load->view('user/login');
	exit;
}
?>
<header class="text-center">
  <h3>Welcome to Printing machine world</h3>
</header>

<section class="main-section">
	<div class="container">
		<?php foreach($data as $row) {?>
		<div class="row">
			
			<div class="col-md-3">
				<a href="<?php echo site_url();?>/Products/view_product/<?php echo $row->product_slug;?>" title="<?php echo $row->product_name;?>">
					<img src="<?php echo base_url();?>static/img/products/<?php echo $row->product_image1;?>" class="img-thumbnail" width="100%" height="auto" alt="<?php echo $row->product_name;?>">
				</a>
			</div>

			<div class="col-md-5">
				<a href="<?php echo site_url();?>/Products/view_product/<?php echo $row->product_cat.'/'.$row->product_slug;?>">
					<strong class="text-center"><?php echo $row->product_name;?></strong>
				</a>
				<div class="row">
					<div class="col-md-6">
						<strong>Specifications:</strong>
						<div class="attirubutes_div">
							<?php 
							$attributes = json_decode($row->product_spec, true);
							foreach(array_keys($attributes) as $key) { 
							?>
							<div><span><?php echo $key;?></span>: <span><?php echo $attributes[$key];?></span></div>
						<?php } ?>
							<!-- <div><span>Automatic Grade</span>: <span>Automatic</span></div>
							<div><span>Max Printing Length</span>: <span>15-20 Inch,  20-25 Inch</span></div> -->
						</div>
					</div>
					<div class="col-md-6">
						<strong> Rs <?php echo $row->product_price;?></strong>
					</div>
				</div>
				<a href="<?php echo site_url();?>/Products/view_product/<?php echo $row->product_slug;?>">Read more</a>
			</div>
			<div class="col-md-4">
				<a href="#">
					<strong><?php echo isset($row->company_name) ? $row->company_name : $row->uname;?></strong>
				</a>
				<div>
					<span><?php echo $row->address;?></span>,<br>
					<span><?php echo $row->city;?></span>,<br>
					<span><?php echo $row->state;?></span>,<br>
					<span><?php echo 'India.';?></span><br>
					
				</div>
				<!-- <button class="btn btn-light">View mobile number</button> -->
				<a class="btn btn-light" href="<?php echo $row->mobile ? 'tel:'.$row->mobile : 'mailto:'.$row->email;?>">Contact vendor</a>
			</div>
			
		</div>
	<?php }?>
	</div>
</section>
