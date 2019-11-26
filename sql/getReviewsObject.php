<?php include "inc/dbinfo.inc"; ?>
<?php

try {
	$pdo = new PDO('mysql:host=localhost;dbname=test', DB_USERNAME, DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM reviews WHERE store_id = ? ORDER BY date DESC";
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
	
	//append each review object
	foreach($allReviews as $review) {
		$table = $table.
		'<tr>
			<td>
				<div class="user-container">
					<div class="user-image">
						<img src="../additional_files/usericon.png" alt="User Image">
					</div>
					<div class="user-comments">
						<h2>'.$review['title'].'</h2>
						<p>'.$review['reviewtext'].'<span id="dots">...</span><span class="more">vel erat posuere eleifend. Suspendisse aliquet lobortis dolor, ac finibus ipsum sagittis eu. Mauris dapibus diam consectetur, imperdiet lacus vel, faucibus enim. Curabitur porta mi vel velit mattis, ut ultricies lectus scelerisque. Praesent tempus lectus quis neque scelerisque, id ultrices ipsum dignissim. Proin pretium, tellus sed viverra porta, ex augue viverra mi, sed feugiat neque odio consequat magna. Fusce eget egestas nisi. Nam rutrum massa quis elit consectetur dictum.</span></p>
						<button onclick="">Read more</button>
					</div>
				</div>
			</td>
			<td><p>'.$review['rating'].'</p></td>
			<td>'.$review['user_id'].'</td>
		</tr>';
	}
	
	//html code for empty table
	if ($table == "") {
		return '<div id="empty_msg"><h5>No review found for this store</h5></div>';
	}
	return $table;
}

?>