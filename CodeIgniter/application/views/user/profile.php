<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($this->session->userdata()['sv_amc'])) {
	$this->load->view('header');
	$this->load->view('user/login');
	exit;
}
#$uname = $data->uname ? $data->uname : '';
$email = $data->email ? $data->email : '';
$mobile = $data->mobile ? $data->mobile : '';
$company = $data->company_name ? $data->company_name : '';
$address = $data->address ? $data->address : '';
$city = $data->city ? $data->city : '';
$state = $data->state ? $data->state : '';

?>
<section class="main-section">
    <h2 class="text-center">Update your profile details</h2>
    <form action="<?php echo site_url('users/profile_update');?>" method="post">
        <div class="container">
        <?php if ($this->session->flashdata('msg') !== null) { ?>
            <p class="alert-success"><?php echo $this->session->flashdata('msg');?></p>
        <?php } ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" placeholder="Enter email" name="email" value="<?php echo $email;?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="number" class="form-control" placeholder="Enter mobile number" name="mobile" value="<?php echo $mobile;?>" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company_name">Company name:</label>
                        <input type="text" class="form-control" placeholder="Enter Company name" name="company_name" value="<?php echo $company;?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea class="form-control" placeholder="Enter address" name="address" rows="4" required><?php echo $address;?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" placeholder="Enter city" name="city" value="<?php echo $city;?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="state">State:</label>
                        <input type="text" class="form-control" placeholder="Enter state" name="state" value="<?php echo $state;?>" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>