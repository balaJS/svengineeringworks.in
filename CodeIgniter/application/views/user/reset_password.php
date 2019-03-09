<section class="main-section">
<header class="text-center">
  <h3><?php echo $title;?> Password form</h3>
</header>
<form action="<?php echo site_url('users/do_reset');?>" method="post" id="js-add-prod-form">
    <div class="row">
    
        <?php if($isLogin) { ?>
        <div class="col-md-4 offset-md-4">
            <div class="form-group">
            <label for="pname">Old password:</label>
            <input type="password" class="form-control" placeholder="Enter your password" name="old_password" value="" required>
            </div>
        </div>
        <div class="col-md-4 offset-md-4">
            <div class="form-group">
            <label for="pname">New password:</label>
            <input type="password" class="form-control" placeholder="New password" name="new_password" value="" required>
            </div>
        </div>
        <div class="col-md-4 offset-md-4">
            <div class="form-group">
            <label for="pname">Retype password:</label>
            <input type="password" class="form-control" placeholder="Retype password" name="new_password2" value="" required>
            </div>
        </div>
        <?php } else { ?>
        <div class="col-md-4 offset-md-4">
            <div class="form-group">
            <label for="pname">Enter your email/mobile:</label>
            <input type="text" class="form-control" placeholder="Enter your email/mobile" name="emailOrMobile" value="" required>
            </div>
        </div>
        <?php } ?>
        <div class="col-md-4 offset-md-4">
        <?php
        if ($this->session->flashdata('class') !== null && $this->session->flashdata('msg') !== null) { 
            $class = $this->session->flashdata('class');
            $msg = $this->session->flashdata('msg');
            echo "<p class='".$class."'>".$msg."</p>";
        }
        ?>
            <button class="btn btn-primary">Reset</button>
        </div>
    </div>
</form>
</section>