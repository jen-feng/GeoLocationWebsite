<?php
	session_start();
?>
<?php include "../../.inc/inc.php"; ?>
<?php include "../inc/dbinfo.inc"; ?>
<?php include "../inc/getKey.inc"; ?>
<?php
try {
    // using php data objects we set the login parameters for the database. 
    // More information here: https://www.php.net/manual/en/intro.pdo.php
	$pdo = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//check again the input is not empty
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['longitude']) && isset($_POST['latitude']) && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['longitude']) && !empty($_POST['latitude'])) {
		
		//get the latitude and longitude from the user input
		$lng = $_POST['longitude'];
		$lat = $_POST['latitude'];
		//url to get the response from google map api
		$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&key=".SECRET_KEY."&sensor=true";
		// get the json response
		$resp_json = file_get_contents($url);
		// decode the json
		$resp = json_decode($resp_json, true);
		
		//check status of the response
		if ($resp['status'] == 'OK') {
			
			//store the address
			$formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
			$sql = "SELECT count(*) FROM stores WHERE storename = ? and address = ?";
		
			$stmnt = $pdo->prepare($sql);
			try {
				$title = ucwords(strtolower($_POST['title']));
				$stmnt->execute([$title, $formatted_address]);
				$phone = "";
				
				//check whether the store exists in the database
 				if ($stmnt->fetchColumn() != 0) {
					//if exist, return back to the form
					echo "The store you submitted is already in the data.";
					echo "<meta http-equiv=\"refresh\" content=\"4;url=https://cs4ww3-jenbiya.club/submission.php\"/>";
				} else {
					$data = $_POST['phone'];
					//reformat phone if not null
					if ($data != "") {
						$unformat = "";
						$dataArray = str_split($data);
						foreach ($dataArray as $char) {
							if (preg_match('/^\d{1}$/', $char)) {
								$unformat = $unformat.$char;
							}
						}
						if (preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $unformat,  $matches )) {
							$phone = '('.$matches[1].')'.' '.$matches[2].'-'.$matches[3];
						}
					}
					
					//query for inserting to database if store does not exist
					$sql = "INSERT INTO stores (storename, description, latitude, longitude, address, phone, email, website, usersubmission, date_submitted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
					// Prepared statements: For when we don't have all the parameters so we store a template to be executed
					$stmnt = $pdo->prepare($sql);
				
					//if insert successful, let the user know
					$date = date('Y/m/d H:i:s');
					if ($stmnt->execute([$title, $_POST['description'], $lat, $lng, $formatted_address, $phone, $_POST['email'], $_POST['site'], $_SESSION['user_id'], $date])) {
							//insert the store image if there is one
							$id = $pdo->lastInsertId();
							if(isset($_FILES['imageupload'])){
								//get the file properties
								//store file name using store id
								$file_name = "store_".$id;
								$temp_file_location = $_FILES['imageupload']['tmp_name'];
								
								//script for aws composer
								require '../vendor/autoload.php';
								
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
							}
							//let the user know meassage successful
						echo "<strong>Store successfully submitted. Redirecting ...</strong>";
						echo "<meta http-equiv=\"refresh\" content=\"4;url=https://www.cs4ww3-jenbiya.club/submission.php\"/>";
					}
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		} else {
			//show error if response status not OK
			echo "<strong>ERROR:{$resp['status']}</strong>";
		}
		$_POST = array();
		
    }
} catch(PDOException $e) {
	echo $e->getMessage();
}
?>