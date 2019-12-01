var map;

function initMap() {

	var location = {lat: place.latitude, lng: place.longitude};
	//Create a map centered in the defined location
	map = new google.maps.Map(document.getElementById('map'), {
		center: location, //center the map with the defined location
		zoom: 15  // zoom level 15 is city view 
	});

	var infowindow = new google.maps.InfoWindow();

	//put the data that get from the responses into corresponding text
	document.getElementById("map_title").innerHTML = place.storename;
	document.getElementById("rating").innerHTML = Math.round( place.rating * 10 ) / 10;
	document.getElementById("address").innerHTML = place.address;
	if (place.website != '' ) {
		document.getElementById("phone").innerHTML =  place.phone;
	}
	else {
		document.getElementById("phone").innerHTML = "N/A";
	}
	if (place.website != '' ) {
		document.getElementById("website").innerHTML =  "<a href=\"" + place.website + "\">" + place.website + "</a>";
	}
	else {
		document.getElementById("website").innerHTML = "N/A";
	}
	if (place.email != '' ) {
		document.getElementById("email").innerHTML =   place.email;
	}
	else {
		document.getElementById("email").innerHTML = "N/A";
	}

	//create marker on the map
	var marker = new google.maps.Marker({
		map: map,
		animation: google.maps.Animation.DROP,
		//marker set on the defined location
		position: location,
		title: place.storename
	});

	var infowindow = new google.maps.InfoWindow();
	//concatinate the info and html elements for the info window
	var contentString = '<div class="info_content">' +
		'<h3>' + place.storename + '</h3>' +
		'<p>' + place.address + '</p>' +
		'</div>';
	google.maps.event.addListener(marker, 'click', (function(marker, place) {
		return function() {
			//set the above content to the window
			infowindow.setContent(contentString);
			infowindow.setOptions({maxWidth: 300});
			//open the info window
			infowindow.open(map, marker);
		}
	}) (marker, place));
	//show info window when page is loaded
	infowindow.setContent(contentString);
	infowindow.setOptions({maxWidth: 300});
	infowindow.open(map, marker);
}