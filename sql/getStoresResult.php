<?php include "inc/dbinfo.inc"; ?>
<?php
	$pdo = new PDO('mysql:host=localhost;dbname=test', DB_USERNAME, DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$redirect = NULL;
	
	//split by comma
	if (isset($_POST['search'])) {
		$coordinate = explode("," , $_POST['search']);
	}
		
	
	//take out space in string
	if (count($coordinate) == 2) {
		$lat = trim($coordinate[0]);
		$lng = trim($coordinate[1]);
		//check if they are valid numbers for the coordinate input;
		if (is_numeric($lat) && is_numeric($lng)) {
			$sql = "SELECT * FROM stores";
			$stmnt = $pdo->prepare($sql);
			//radius distance for search from user location
			$maxRadius = 2000000;
			$stmnt->execute();
			$results = $stmnt->fetchAll(PDO::FETCH_ASSOC);
			//first row
			echo '<table>';
			echo '<tr class="table-row">';
			echo '<th class="table-row store">Store</th>';
			echo '<th class="table-row contact">Contact</th>';
			echo '<th class="table-row ratings">Rating</th>';
			echo '</tr>';
			foreach ($results as $store_row) {
				if (getDistanceInM($lat, $lng, $store_row['latitude'], $store_row['longitude']) < $maxRadius) {
					echo '<tr>
								<td>
									<!--div class to includes store image , name and other info-->
									<div class="store-container">
										<div class="store-image">
											<a href="individual_sample.html"><img src="additional_files/store.png" alt="Store Image"></a>
										</div>
										<div class="store-name">
											<h1><a href="individual_sample.html">'.$store_row['storename'].'</a></h1>
											<p>'.$store_row['description'].'<span id="dots">...</span><span class="more">vel erat posuere eleifend. Suspendisse aliquet lobortis dolor, ac finibus ipsum sagittis eu. Mauris dapibus diam consectetur, imperdiet lacus vel, faucibus enim. Curabitur porta mi vel velit mattis, ut ultricies lectus scelerisque. Praesent tempus lectus quis neque scelerisque, id ultrices ipsum dignissim. Proin pretium, tellus sed viverra porta, ex augue viverra mi, sed feugiat neque odio consequat magna. Fusce eget egestas nisi. Nam rutrum massa quis elit consectetur dictum.</span></p>
											<button onclick="">Read more</button>
										</div>
									</div>
								</td>
								<td><p>'.$store_row['phone'].'</p></td>
								<td>'.$store_row['rating'].'</td>
							</tr>';
				}
			}
			echo "</table>";
		}
	}
	
//calculate distance from user origin to destination using Haversine formula
function getDistanceInM($latO, $lngO, $latD, $lngD) {
	//earth radius in meters
	$earthRadius = 6371000;
	//convert from degree to radian
	$latO = deg2rad($latO);
	$lngO = deg2rad($lngO);
	$latD = deg2rad($latD);
	$lngD = deg2rad($lngD);
	
	//Haversine formula
	$angle = 2 * asin(sqrt(pow(sin(($latD - $latO) / 2), 2) + cos($latO) * cos($latD) * pow(sin(($lngD - $lngO) / 2), 2)));
	return $angle * $earthRadius;
}
	
?>