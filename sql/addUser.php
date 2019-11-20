<?php include "../inc/dbinfo.inc"; ?>
<?php 
    // using php data objects we set the login parameters for the database. 
    // More information here: https://www.php.net/manual/en/intro.pdo.php
    $pdo = new PDO('mysql:host=localhost;dbname=test', DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['email']) && isset($_POST['password'])){

		$sql = "SELECT count(*) FROM users WHERE email = ?";
		$stmnt = $pdo->prepare($sql);
		try {
			$stmnt->execute([$_POST['email']]);
			
			if ($stmnt->fetchColumn() != 0) {
				echo "Your email address is linked to an existing account. Redirecting to Sign in Page ...";
				echo "<meta http-equiv=\"refresh\" content=\"4;url=http://localhost/signin.php\"/>";
			} else {		
				// Query we are using to check if the user is legit
				$sql = "INSERT INTO users (email, passwordhash, firstname, lastname, user_id) VALUES (?, ?, ?, ?, ?)";
				// Prepared statements: For when we don't have all the parameters so we store a template to be executed
				// More information here: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
				$stmnt = $pdo->prepare($sql);
				
				//hashed the user password and store in sql
				$hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
				
				try {
					$uniqid = uniqid(md5(time().mt_rand(1, 1000000)));
					if ($stmnt->execute([$_POST['email'], $hashed, $_POST['firstname'], $_POST['lastname'], $uniqid])) {
						//show success of registration
						header("Location: ../registerSuccessPage.php");
					}
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
			}
				
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
    } else {
        // This path is dependent on where the root of your documents is located.
        // For this it is made to point back to the register file if registering has failed.
        header("Location: ../registration.php");
    }
?>