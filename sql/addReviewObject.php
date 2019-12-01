<?php
	session_start();
?>
<?php include "../inc/dbinfo.inc"; ?>
<?php include "../../inc/inc.php"; ?>
<?php 
    // using php data objects we set the login parameters for the database. 
    // More information here: https://www.php.net/manual/en/intro.pdo.php
    $pdo = new PDO('mysql:host=localhost;dbname=test', DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//check again the input is not empty
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['rating']) && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['rating'])) {
		try {
			//query for inserting to database if store does not exist
				$sql = "INSERT INTO reviews (store_id, user_id, title, reviewtext, rating, imageupload, date) VALUES (?, ?, ?, ?, ?, ?, ?)";
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
				//check if there is image upload
				$hasImage = 0;
				if (isset($_FILES['imageupload'])) {
					$temp_file_location = $_FILES['imageupload']['tmp_name'];
					if ($temp_file_location) {
						$hasImage = 1;
					}
				}
				//check if execution successful
				if ($stmnt->execute([$_SESSION['store_id'], $_SESSION['user_id'], $_POST['title'], $_POST['description'], $_POST['rating'], $hasImage, $date])) {
					//insert the review image if there is one
					$id = $pdo->lastInsertId();
					$store_rating = updateStoreRating($pdo);
					$url = '';
					//if there is image upload to s3
					if ($hasImage) {
						//store file name using store id
						$file_name = "review_".$id.'.jpg';

						//script for aws composer
						require '../vendor/autoload.php';
						try {
							//open s3 bucket client and set credentials
							$s3 = new Aws\S3\S3Client([
								'region'  => AWS_DEFAULT_REGION,
								'version' => 'latest',
								'credentials' => [
								'key'    => AWS_ACCESS_KEY_ID,
								'secret' => AWS_SECRET_ACCESS_KEY,
								]
							]);

							//upload the file
							$result = $s3->putObject([
								'Bucket' => '4ww3reviews',
								'Key'    => $file_name,
								'SourceFile' => $temp_file_location	
							]);
							
							//get the object from s3 bucket
							$url = $s3->getObjectUrl('4ww3reviews', $file_name);
						} catch (Aws\S3\Exception\S3Exception $e) {
							$error = $e->getMessage();
						}
					}
					
					//json output for appending to the review page using ajax 
					$output = json_encode(array(
						'id' => $id,
						'title' => $_POST['title'],
						'username' => $_SESSION['username'],
						'description' => $_POST['description'],
						'rating' => $_POST['rating'],
						'image' => $url,
						'store_rating' => $store_rating
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
	$_POST = array();
	$_FILES = array();
	
function updateStoreRating($pdo) {
	//calculate average ratings from user reviews
	$s1 = "SELECT AVG(rating) FROM reviews WHERE store_id = ?";
	//update value of store rating using the avg value get from above statement
	$s2 = "UPDATE stores SET rating = ? WHERE ID = ?";
	$stmnt = $pdo->prepare($s1);
	$stmnt->execute([$_SESSION['store_id']]);
	$store_rating = $stmnt->fetchColumn();

	$stmnt = $pdo->prepare($s2);
	$stmnt->execute([$store_rating, $_SESSION['store_id']]);
	return $store_rating;
}
?>