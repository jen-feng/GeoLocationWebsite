<?php
	session_start();
	//check whether user was in registration before signing out in case user access direct url
	if (isset($_GET["redirect"]) && $_GET["redirect"] == "registration") {
		$redirect = "<meta http-equiv=\"refresh\" content=\"3;url=https://www.cs4ww3-jenbiya.club/registration.php\"/>";
	} else {
		$redirect = "<meta http-equiv=\"refresh\" content=\"3;url=https://www.cs4ww3-jenbiya.club/signin.php\"/>";
	}
	session_unset();
	session_destroy();
	echo "You have signed out your account. Redirecting ...";
	echo $redirect;
?>