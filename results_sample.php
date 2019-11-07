<!DOCTYPE html>
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
          <table>
            <!--first row-->
            <tr class="table-row">
              <th class="table-row store">Store</th>
              <th class="table-row contact">Contact</th>
              <th  class="table-row ratings">Ratings</th>
            </tr>
            <tr>
              <td>
                <!--div class to includes store image , name and other info-->
                <div class="store-container">
                  <div class="store-image">
                    <a href="individual_sample.html"><img src="additional_files/store.png" alt="Store Image"></a>
                  </div>
                  <div class="store-name">
                    <h1><a href="individual_sample.html">Pet Valu</a></h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et nulla <span id="dots">...</span><span class="more">vel erat posuere eleifend. Suspendisse aliquet lobortis dolor, ac finibus ipsum sagittis eu. Mauris dapibus diam consectetur, imperdiet lacus vel, faucibus enim. Curabitur porta mi vel velit mattis, ut ultricies lectus scelerisque. Praesent tempus lectus quis neque scelerisque, id ultrices ipsum dignissim. Proin pretium, tellus sed viverra porta, ex augue viverra mi, sed feugiat neque odio consequat magna. Fusce eget egestas nisi. Nam rutrum massa quis elit consectetur dictum.</span></p>
                    <button onclick="">Read more</button>
                  </div>
                </div>
              </td>
              <td><p>(905) 628-1860</p></td>
              <td>✩✩✩✩✩</td>
            </tr>
            <tr>
              <td>
                <div class="store-container">
                  <div class="store-image">
                    <a href=""><img src="additional_files/store.png" alt="Store Image"></a>
                  </div>
                  <div class="store-name">
                    <h1><a href="">Dundas Valley Groomers</a></h1>
                    <p>Cras pulvinar nisl quis augue tempor, quis euismod ex lacinia. Pellentesque pretium non diam in elementum. Suspendisse scelerisque efficitur leo a accumsan. <span>...</span><span class="more">Sed eros massa, commodo at neque id, mattis elementum ex. Proin in est ac massa imperdiet scelerisque. Phasellus ligula leo, suscipit at porttitor id.</span></p>
                    <button onclick="">Read more</button>
                  </div>
                </div>
              </td>
              <td><p>(905) 628-3838</p></td>
              <td>✩✩✩✩</td>
            </tr>
            <tr>
              <td>
                <div class="store-container">
                  <div class="store-image">
                    <a href=""><img src="additional_files/store.png" alt="Store Image"></a>
                  </div>
                  <div class="store-name">
                    <h1><a href="">Animal House Professional</a></h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et nulla vel erat posuere eleifend. Suspendisse aliquet lobortis dolor, ac finibus ipsum sagittis eu. <span>...</span><span class="more">Mauris dapibus diam consectetur, imperdiet lacus vel, faucibus enim. Curabitur porta mi vel velit mattis, ut ultricies lectus scelerisque. Praesent tempus lectus quis neque scelerisque, id ultrices ipsum dignissim. Proin pretium, tellus sed viverra porta, ex augue viverra mi, sed feugiat neque odio consequat magna. Fusce eget egestas nisi. Nam rutrum massa quis elit consectetur dictum.</span></p>
                    <button onclick="">Read more</button>
                  </div>
                </div>
              </td>
              <td><p>(905) 627-4289</p></td>
              <td>✩✩✩✩</td>
            </tr>
            <tr>
              <td>
                <div class="store-container">
                  <div class="store-image">
                    <a href=""><img src="additional_files/store.png" alt="Store Image"></a>
                  </div>
                  <div class="store-name">
                    <h1><a href="">Global Pet Foods</a></h1>
                    <p>Buj ndji ckmo joremorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et nulla <span>...</span><span class="more">vel erat posuere eleifend. Suspendisse aliquet lobortis dolor, ac finibus ipsum sagittis eu. Mauris dapibus diam consectetur, imperdiet lacus vel, faucibus enim. Curabitur porta mi vel velit mattis, ut ultricies lectus scelerisque. Praesent tempus lectus quis neque scelerisque, id ultrices ipsum dignissim. Proin pretium, tellus sed viverra porta, ex augue viverra mi, sed feugiat neque odio consequat magna. Fusce eget egestas nisi. Nam rutrum massa quis elit consectetur dictum.</span></p>
                    <button onclick="">Read more</button>
                  </div>
                </div>
              </td>
              <td><p>(905) 628-8700</p></td>
              <td>✩✩✩✩</td>
            </tr>
          </table>
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