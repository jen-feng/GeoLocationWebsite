<?php include "inc/dbinfo.inc"; ?>
<?php
try {
	$pdo = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DATABASE, DB_USERNAME, DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//check if rating is set
	if (isset($_POST['rate'])) {
		$searchByRating = $_POST['rate'];
	} else {
		//set to te lowest so all ratings can be retrieved (rating minimum 1)
		$searchByRating = 0.0;
	}
	//table for appending new rows
	$table = "";
	$lat = "";
	$lng = "";
	//value to put the list of stores convert to json encode later
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
	//check whether input was coordinates if not then set search by name
	$name = "";
	if (!$latLngKnown) {
		$name = isset($_POST['search']) ? $_POST['search'] : "";
		//get rid of characters other than numbers and letters
		$name = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $name));
	}
	
	//query to get all stores from database
	$sql = "SELECT ID, storename, description, address, latitude, longitude, phone, rating FROM stores WHERE rating >= ? ORDER BY rating DESC";
	$stmnt = $pdo->prepare($sql);
	$stmnt->execute([$searchByRating]);
	$results = $stmnt->fetchAll(PDO::FETCH_ASSOC);
	//funtion to create html table
	//will return an array of tw value which the stores are the stores to show later and the other is the html table
	$tables = createTable($results, $latLngKnown, $name);
	
	if (count($results) != 0) {
		//encode for  later use in js script
		$locations = json_encode($tables["stores"]);
	} else {
		$locations = "{}";
	}

	$table = $tables["table"];
	$_POST = array();

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

function createTable($stores, $coordinate, $searchName) {
	//first row of the table
	$first = '<tr class="table-row">'.
		'<th class="table-row store">Store</th>'.
		'<th class="table-row contact">Contact</th>'.
		'<th class="table-row ratings">Rating</th>'.
		'</tr>';
	$table = "";
	//radius distance for search from user location, 3km as standard
	$maxRadius = 3000;
	//number to show on the store title
	$num = 1;
	//helper index for the below array
	$index = 0;
	//an array to save the stores that will be showing later
	$storesToShow = array();

	//looping each store to create each row of the table
	foreach ($stores as $store_row) {
		//first check: no coordinates and no text in search input -> show all existing stores
		//second check: if search is not empty check if it matches the storename in database
		//third check: if it is coordinates check if store is within the specify radius from the coordinate
		if ((!$coordinate && empty($searchName)) || (!empty($searchName) ? isNameMatch($store_row['storename'], $searchName) : false)  || getDistanceInM($coordinate[0], $coordinate[1], $store_row['latitude'], $store_row['longitude']) < $maxRadius) {
			//set contact info
			$contact = $store_row['phone'] ? $store_row['phone'] : ($store_row['email'] ? $store_row['email'] : "N/A");			//adding Element of each row for the table
			$table = $table.'<tr>
					<td>
						<!--div class to includes store image , name and other info-->
						<div class="store-container">
							<div class="store-image">
								<a href="individual_sample.php?store_id='.$store_row['ID'].'"><img src="additional_files/store.png" alt="Store Image"></a>
							</div>
							<div class="store-name">
								<h1><a href="individual_sample.php?store_id='.$store_row['ID'].'">'.$num.". ".$store_row['storename'].'</a></h1>
								<p>'.$store_row['description'].'</p>
							</div>
						</div>
					</td>
					<td><p>'.$contact.'</p></td>
					<td>'.round($store_row['rating'], 1).'</td>
				</tr>';

				//create a new array and add the store info 
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

//match store names from database and compare with the user search input
function isNameMatch($storename, $searchName) {
	//replace all symbols other than letters and numbers
	$storename = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $storename));
	//check whether the input string contains in the storename or storename contains in the input string
	return strpos($storename, $searchName) !== False || strpos($searchName, $storename) !== False;
}

?>