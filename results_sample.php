﻿<!DOCTYPE html>
<html>
  <head>
    <title>
      Search Results Page
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../additional_files/searchResultsPage.css" >
    <script  type="text/javascript" src="../additional_files/search.js"></script>
  </head>
  <body>
    <?php include 'header.php' ?>
    <div class="body-content">
      <form class="container-box" action="results_sample.html" name="search-form" > 
        <div class="search-container">
          <div class="searchbar">
            <input type="search" name="search" id="search" placeholder="What are you looking for?">
          </div>  
          <div class="ratings-container">
            <select id="ratings">
              <option value="" disabled selected hidden>Ratings</option>
              <option value="5">✩✩✩✩✩</option>
              <option value="4">✩✩✩✩</option>
              <option value="3">✩✩✩</option>
              <option value="2">✩✩</option>
              <option value="1">✩</option>
            </select>
          </div>
          <div class="submit-button">
            <input type="submit" value="search" class="button">
          </div>
          <div class = "location">
            <!--explicitly specify the button type to prevent submitting the form-->
            <button type="button" onclick="getLocation()" class = "location-button">Search by My Location</button>
          </div>
          <label class="field-validation-error" id="error_msg_ll"></label>
        </div>
      </form>
      <div class="results-container">
        <div class="map-container">
          <div id="map"></div>
          <script type="text/javascript" src="additional_files/results_map.js"></script>
          <div class="map-border">
            <p id="map_title">Results on Map</p>
          </div>
        </div>
        <div class="results-content">
            <?php include "sql/getStoresResult.php" ?>
          <!--an element for the table paging, hard coded for now-->
          <div class="page-container">
            <p class="page">Page 1 of Page 1<p>
          </div>
        </div>
      </div>
    </div>
	<?php include 'footer.php' ?>
    <script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyhVAtMlWygSGml79zYG-WnGlLxU9B3ho&libraries=places&callback=initMap"></script>
  </body>
</html>