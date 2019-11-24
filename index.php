<!DOCTYPE html>
<html>
  <head>
    <title>
      Search Form
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/additional_files/searchPage.css" >
    <script  type="text/javascript" src="/additional_files/search.js"></script>
  </head>
  <body>
    <?php include 'header.php' ?>
    <div class="body-content">
      <div class="container-box">
        <h1 class="title">Find A Pet Here</h1>
        <form class="search-form" action="results_sample.php" name="search-form" method="POST" id="searchForm"> 
          <div class="search-container">
            <?php include "partialSearch.php"; ?>
          </div>
          <div class="submit-button">
            <input type="submit" value="search" name="submit" class="button">
          </div>
          <div class = "location">
            <!--explicitly specify the button type to prevent submitting the form-->
            <button type="button" onclick="getLocation()" class = "location-button">Search by My Location</button>
            <label class="field-validation-error" id="error_msg_ll"></label>
          </div>
        </form>
      </div>
    </div>
	<?php include 'footer.php' ?>
  </body>
</html>