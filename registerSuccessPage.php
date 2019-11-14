<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../additional_files/registrationPage.css" >
    <title>
      Registration Success
    </title>
  </head>
  <body>
    <?php include 'header.php' ?>
    <!--the outer most container of the form, multiple div class to make the styling easier to set-->
    <div class="body-content">
      <div id="success" class="container-box">
        <div class="auth-form">
          <p class="title-form">Account Registration</p>
		  <h3>You have successfully registered an account.</h3>
		  <a href="signin.php">Sign in</a>
        </div>
      </div>
    </div>
	<?php include 'footer.php' ?>
  </body>
</html>