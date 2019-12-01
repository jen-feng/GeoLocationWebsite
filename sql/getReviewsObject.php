<?php include "inc/dbinfo.inc"; ?>
<?php include "../inc/inc.php"; ?>
<?php

try {
	$pdo = new PDO('mysql:host=localhost;dbname=test', DB_USERNAME, DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT r.*,u.firstname, u.lastname FROM reviews r inner join users u using(user_id) WHERE store_id = ? ORDER BY date DESC ";
	$sql2 = "SELECT * FROM stores WHERE ID = ?";
	
	//check if store id is passed on
	if (isset($_GET['store_id'])) {
		$id = $_GET['store_id'];
		$_SESSION['store_id'] = $id;
		
		//query to get all the reviews associated with the corresponding store id
		$stmnt1 = $pdo->prepare($sql);
		$stmnt1->execute([$id]);
		$results = $stmnt1->fetchAll(PDO::FETCH_ASSOC);
		$table = createTable($results);

		//query to get all the info for the associate store 
		$stmnt2 = $pdo->prepare($sql2);
		$stmnt2->execute([$id]);
		$row = $stmnt2->fetchAll(PDO::FETCH_ASSOC);
		$store_json = json_encode($row);
	}

} catch(PDOException $e) {
	echo "ERROR".$e;
}

//make html code of creating a table of reviews
function createTable($allReviews) {		
	$table = "";
	require 'vendor/autoload.php';
	//setting up for s3 client to retrieve object
	$s3 = new Aws\S3\S3Client([
				'region'  => AWS_DEFAULT_REGION,
				'version' => 'latest',
				'credentials' => [
					'key'    => AWS_ACCESS_KEY_ID,
					'secret' => AWS_SECRET_ACCESS_KEY,
				]
			]);
	//append each review object
	foreach($allReviews as $review) {
		//check if image exist in the s3 bucket before appending to the table
		$image = "";
		if ($review["imageupload"]) {
			$url = $s3->getObjectUrl('4ww3reviews', 'review_'.$review["ID"].'.jpg');
			$image =	'<div class="image-container" onclick="showImage('.$review["ID"].');">
								<img class="review-image" src='.$url.' alt="review image">
							</div>
							<!-- The modal to show the image -->
							<div id="imageModal'.$review["ID"].'" class="modal" >
								<button class="close" onclick="hideImage('.$review["ID"].');">close &times;</button>
								<img class="modal-content image" src='.$url.'>
							</div>';
		}
		$table = $table.
		'<tr>
			<td>
				<div class="user-container">
					<div class="user-image">
						<img src="../additional_files/usericon.png" alt="User Image">
					</div>
					<div class="user-comments">
						<h2>'.$review['title'].'</h2>
						<p>'.$review['reviewtext'].'</p>
						'.$image.'
					</div>
				</div>
			</td>
			<td><p>'.$review['rating'].'</p></td>
			<td><p>'.$review['firstname'].' '.substr($review['lastname'], 0, 1).'.</p></td>
		</tr>';
		$url = '';
	}
	
	//html code for empty table
	if ($table == "") {
		return '<div id="empty_msg"><h5>No review found for this store</h5></div>';
	}
	return $table;
}

?>