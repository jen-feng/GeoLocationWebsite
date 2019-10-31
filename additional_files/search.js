function getLocation() {
	//if permission is denied by user, user has to manually grant the permission to the website
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, handleError);
	} else { 
		element.innerHTML = "Geolocation is not supported by this browser.";
	}
}

function showPosition(position) {
	//set the search bar value to be longitude and latitude got from the navigator.geolocation
	var element = document.getElementById('search');
	element.value = "Latitude: " + position.coords.latitude + 
	" Longitude: " + position.coords.longitude;
	//hide error msg
	element = document.getElementById("error_msg_ll");
	element.style.display = "none";
}

//show the error msg to user 
function handleError(error) {
	element = document.getElementById("error_msg_ll");
	//check what kind of error
	switch(error.code) {
		case error.PERMISSION_DENIED:
			element.innerHTML = "Permission denied. Please change permission setting from your browser."
			break;
		default:
			element.innerHTML = "An unknown error occurred."
	}
	//show error message 
	element.style.display = "block";
	element.style.backgroundColor = "white";
	element.style.opacity = "0.5"
}