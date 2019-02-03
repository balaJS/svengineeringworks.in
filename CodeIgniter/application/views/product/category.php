<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($this->session->userdata()['sv_amc'])) {
	$this->load->view('header');
	$this->load->view('user/login', ['error_login'=>'Yet not login. Please login']);
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Category page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body style="margin:10px">

<header class="text-center">
  <h3>Welcome to Printing machine world</h3>
</header>

<section>
	<div class="container">
		<div class="row">
		<?php foreach($data as $row) {?>	
			<div class="col-md-3">
				<a href="<?php echo site_url();?>/Products/list_products/<?php echo $row->cat_slug;?>" title="<?php echo $row->cat_name;?>">
					<img src="<?php echo base_url();?>static/img/category/<?php echo $row->cat_image;?>" width="100%" height="auto" alt="<?php echo $row->cat_name;?>">	
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
