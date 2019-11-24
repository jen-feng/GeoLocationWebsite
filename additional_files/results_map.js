var map;

function initMap() {
	//lati and lngi are from the previous script
	var location = {lat: lati, lng: lngi};
	
	//Create a map centered in the defined location
	map = new google.maps.Map(document.getElementById('map'), {
		center: location, //center the map with the defined location
		zoom: 14  // zoom level 14 is close to city view 
	});

	//add markers
	//locations is also from the previous script
	if (locations != null) {
		createMarkers(locations);
	}

}

function createMarkers(places) {
	var infowindow = new google.maps.InfoWindow();
	bounds  = new google.maps.LatLngBounds();
	//setting up the markers for each location from the list
	for (var i = 0, place; place = places[i]; i++) {
		var st = String(i + 1);
		//create marker on the map
		var marker = new google.maps.Marker({
			map: map,
			animation: google.maps.Animation.DROP,
			//set marker by location
			position: {lat: place.latitude, lng: place.longitude},
			title: place.storename,
			//set the label in numbers
			label: {
				color: 'white',
				fontWeight: 'bold',
				text: st
			}
		});
		loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());

		//show info window when click
		google.maps.event.addListener(marker, 'click', (function(marker, place) {
			return function() {
				//concatinate the info and html elements for the info window
				var contentString = '<div class="info_content">' +
					'<h3>' + place.storename + '</h3>' +
					'<p>' +  Math.round( place.rating * 10 ) / 10 + '</p>' + 
					'<p>' + place.address + '</p>' +
					'<p><a href=\"individual_sample.php?store_id=' +
					place.ID + '\">Learn more</a></p>'
					'</div>';
				//set the above content to the window 
				infowindow.setContent(contentString);
				infowindow.setOptions({maxWidth: 300});
				//open the info window
				infowindow.open(map, marker);
			}
		}) (marker, place));
		bounds.extend(loc);
	}

	//to show the map that fit all makers
	map.fitBounds(bounds);
	//to show zoom in according the bounding of the markers on map
	map.panToBounds(bounds);
}