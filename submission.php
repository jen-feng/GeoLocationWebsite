<!DOCTYPE html>
<!--structure based on the registrationPage.html pretty much the same-->
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../additional_files/submissionPage.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../additional_files/validateSubmission.js"></script>
    <title>
      Submission Form
    </title>
  </head>
  <body>
    <?php include 'header.php' ?>
    <div class="body-content">
      <div class="container-box">
        <div class="auth-form">
          <p class="title-form">Store Submission</p>
          <form action="registration" method="post" name="SubmissionForm" onsubmit="return validateForm();">
            <div class="input-wrap">
              <label class="rf-label">Store name</label>
              <input type="text" class="rf-input" name="storename" placeholder="Store name" onblur="validateStoreName()">
              <label class="field-validation-error" id="error_msg_sn">This field is required.</label>
            </div>
            <div class="input-wrap">
              <label class="rf-label">Description</label>
              <textarea class="rf-input description" name="description" placeholder="At least 10 words of description" onblur="validateDescription()"></textarea>
              <label class="field-validation-error" id="error_msg_d">This field is required.</label>
            </div>
            <div class="input-wrap">
              <label class="rf-label">Coordinates</label>
              <div class="coordinates-container">
                <input type="number" step="any" class="rf-input latitude" id="latitude" placeholder="Latitude" onblur="validateLatitude()">
                <input type="number" step="any" class="rf-input longitude" id="longitude" placeholder="Longitude" onblur="validateLongitude()">
              </div>
              <label class="field-validation-error" id="error_msg_ll">This field is required.</label>
              <div class="button-container">
                <input type="button" id="location_button" name="locationbutton" onclick="getMyLocation()" value="Get my location">
              </div>
            </div>
            <!---image upload-->
            <div class="input-wrap">
              <label class="rf-label">Upload image (optional)</label>
              <input accept="image/*" type="file" class="rf-input image" name="imageupload" onchange="return validateImageSize(this)">
              <label class="field-validation-error" id="error_msg_img">Your image can not exceed 4MB.</label>
            </div>
            <span class="register-legal">By continuing you confirm that you agree to the Terms of Use and confirm that you have read the Privacy Policy.</span>
            <input type="submit" name="submit" value="submit">
          </form>
        </div>
      </div>
    </div>
	<?php include 'footer.php' ?>
  </body>
</html>