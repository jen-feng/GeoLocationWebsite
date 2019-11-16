<?php
	session_start();
	session_destroy();
	echo "You have signed out your account. Redirecting to sign in page ...";
	echo "<meta http-equiv=\"refresh\" content=\"3;url=http://localhost/signin.php\"/>"
?>