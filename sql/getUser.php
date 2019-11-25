<?php
	session_start();
?>
<?php include "../inc/dbinfo.inc"; ?>
<?php 
    // using php data objects we set the login parameters for the database. 
    // More information here: https://www.php.net/manual/en/intro.pdo.php
    $pdo = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$redirect = NULL;
	
    if (isset($_POST['email']) && isset($_POST['password'])){
		
		$sql = "SELECT * FROM users WHERE email = ?";
		$stmnt = $pdo->prepare($sql);
 
		try {
			
			//get the corresponding password hased from user and verify
			$stmnt->execute([$_POST['email']]);
			$user = $stmnt->fetchAll(PDO::FETCH_ASSOC);
			
			if ($user && password_verify($_POST['password'],  $user[0]['passwordhash'])) {
				$_SESSION["loggedin"] = "OK";
				$_SESSION["username"] = $user[0]['firstname'];
				$_SESSION["user_id"] = $user[0]['user_id'];
				
				//check if user was in a page before then redirect back after signing in
				if (isset($_SESSION['current_page'])) {	
					$redirect = $_SESSION['current_page'];
				} else {
					$redirect = "https://www.cs4ww3-jenbiya.club/search.php";
				}
				echo "Successfully signed in.";
				echo "<meta http-equiv=\"refresh\" content=\"2;url=".$redirect."\"/>";
			} else {
				$redirect = "https://www.cs4ww3-jenbiya.club/signin.php";
				echo "Either email or password is not correct. Please try again.";
				echo "<meta http-equiv=\"refresh\" content=\"2;url=".$redirect."\"/>";
			}
				
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
    }
?>