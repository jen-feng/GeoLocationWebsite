function getLocation() {
	//if permission is denied by user, user has to manually grant the permission to the website
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else { 
		element.innerHTML = "Geolocation is not supported by this browser.";
	}
}

function showPosition(position) {
	var element = document.getElementById('search');
	element.value = "Latitude: " + position.coords.latitude + 
	" Longitude: " + position.coords.longitude;
}