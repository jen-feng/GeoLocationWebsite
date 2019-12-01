<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../additional_files/registrationPage.css" >
    <script type="text/javascript" src="../additional_files/validateRegistrationForm.js"></script>
    <title>
      Registration Form
    </title>
  </head>
  <body>
    <?php include 'header.php' ?>
    <!--the outer most container of the form, multiple div class to make the styling easier to set-->
    <div class="body-content">
      <div class="container-box">
        <div class="auth-form">
          <p class="title-form">Account Registration</p>
		  <?php  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "OK") : ?>
		  <p class="title-form"><a href="signout.php?redirect=registration" style="color: red;">Sign out</a> to register an account</p>
		  <?php else : ?>
          <form action="sql/addUser.php" method="POST" name="RegistrationForm" onsubmit="return validateForm();">
            <div class="input-wrap">
              <label class="field-validation-error" id="error_msg_fn">This field is required.</label>
              <input type="text" class="rf-input fname-input" name="firstname" id="firstname" placeholder="First name" onblur="validateFirstName()">
              <label class="rf-label fname-label">First name</label>
            </div>
            <div class="input-wrap">
              <label class="field-validation-error" id="error_msg_ln">This field is required.</label>
              <input type="text" class="rf-input lname-input" name="lastname" id= "lastname" placeholder="Last name" onblur="validateLastName()">
              <label class="rf-label lname-label">Last name</label>
            </div>
            <div class="input-wrap">
              <label class="field-validation-error" id="error_msg_email">Please enter a valid email address.</label>
              <input type="email" class="rf-input email-input" name="email" placeholder="example@example.com" onblur="validateEmail()">
              <label class="rf-label email-label">Email address</label>
            </div>
            <div class="input-wrap">
              <label class="field-validation-error" id="error_msg_psw">Must be at least 8 characters long.</label>
              <input type="password" class="rf-input psw-input" name="password" id="password" placeholder="Password" onblur="validatePassword()">
              <label class="rf-label password-label">Password</label>
            </div>
            <span class="register-legal">By continuing you confirm that you agree to the Terms of Use and confirm that you have read the Privacy Policy.</span>
            <input type="submit" name="register" value="register">
          </form>
		  <?php endif; ?>
        </div>
      </div>
    </div>
	<?php include 'footer.php' ?>
  </body>
</html>