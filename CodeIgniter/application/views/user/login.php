<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="main-section">
<header class="text-center">
  <h3>Welcome to Printing machine world</h3>
</header>
<div class="row">
<div class="container col-md-5">
  <h4>Login form</h4>
  <form action="<?php echo site_url('users/do_login');?>" method="post" id="js-login-form">
    <div class="form-group">
      <label for="email">Email / Mobile:</label>
      <input type="text" class="form-control js-reg-unique-field" placeholder="Enter email" name="email" required>
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
  <form action="<?php echo site_url('users/do_register');?>" method="post" id="js-reg-form">
    <div class="form-group">
      <label for="email">User name:</label>
      <input type="text" class="form-control" placeholder="Enter user name" name="uname" required>
    </div>
    <div class="form-group">
      <label for="email">Email / Mobile:</label>
      <input type="text" class="form-control js-reg-unique-field" placeholder="Enter email" name="email" required>
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
</section>