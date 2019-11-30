$(document).ready(function() {
	//on submit of reviewForm
	$('#reviewForm').on('submit', function(event) {
		event.preventDefault();
		$.ajax({
			//directory of the script to add review
			url: "sql/addReviewObject.php",
			method: "POST",
			data: new FormData(this),
			dataType: "json",
			contentType: false,
			cache: false,
			processData: false,
			//disable the submit button to prevent repeating submittion
			beforeSend: function() {
				$('#add').attr('disabled', 'disabled');
			},
			//enable the submit button when successfully submit
			success: function(data) {
				$('#add').attr('disabled', false);
				//check if data not null then add html
				var imageHTML = '';
				if(data.title) {
					//check if image url not null then create the element for image
					if (data.image != '') {
						imageHTML = '<div class="image-container" onclick="showImage(' + data.id + ');">' +
									'<img class="review-image" src="' + data.image + '" alt="review image">' +
								'</div>' +
								'<!-- The modal to show the image -->' +
								'<div id="imageModal' + data.id + '" class="modal" >' +
									'<button class="close" onclick="hideImage(' + data.id + ');">close &times;</button>' +
									'<img class="modal-content image" src="' + data.image + '">' +
								'</div>';
					}

					var html = '<tr>' +
										'<td>' +
											'<div class="user-container">' +
												'<div class="user-image">' +
													'<img src="../additional_files/usericon.png" alt="User Image">' +
												'</div>' +
												'<div class="user-comments">' +
													'<h2>'+ data.title + '</h2>' +
													'<p>' + data.description + '<span id="dots">...</span><span class="more">vel erat posuere eleifend. Curabituum.</span></p>' +
													'<button onclick="">Read more</button>' +
													imageHTML +
												'</div>' +
											'</div>' +
										'</td>' +
										'<td><p>' + data.rating + '</p></td>' +
										'<td>' + data.username + '</td>' +
									'</tr>';
					//append the new html row for new submitted review
					$('#table_data').prepend(html);
					//reset the form after
					$('#reviewForm')[0].reset();
					//close the reviewForm page afte successfully submitted
					closeReview();
					//hide empty review message if any
					hideEmptyMsg();
				}
			},
			error: function( ) {
				$('#add').attr('disabled', false);
			}
		})
	});
});