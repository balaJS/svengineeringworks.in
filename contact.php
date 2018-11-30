<?php include 'header.php'; ?>
<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Contact
        <small>S.V Engineering</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo  baseUrl;?>">Home</a>
        </li>
        <li class="breadcrumb-item active">Contact</li>
      </ol>

      <!-- Content Row -->
      <div class="row">
        
        <!-- Contact Details Column -->
        <div class="col-lg-4 mb-4">
          <h3>Contact Details</h3>
          <p>
              <img src="<?php echo resourceUrl;?>/images/sv-engg-logo.png" width="20%" height="auto" alt="S.V.Engineering works"/>
            <br>22/1,Main road,
            <br>Kasthurirengapuram,
            <br>Radhapuram taluk,
            <br>Tirunelveli -627112.
            
          </p>
          <p>
            <abbr title="Phone"><i class="fa fa-whatsapp fa-2x" style="color:green"></i></abbr> <a href="tel:+91<?php echo $mobile1;?>">(+91) <?php echo $mobile1;?></a>
          </p>
          <p>
            <abbr title="Email"><i class="fa fa-envelope fa-2x"></i></abbr>
            <a href="mailto:<?php echo $email;?>"><?php echo $email;?>
            </a>
          </p>
          
        </div>
        <!-- Map Column -->
        <div class="col-lg-8 mb-4">
          <!-- Embedded Google Map -->
          <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.924616766662!2d77.76282401390725!3d8.310290294021375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b047d43d599dc3b%3A0x5a94ab7ea15eeffd!2sS.V.ENGINEERING!5e0!3m2!1sen!2sin!4v1520879527555"></iframe>
        </div>
      </div>
      <!-- /.row -->

      <!-- Contact Form -->
      <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
      <!-- <div class="row">
        <div class="col-lg-8 mb-4">
          <h3>Send us a Message</h3>
          <form name="sentMessage" id="contactForm" method="post" action="mail.php">
            <div class="control-group form-group">
              <div class="controls">
                <label>Full Name:</label>
                <input type="text" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Phone Number:</label>
                <input type="tel" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Email Address:</label>
                <input type="email" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Message:</label>
                <textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
              </div>
            </div>
            
            <div class="g-recaptcha" data-sitekey="6LcUO0wUAAAAAOBLKTGKOPqmPoEVNQncLSM8r1KF"></div>

            <div id="success"></div>
            <!-- For success/fail messages 
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Send Message</button>
          </form>
        </div>

      </div> -->
      <!-- /.row -->

    </div>
    <!-- /.container -->

<?php include 'footer.php';?>