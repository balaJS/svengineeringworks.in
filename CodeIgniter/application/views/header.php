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
  <link href="<?php echo base_url();?>static/css/modern-business.css" rel="stylesheet">
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
  </style>
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <div style="width: 3%;"><img src="<? echo base_url();?>/static/img/sv-engg-logo.png" width="100%"></div>
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
              <a class="btn btn-secondary" href="<?php echo site_url();?>/Users/login">Login</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-secondary" href="<?php echo site_url();?>/Users/login">Register</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-secondary" href="<?php echo site_url();?>/Category/list_category">Category</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>