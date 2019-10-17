function initMap() {
	var map;
    
    //dundas valley groomers: @43.2686668,-79.9673589
    //animal hoouse profess: @43.4298459,-80.0755561
    
    //lattitude and longitude for Pet Valu
    var petvalu = {lat: 43.2626744, lng: -79.9526672};

    var dundasval = {lat: 43.2686668, lng: -79.9673589};

    var animalhouse = {lat: 43.4298459, lng: -80.0755561};
	
	//Create a map centered in the defined location
	map = new google.maps.Map(document.getElementById('map'), {
		center: petvalu, //center the map with the defined location
		zoom: 15  // zoom level 15 is city view 
	});
	
	//create marker on the map for petvalu
	var marker = new google.maps.Marker({
		map: map,
		animation: google.maps.Animation.DROP,
		//marker set on the defined location
		position: petvalu,
		
		//set the label to locate under the icon
		label: {
			color: 'red',
			fontWeight: 'bold',
			text: 'Pet Valu'
		},
		
		//in order to put a label below an icon, a custom icon is needed
		icon: {
			labelOrigin: new google.maps.Point(11, 50),  //the location for the label
			url: '../additional_files/marker_red.png'
		}
	});
    
    //create marker on the map for dundas valley groomers
	var marker = new google.maps.Marker({
		map: map,
		animation: google.maps.Animation.DROP,
		//marker set on the defined location
		position: dundasval,
		
		//set the label to locate under the icon
		label: {
			color: 'red',
			fontWeight: 'bold',
			text: 'Dundas Valley Groomers'
		},
		
		//in order to put a label below an icon, a custom icon is needed
		icon: {
			labelOrigin: new google.maps.Point(11, 50),  //the location for the label
			url: '../additional_files/marker_red.png'
		}
    });
    
    //create marker on the map for animal house prefessional
	var marker = new google.maps.Marker({
		map: map,
		animation: google.maps.Animation.DROP,
		//marker set on the defined location
		position: animalhouse,
		
		//set the label to locate under the icon
		label: {
			color: 'red',
			fontWeight: 'bold',
			text: 'Animal House Professional'
		},
		
		//in order to put a label below an icon, a custom icon is needed
		icon: {
			labelOrigin: new google.maps.Point(11, 50),  //the location for the label
			url: '../additional_files/marker_red.png'
		}
	});

	var request = {
		//placeId for retrieving the store details, got it from google 
		placeId : 'ChIJe_8WsJqELIgR8KT9yQgxJn8',
		// the place details that I need from the place details responses
		fields: ['name',  'opening_hours', 'formatted_address', 'formatted_phone_number', 'rating', 'website']
	};
	
	//use PlcaesService to get details
	var service = new google.maps.places.PlacesService(map);
	service.getDetails(request, function(place, status) {
		//Checks that the PlacesServiceStatus is OK to retrieve details;
		if (status === google.maps.places.PlacesServiceStatus.OK) {
			//put the data that get from the responses into corresponding text
			document.getElementById("map_title").innerHTML = place.name;
			document.getElementById("rating").innerHTML = place.rating;
			document.getElementById("address").innerHTML = place.formatted_address;
			document.getElementById("phone").innerHTML =  place.formatted_phone_number;
			document.getElementById("website").innerHTML =  "<a href=\"" + place.website + "\">" + place.website + "</a>";
			var hours = String(place.opening_hours.weekday_text).split(",");
			//formatting the service hours splitting with comma and use for loop to concatinate with a new line
			var st = "";
			for (h of hours) {
				st = st + h + "<br>"
			}
			document.getElementById("service_hours").innerHTML =  st;
		}
	});
}