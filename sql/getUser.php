<?php include "../inc/dbinfo.inc"; ?>
<?php 
    // using php data objects we set the login parameters for the database. 
    // More information here: https://www.php.net/manual/en/intro.pdo.php
    $pdo = new PDO('mysql:host=localhost;dbname=test', DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['email']) && isset($_POST['password'])){
		
		$sql = "SELECT * FROM users WHERE Email = ?";
		$stmnt = $pdo->prepare($sql);
 
		try {
			
			//get the corresponding password hased from user and verify
			$stmnt->execute([$_POST['email']]);
			$user = $stmnt->fetchAll(PDO::FETCH_ASSOC);
			
			if ($user && password_verify($_POST['password'],  $user[0]['PasswordHash'])) {
				echo "Successfully signed in.";
			} else {
				echo "Either email or password is not correct. Please try again.";
			}
				
		} catch (PDOException $e) {
			echo $e->getMessage();
		}

    }
?>