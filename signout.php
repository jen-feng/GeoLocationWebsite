<?php
	session_start();
	//check whether user was in registration before signing out in case user access direct url
	if (isset($_GET["redirect"]) && $_GET["redirect"] == "registration") {
		$redirect = "<meta http-equiv=\"refresh\" content=\"3;url=http://localhost/registration.php\"/>";
	} else {
		$redirect = "<meta http-equiv=\"refresh\" content=\"3;url=http://localhost/signin.php\"/>";
	}
		 
	session_unset();
	session_destroy();
	echo "You have signed out your account. Redirecting...";
	echo $redirect;
?>