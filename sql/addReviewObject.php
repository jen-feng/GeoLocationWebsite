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
				//date of creation of the query
				$date = date('Y/m/d H:i:s');
				//set the redirect url if user was previously into some place on the site
				if (isset($_SESSION['current_page'])) {	
					$redirect = $_SESSION['current_page'];
				} else {
					$redirect = "http://localhost/search.php";
				}
				//check if execution successful
				if ($stmnt->execute([$_SESSION['store_id'], $_SESSION['user_id'], $_POST['title'], $_POST['description'], $_POST['rating'], $date])) {
					//json output for appending to the review page using ajax 
					$output = json_encode(array(
						'title' => $_POST['title'],
						'username' => $_SESSION['username'],
						'description' => $_POST['description'],
						'rating' => $_POST['rating']
					));
					echo $output;
				}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	} else {
			//show error if response status not OK
			echo "<strong>ERROR:something happened.</strong>";
	}
		
?>