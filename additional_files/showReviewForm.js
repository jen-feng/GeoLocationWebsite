//open the review form page
function showReview() {
	element = document.getElementById("modalView");
	element.style.display = "block";
}

//close the review form page
function closeReview() {
	element = document.getElementById("modalView");
	element.style.display = "none";
}

//hide empty review
function hideEmptyMsg() {
	element = document.getElementById("empty_msg");
	if (element) {
		element.style.display = "none";
	}
}

//open image modal view
function showImage(id) {
	elementID = "imageModal" + id.toString();
	element = document.getElementById(elementID);
	element.style.display = "block";
}

//close image modal view
function hideImage(id) {
	elementID = "imageModal" + id.toString();
	element = document.getElementById(elementID);
	element.style.display = "none";
}