<?php
	session_start();
	session_unset();
	session_destroy();
	echo "You have signed out your account. Redirecting to sign in page ...";
	echo "<meta http-equiv=\"refresh\" content=\"3;url=https://www.cs4ww3-jenbiya.club/signin.php\"/>"
?>