$(document).ready(function() {
	//on submit of reviewForm
	$('#reviewForm').on('submit', function(event) {
		event.preventDefault();
		$.ajax({
			//directory of the script to add review
			url:"sql/addReviewObject.php",
			method:"POST",
			data:$(this).serialize(),
			dataType:"json",
			//disable the submit button to prevent repeating submittion
			beforeSend:function() {
				$('#add').attr('disabled', 'disabled');
			},
			//enable the submit button when successfully submit
			success:function(data) {
				$('#add').attr('disabled', false);
				//check if data not null then add html
				if(data.title) {
					var html = '<tr>' +
										'<td>' +
											'<div class="user-container">' +
												'<div class="user-image">' +
													'<img src="../additional_files/usericon.png" alt="User Image">' +
												'</div>' +
												'<div class="user-comments">' +
													'<h2>'+ data.title + '</h2>' +
													'<p>' + data.description + '<span id="dots">...</span><span class="more">vel erat posuere eleifend. Curabitur porta mi vel velit mattis, ut ultricies lectus scelerisque. Praesent tempus lectus quis neque scelerisque, id ultrices ipsum dignissim. Proin pretium, tellus sed viverra porta, ex augue viverra mi, sed feugiat neque odio consequat magna. Fusce eget egestas nisi. Nam rutrum massa quis elit consectetur dictum.</span></p>' +
													'<button onclick="">Read more</button>' +
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
			}
		})
	});
});