<?php include "inc/dbinfo.inc"; ?>
<?php
	$pdo = new PDO('mysql:host=localhost;dbname=test', DB_USERNAME, DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//check if rating is set
	if (isset($_POST['rate'])) {
		$searchByRating = $_POST['rate'];
	} else {
		$searchByRating = 0.0;
	}

	$table = "";
	$lat = "";
	$lng = "";
	$locations = "";
	$latLngKnown = false;
	//check search input
	if (isset($_POST['search'])) {
		$coordinate = explode("," , $_POST['search']);
		//take out space in string
		if (count($coordinate) == 2) {
			$lat = trim($coordinate[0]);
			$lng = trim($coordinate[1]);
			//check if they are valid numbers for the coordinate input;
			if (is_numeric($lat) && is_numeric($lng)) {
				$latLngKnown = array($lat, $lng);
			}
		}
	}
	try {
		$sql = "SELECT ID, storename, description, latitude, longitude, phone, rating FROM stores WHERE rating >= ? ORDER BY rating DESC";
		$stmnt = $pdo->prepare($sql);
		$stmnt->execute([$searchByRating]);
		$results = $stmnt->fetchAll(PDO::FETCH_ASSOC);
		//funtion to create html table
		//will return an array of tw value which the stores are the stores to show later and the other is the html table
		$tables = createTable($results, $latLngKnown, $searchByRating);
		
		if (count($results) != 0) {
			//encode for  later use in js script
			$locations = json_encode($tables["stores"]);
		} else {
			$locations = "{}";
		}

		$table = $tables["table"];

	} catch(PDOException $e) {
		echo "ERROR: ".$e->getMessage();
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

function createTable($stores, $coordinate, $baseRating) {
	//first row
	$first = '<tr class="table-row">'.
		'<th class="table-row store">Store</th>'.
		'<th class="table-row contact">Contact</th>'.
		'<th class="table-row ratings">Rating</th>'.
		'</tr>';
	$table = "";
	//radius distance for search from user location
	$maxRadius = 2000;
	$num = 1;
	$index = 0;

	//an array to save the stores that will be showing later
	$storesToShow = array();

	//looping each store to create each row of the table
	foreach ($stores as $store_row) {
		if (!$coordinate || getDistanceInM($coordinate[0], $coordinate[1], $store_row['latitude'], $store_row['longitude']) < $maxRadius) {
			//adding Element of each row for the table
			$table = $table.'<tr>
					<td>
						<!--div class to includes store image , name and other info-->
						<div class="store-container">
							<div class="store-image">
								<a href="individual_sample.html"><img src="additional_files/store.png" alt="Store Image"></a>
							</div>
							<div class="store-name">
								<h1><a href="individual_sample.html">'.$num.". ".$store_row['storename'].'</a></h1>
								<p>'.$store_row['description'].'<span id="dots">...</span><span class="more">vel erat posuere eleifend. Suspendisse aliquet lobortis dolor, ac finibus ipsum sagittis eu. Mauris dapibus diam consectetur, imperdiet lacus vel, faucibus enim. Curabitur porta mi vel velit mattis, ut ultricies lectus scelerisque. Praesent tempus lectus quis neque scelerisque, id ultrices ipsum dignissim. Proin pretium, tellus sed viverra porta, ex augue viverra mi, sed feugiat neque odio consequat magna. Fusce eget egestas nisi. Nam rutrum massa quis elit consectetur dictum.</span></p>
								<button onclick="">Read more</button>
							</div>
						</div>
					</td>
					<td><p>'.$store_row['phone'].'</p></td>
					<td>'.$store_row['rating'].'</td>
				</tr>';

				$storesToShow[$index] = array();
				$storesToShow[$index] = $store_row;

				$index++;
				$num++;
		}
	}

	$result[0] = array();
	//to return two values for the function
	$result[0]["stores"] = $storesToShow;
	
	//check if it is empty to add empty result html message
	if ($table == "") {
		$result[0]["table"] = $first."<h2>No store found.</h2>";
	} else {
		$result[0]["table"] = $first.$table;
	}
	return $result[0];
}

?>