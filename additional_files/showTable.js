$(document).ready(function() {
		$.ajax({
			//directory of the script to add review
			url: "sql/getReviewsObject.php",
			method: "GET",
			data: "{}",
			dataType: "json",
			cache: false,
			//enable the submit button when successfully submit
			success: function(data) {
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
				}
			},
			error: function( ) {
				alert( 'something went wrong');
			}
		});
});