<?php session_start(); ?>
<?php include "sql/getReviewsObject.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../additional_files/objectPage.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="../additional_files/showReviewForm.js"></script>
    <script type="text/javascript" src="../additional_files/validateSubmission.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<title>
      Object Page
    </title>
  </head>
  <body>
    <?php include 'header.php' ?>
    <div class="results-container">
      <div class="top-container">
        <div class="map-container">
          <div id="map"></div>
		  <script >
			// $store_json from the php file included at the start of this document
			// define this var to be used in the next script
            var tmp = <?php echo $store_json; ?>;
			var place = tmp[0];
		  </script>
          <script type="text/javascript" src="../additional_files/sample_map.js"></script>
        </div>
        <!--create a table for the store details -->
        <div class="details-container">
          <div class="container-border">
            <h1 id="map_title">Pet Valu</h1>
            <table class="details-table">
              <tr>
                <td class="subject">Rating</td>
                <td id="rating"></td>
              </tr>
              <tr>
                <td class="subject">Address</td>
                <td id="address"></td>
              </tr>
              <tr>
                <td class="subject">Phone Number</td>
                <td id="phone"></td>
              </tr>
              <tr>
                <td class="subject">Website</td>
                <td id="website"></td>
              </tr>
			  <tr>
                <td class="subject">Email</td>
                <td id="email"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="results-content">
        <table>
		  <thread>
		  <tr class="table-row">
			<th class="table-row store">Reviews</th>
			<th  class="table-row ratings">Rating</th>
			<th class="table-row contact">User</th>
			</tr>
		  </trhead>
		  <tbody id="table_data">
		    <?php echo $table; ?>
          </tbody>
        </table>
        <!--an element for the table paging, hard coded for now-->
        <div class="page-container">
          <p class="page">End<p>
        </div>
      </div>
    </div>
	<!-- check if user is logged in, show sign in button when it is not -->
	<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "OK"): ?>
	  <?php include "inc/control.inc"; ?>
	  <!-- show user who is logged in to write a review button-->
	  <button id="reviewButton" onclick="showReview();">Write a Review</button>
	<?php else: ?>
	  <form action="signin.php"><input type="submit" value="Sign in to Write a Review" id="signInButton">
	  <?php include "inc/control.inc"; ?>
	<?php endif; ?>
	<div id="modalView" class="modal-box">
	  <div class="modal-content">
	    <button class="close" onclick="closeReview();">close &times;</button>
	    <div class="title-form">
		  <h4>Share your experience</h4>
		  <span class="review-des">Tell customers what you experienced by rating and reviewing the store.</span>
		</div>
	    <form method="POST" name="SubmissionForm" id="reviewForm" onsubmit="return validateReviewForm();">
		  <div class="auth-form">
		    <div class="ratings-container">
		      <label class="rf-label rating">Rate it *</label>
              <select class="rf-input" id="ratings" name="rating" onblur="validateRating()" form="reviewForm">
                <option value="" disabled selected hidden>Ratings</option>
                <option value="5">5/5</option>
                <option value="4.5">4.5/5</option>
				<option value="4">4/5</option>
				<option value="3.5">3.5/5</option>
                <option value="3">3/5</option>
                <option value="2.5">2.5/5</option>
				<option value="2">2/5</option>
				<option value="1.5">1.5/5</option>
                <option value="1">1/5</option>
              </select>
			  <label class="field-validation-error" id="error_msg_r">This field is required.</label>
            </div>
            <div class="input-wrap">
              <label class="rf-label fname-label">Review *</label>
              <textarea class="rf-input description" form="reviewForm" name="description" id="description" placeholder="Enter review here..." onblur="validateDescription()"></textarea>
              <label class="field-validation-error" id="error_msg_d">This field is required.</label>
			</div>
            <div class="input-wrap">
			  <label class="rf-label lname-label">Title *</label>
              <input type="text" class="rf-input lname-input" name="title" id= "title" placeholder="Title for your review" onblur="validateTitle()">
              <label class="field-validation-error" id="error_msg_sn">This field is required.</label>
            </div>
            <div class="input-wrap">
              <label class="rf-label">Upload image (optional)</label>
              <input accept="image/*" type="file" class="rf-input image" name="imageupload" onchange="return validateImageSize(this)">
              <label class="field-validation-error" id="error_msg_img">Your image can not exceed 4MB.</label>
            </div>
            <span class="register-legal">By continuing you confirm that you agree to the Terms of Use and confirm that you have read the Privacy Policy.</span>
			<input type="submit" name="add" id="add" value="Submit">
	      </div>
		</form>
	  </div>
	</div>
	<?php include 'footer.php' ?>
    <script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyhVAtMlWygSGml79zYG-WnGlLxU9B3ho&libraries=places&callback=initMap"></script>
   </body>
</html>
<!-- js script to use ajax to append the new review-->
<script type="text/javascript" src="../additional_files/addReview.js"></script>