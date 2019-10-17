var map;

function initMap() {
	//lattitude and longitude for Pet Valu
	var location = {lat: 43.2626744, lng: -79.9526672};
	
	//Create a map centered in the defined location
	map = new google.maps.Map(document.getElementById('map'), {
		center: location, //center the map with the defined location
		zoom: 14  // zoom level 15 is city view 
	});
	
	//use PlcaesService to get details
	var service = new google.maps.places.PlacesService(map);

	// Perform a text search which will return a list of places
	service.textSearch({
		location: location, radius: 5, query: 'pet in dundas'},
		function(results, status) {
			if (status == google.maps.places.PlacesServiceStatus.OK) {
				//set the markers return from the list of places
				createMarkers(results);
			}
		}
	);	
}

function createMarkers(places) {
	var infowindow = new google.maps.InfoWindow();
	//setting up the markers for each location from the list
	for (var i = 0, place; place = places[i]; i++) {
		var st = String(i + 1);
		//create marker on the map
		var marker = new google.maps.Marker({
			map: map,
			animation: google.maps.Animation.DROP,
			//set marker by location
			position: place.geometry.location,
			title: place.name,
			//set the label in numbers
			label: {
				color: 'white',
				fontWeight: 'bold',
				text: st
			}
		});

		google.maps.event.addListener(marker, 'click', (function(marker, place) {
			return function() {
				var contentString = '<div class="info_content">' +
					'<h3>' + place.name + '</h3>' +
					'<p>' +  Math.round( place.rating * 10 ) / 10 + '</p>' + 
					'<p>' + place.formatted_address + '</p>' +
					'<p><a href=\"individual_sample.html?place_id=' +
					place.place_id + '\">Learn more</a></p>'
					'</div>';
				infowindow.setContent(contentString);
				infowindow.setOptions({maxWidth: 300});
				infowindow.open(map, marker);
			}
		}) (marker, place));
	}
}