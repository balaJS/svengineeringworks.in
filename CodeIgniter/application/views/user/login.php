<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login/Register form</title>
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
<div class="row">
<div class="container col-md-5">
  <h4>Login form</h4>
  <form action="<?php echo site_url('users/do_login');?>" method="post">
    <div class="form-group">
      <label for="email">Email / Mobile:</label>
      <input type="text" class="form-control" placeholder="Enter email" name="email" required>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" placeholder="Enter password" name="pwd" required>
    </div>
    <?php if(isset($error_login)) echo "<p class='alert alert-danger'>$error_login</p>"; ?>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>

<div class="container col-md-5">
  <h4>Register form</h4>
  <form action="<?php echo site_url('users/do_register');?>" method="post">
    <div class="form-group">
      <label for="email">User name:</label>
      <input type="text" class="form-control" placeholder="Enter user name" name="uname" required>
    </div>
    <div class="form-group">
      <label for="email">Email / Mobile:</label>
      <input type="text" class="form-control" placeholder="Enter email" name="email" required>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" placeholder="Enter password" name="pwd" required>
    </div>
    <?php if(isset($error)) echo "<p class='alert alert-danger'>$error</p>"; ?>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
</div>
</div>

</body>
</html>
