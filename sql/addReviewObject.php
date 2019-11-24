<?php
	session_start();
?>
<?php include "../inc/dbinfo.inc"; ?>
<?php 
    // using php data objects we set the login parameters for the database. 
    // More information here: https://www.php.net/manual/en/intro.pdo.php
    $pdo = new PDO('mysql:host=localhost;dbname=test', DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//check again the input is not empty
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['rating'])){
		try {
			//query for inserting to database if store does not exist
				$sql = "INSERT INTO reviews (store_id, user_id, title, reviewtext, rating, date) VALUES (?, ?, ?, ?, ?, ?)";
				// Prepared statements: For when we don't have all the parameters so we store a template to be executed
				$stmnt = $pdo->prepare($sql);
				
				$date = date('Y/m/d H:i:s');
				//if insert successful, let the user know

				if (isset($_SESSION['current_page'])) {	
					$redirect = $_SESSION['current_page'];
				} else {
					$redirect = "http://localhost/search.php";
				}
				if ($stmnt->execute([$_SESSION['store_id'], $_SESSION['user_id'], $_POST['title'], $_POST['description'], $_POST['rating'], $date])) {
					echo "<strong>Review successfully submitted. Redirecting ...</strong>";
					echo "<meta http-equiv=\"refresh\" content=\"2;url=".$redirect."\"/>";
				}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	} else {
			//show error if response status not OK
			echo "<strong>ERROR:something happened.</strong>";
	}
		
?>