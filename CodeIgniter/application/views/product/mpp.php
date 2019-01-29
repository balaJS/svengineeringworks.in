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

<section class="content_section">
	<div class="container">
		<?php foreach($data as $row) {?>
		<div class="row">
			
			<div class="col-md-3">
				<a href="<?php echo site_url();?>/Products/view_product/<?php echo $row->product_slug;?>" title="<?php echo $row->product_name;?>">
					<img src="<?php echo base_url();?>static/img/products/<?php echo $row->product_image1;?>" class="img-thumbnail" width="100%" height="auto" alt="<?php echo $row->product_name;?>">
				</a>
			</div>

			<div class="col-md-5">
				<a href="#">
					<strong class="text-center"><?php echo $row->product_name;?></strong>
				</a>
				<div class="row">
					<div class="col-md-6">
						<strong>Specifications:</strong>
						<div class="attirubutes_div">
							<?php 
							$attributes = json_decode($row->product_spec, true);
							foreach($attributes as $att) { 
							?>
							<div><span><?php echo $att['key'];?></span>: <span><?php echo $att['value'];?></span></div>
							<!-- <div><span>Automatic Grade</span>: <span>Automatic</span></div>
							<div><span>Max Printing Length</span>: <span>15-20 Inch,  20-25 Inch</span></div> -->
						<?php } ?>
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
					<strong>Dot Graphics Machinery Company</strong>
				</a>
				<div>
					<span>Ballabhgarh, Faridabad</span>,<br>
					<span>Shahid Bhagat Singh Marg, Bhudatt Colony,</span>,<br>
					<span>India</span>
				</div>
				<button class="btn btn-light">View mobile number</button>
				<button class="btn btn-primary">Contact vendor</button>
			</div>
			
		</div>
	<?php }?>
	</div>
</section>

<footer>
	<a href="<?php echo base_url();?>" class="float-right"> Copy right @ 2019</a>
</footer>

</body>
</html>
