function validateStoreForm() {
	var x = false;
	x = validateTitle() && validateDescription() && validateLongitude() && validateLatitude() && validateImageSize();
	return x;
}

function validateReviewForm() {
	var x = false;
	x = validateRating() && validateDescription() && validateTitle() ;
	return x;
}

function validateTitle() {
	var form = document.SubmissionForm;
	//this element is the error message for validating the store name
	element = document.getElementById("error_msg_sn");
	//only letters
	var regex = /^[a-z\ ]+$/ ; 
	if (form.title.value != "") {
		//check the input whether it satisfies the regular expression
		if (regex.test(String(form.title.value).toLowerCase())) {
			//hide error message
			form.title.style.outline = "none";
			element.style.display = "none";
			return true;
		} else {
			element.innerHTML = "Field can only include letters and spaces.";
		}
	}
	//show error message
	form.title.style.outline = "1px solid red";
	element.style.display = "block";
	return false;	
}

function validateDescription() {
	var form = document.SubmissionForm;
	//this element is the error message for validating the description
	element = document.getElementById("error_msg_d");
	count = form.description.value.split(' ');
	//must be at least 10 words separated by spaces
	if (count.length >= 10) {
		form.description.style.outline = "none";
		element.style.display = "none";
		return true;
	} else {
		element.innerHTML = "At least 10 words of description is required.";
	}
	//show red border error message
	form.description.style.outline = "1px solid red";
	element.style.display = "block";
	return false;	
}

function validateLatitude() {
	var form = document.SubmissionForm;
	element = document.getElementById("error_msg_ll");
	latVal = form.latitude.value;
	//check the value of latitude below
	if (latVal != "") {
		latVal = Number(form.latitude.value);
		//latitude value must be between -90 and 90
		if (latVal => -90) {
			if (latVal <= 90) {
				//hide red border and previous error msg
				form.latitude.style.outline = "none";
				element.style.display = "none";
				return true;
			}
		}
	}
	//show red border and error msg
	form.latitude.style.outline = "1px solid red";
	element.style.display = "block";
	element.innerHTML = "Latitude must be between -90 and 90";
	return false;
}

//same concept as validating latitude
function validateLongitude() {
	var form = document.SubmissionForm;
	element = document.getElementById("error_msg_ll");
	longVal = form.longitude.value;
	if (longVal != "") {
		longVal = Number(form.longitude.value);
		//longitude value must be between -180 and 180
		if (longVal => -180) {
			if (longVal <= 180) {
				form.longitude.style.outline = "none";
				element.style.display = "none";
				return true;
			}
		}
	}
	form.longitude.style.outline = "1px solid red";
	element.style.display = "block";
	element.innerHTML = "Longitude must be between -180 and 180";
}

function getMyLocation() {
	element = document.getElementById("error_msg_ll");
	//check if browser supports geolocation
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(setLatLng, handleError);
	} else {
		element.innerHTML = "Geolocation is not supported by this browser."
	}
}

//set the longitude and latitude values got from the navigator.geolocation
function setLatLng(geometry) {
	document.getElementById("latitude").value = geometry.coords.latitude;
	document.getElementById("longitude").value = geometry.coords.longitude;
	//to check the values and get rid of the red border if there is any
	validateLatitude();
	validateLongitude();
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
}

function validateImageSize(image) {
	var form = document.SubmissionForm;
	element = document.getElementById("error_msg_img");
	//check if there is an image uploaded
	if (image == null || image == "") {
		return true;
	}
	//check the size of the uploaded image
	size = image.files[0].size / 1024 / 1024; // convert unit to MB
	if (size <= 2) {
		element.style.display = "none";
		return true;
	}
	//show error message
	image.value = "";
	element.innerHTML = "File size can not exceed 2MB";
	element.style.display = "block";
	return false;
}

function validateRating() {
	var form = document.SubmissionForm;
	element = document.getElementById("error_msg_r");
	rate = form.rating.value;
	//check the value of latitude below
	if (rate != "") {
		//hide red border and previous error msg
		form.rating.style.outline = "none";
		element.style.display = "none";
		return true;
	}
	//show red border and error msg
	form.rating.style.outline = "1px solid red";
	element.style.display = "block";
	element.style.textAlign = "right";
	element.innerHTML = "Please specify your rating.";
	return false;
}