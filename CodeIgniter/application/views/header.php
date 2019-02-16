<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

  <head>
  <title>Home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>static/js/site.js" type="text/javascript" defer></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" defer>
  <!-- <link href="<?php echo base_url();?>static/css/modern-business.css" rel="stylesheet"> -->
  <style type="text/css">
  body {
    margin:10px;
    background-color: aliceblue;
    }
    .content_section {
      background-color: papayawhip;
    }
    .row > div {
      margin-top: 0.5em;
    }
     .btn-secondary {
       color: ghostwhite;
     }
     .main-section {
      padding: 4em 0 3em;
     }
  </style>
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <div><img src="<? echo base_url();?>/static/img/sv-engg-logo.png" width="50%"></div>
        <a class="navbar-brand" href="/"><b>SV Engineering</b></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <form action="get" class="form-inline">
            <input type="tetx" class="form-control" name="search_input" />
            <button type="submit" class="btn btn-light">Search</button>
          </form>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="btn btn-secondary" href="<?php echo site_url();?>/category/list_category">Category</a>
            </li>
          <?php if(!isset($this->session->userdata()['sv_amc'])) { ?>
            <li class="nav-item">
              <a class="btn btn-secondary" href="<?php echo site_url();?>/users/login">Login/Register</a>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <div class="dropdown">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                  User
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?php echo site_url();?>/users/login">Profile</a>
                  <a class="dropdown-item" href="<?php echo site_url();?>/user_products/mpp">My products</a>
                  <a class="dropdown-item" href="<?php echo site_url();?>/users/logout">Logout</a>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="btn btn-secondary" href="<?php echo site_url();?>/user_products/add_form">Add products</a>
            </li>
          <?php }?>
          </ul>
        </div>
      </div>
    </nav>