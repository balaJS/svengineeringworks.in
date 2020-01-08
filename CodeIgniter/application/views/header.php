<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<header>
    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <div><img src="<? echo base_url();?>/static/img/sv-engg-logo.png" width="50%"></div>
        <a class="navbar-brand" href="/"><b>SV Engineering</b></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <form action="post" class="form-inline" id="js-search-form">
            <input type="text" class="form-control" name="search_input" />
            <button type="submit" class="btn btn-light">Search</button>
          </form>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="text-white" href="<?php echo site_url();?>/category/list_category">Category</a>
            </li>
          <?php if(!isset($this->session->userdata()['sv_amc'])) { ?>
            <li class="nav-item">
              <a class="text-white" href="<?php echo site_url();?>/users/login">Login/Register</a>
            </li>
            <li class="nav-item">
              <a class="text-white" href="<?php echo site_url();?>/users/reset">Reset password</a>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="text-white" href="<?php echo site_url();?>/user_products/add_form">Add products</a>
            </li>
            <li class="nav-item">
              <a class="text-white" href="<?php echo site_url();?>/users/login">Profile</a>
            </li>
            <li class="nav-item">
              <a class="text-white" href="<?php echo site_url();?>/user_products/mpp">My products</a>
            </li>
            <li class="nav-item">
              <a class="text-white" href="<?php echo site_url();?>/users/logout">Logout</a>
            </li>
          <?php }?>
          </ul>
        </div>
      </div>
    </nav>
</header>