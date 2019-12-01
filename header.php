<?php 
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	} 
?> 
	<header id="header" class="group">
      <div class="logo">
        <img src="../additional_files/logo.png" id="img_logo" alt="Logo">
      </div>
      <div class="menu">
        <ul>
          <li><a href="search.php">Home</a></li>
		  <li><a href="">About</a></li>
          <li><a href="submission.php">Store Submission</a></li>
          <?php  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "OK") : ?>
		  <div class="account-container">
              <div class="account user-profile"><img id="user_profile" src="additional_files/user_profile.jpg"></div>
		      <div class="account user-name"><?php echo $_SESSION['username']; ?></div>
			  <div class="account user-logout">
					<small>
						<a href="signout.php" style="color: red;">signout</a>
					</small>
			  </div>
		  </div>
          <?php else : ?>
		  <div class="auth-container">
              <li><a href="signin.php">Sign In</a></li>
			  <li id="registration"><a href="registration.php">Registration</a></li>
          </div>
		  <?php endif; ?>
        </ul>
      </div>
    </header>
	<style>
	 /*logo image for the top left of the web page*/
.logo {
	margin: 0;
	width: 100%;
	float: left;
}

/*size of logo*/
#img_logo {
	height: 5em;
}

/*---------------------------------------------------------------------------------------------------------------------------------------*/
/*base look for the navigation menu*/

.menu {
	float: left;  /*to maintain the menu position*/
	width: 100%;   /*cover the whole width for the menu*/
}

ul {
	list-style-type: none;  /*to get rid if the list style*/
	margin: 0;   /*get rid of the margin so the elements below and above are closer to the menu*/
	padding: 0;   /*get rid of the extra space from the left side of the menu*/
	overflow: hidden;
	background-color: #46301e;
}

/*keep the menu items to the left so they are in the same line*/
li {
	float: left;
}

li a {
	display: block; 
	color: white;
	text-align: center;  /*align the text for each list elements*/
	padding: 20px 30px;  /*padding for the text inside the list elements*/
	text-decoration: none; /*get rid of the underline*/
	font-size: 20px;
}

.account-container{
	display: block;
	float: right;
	text-align: center;
	padding: 10px 15px;
	background-color: #974b00;
}

.auth-container {
	float: right;
}

.account {
	display: inline-block;
	margin: auto;
	vertical-align: middle;
}

.account.user-name {
	font-size: 20px;
	margin-left: 10px;
	margin-right: 10px;
}

#registration {
	background-color: #bf0000;
}

/*change color when mouse hover to the corresponding menu item*/
li a:hover {
	background-color: #111;
} 

#user_profile {
	max-height: 40px;
}

#registration a:hover {
	background: #7a003c;
}
	</style>