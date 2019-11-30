function validateForm() {
	var x = false;
	x = validateFirstName() && validateLastName() && validateEmail() && validatePassword();
	return x;
}

function validateAuth() {
	var x = false;
	x = validateEmail() && validatePassword();
	return x;
}

function validateFirstName() {
	var form = document.RegistrationForm;
	//this element is the error message for validating the first name
	element = document.getElementById("error_msg_fn");
	//only letters
	var regex = /^[a-z\ ]+$/ ; 
	if (form.firstname.value != "") {
		//check the input whether it satisfies the regular expression
		if (regex.test(String(form.firstname.value).toLowerCase())) {
			//hide error message
			form.firstname.style.outline = "none";
			element.style.display = "none";
			return true;
		} else {
			element.innerHTML = "Field can only include letters and spaces.";
		}
	}
	//show error message
	form.firstname.style.outline = "1px solid red";
	element.style.display = "block";
	return false;
}

function validateLastName() {
	var form = document.RegistrationForm;
	//this element is the error message for validating last name
	element = document.getElementById("error_msg_ln");
	//only letters
	var regex = /^[a-z\ ]+$/ ; 
	if (form.lastname.value != "") {
		//check the input whether it satisfies the regular expression
		if (regex.test(String(form.lastname.value).toLowerCase())) {
			//hide error message
			form.lastname.style.outline = "none";
			element.style.display = "none";
			return true;
		} else {
			element.innerHTML = "Field can only include letters and spaces.";
		}
	}
	//show error message
	form.lastname.style.outline = "1px solid red";
	element.style.display = "block";
	return false;
}

function validateEmail() {
	var form = document.RegistrationForm;
	//this element is the error message for validating email address
	element = document.getElementById("error_msg_email");
	if (form.email.value != "") {
		//regular expression for email that doesn't include unicodes
		var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		//check the input whether it satisfies the regular expression for email defined above
		if (regex.test(String(form.email.value).toLowerCase())) {
			//hide error message
			form.email.style.outline = "none";
			element.style.display = "none";
			return true;
		}
	}
	//show error message
	form.email.style.outline = "1px solid red";
	element.style.display = "block";
	return false;
}

function validatePassword() {
	var form = document.RegistrationForm;
	//this element is the error message for validating password
	element = document.getElementById("error_msg_psw");
	//password just need to be at least 8 characters long
	if (form.password.value != "" && form.password.value.length >= 8) {
		//hide error message
		form.password.style.outline = "none";
		element.style.display = "none";
		return true;
	}
	//show error message
	form.password.style.outline = "1px solid red";
	element.style.display = "block";
	return false;
}
