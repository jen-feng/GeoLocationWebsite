<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta property="og:url" content="http://52.70.212.150/individual_sample.html"/>
    <meta property="og:type" content="website" />
    <meta property="og:title"  content="Lorem Ipsum: I found it!" />
    <meta property="og:description" content="This chain of pet stores is open all around the world and offers a great service to new and old pet owners." />
    <meta property="og:image" content="http://52.70.212.150/additional_files/petValuMap.jpg" />
    <meta property="fb:app_id" content="451521718789556">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Lorem Ipsum: I found it!">
    <meta name="twitter:description" content="This chain of pet stores is open all around the world and offers a great service to new and old pet owners.">
    <meta name="twitter:image" content="http://52.70.212.150/additional_files/petValuMap.jpg">
    <meta name="twitter:site" content="@USERNAME">
    <meta name="twitter:creator" content="@USERNAME">
    <link rel="stylesheet" href="../additional_files/objectPage.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <td class="subject">Service Hours</td>
                <td id="service_hours"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="results-content">
        <table>
          <!--first row-->
          <tr class="table-row">
            <th class="table-row store">Reviews</th>
            <th class="table-row contact">User</th>
            <th  class="table-row ratings">Ratings</th>
          </tr>
          <tr>
            <td>
              <!--div class to includes User Image , name and other info-->
              <div class="user-container">
                <div class="user-image">
                  <img src="../additional_files/usericon.png" alt="User Image">
                </div>
                <div class="user-comments">
                  <h2>Quite helpful!</h2>
                  <p>Curabitur porta mi vel velit mattis, ut ultricies lectus scelerisque. 
                    Praesent tempus lectus quis neque scelerisque, id ultrices ipsum dignissim. Proin pretium, tellus sed viverra porta, Fusce eget egestas nisi. 
                    Nam rutrum massa quis elit consectetur dictum.</p>
                </div>
              </div>
            </td>
            <td><p>Charlie</p></td>
            <td>✩✩✩✩✩</td>
          </tr>
          <tr>
            <td>
              <div class="user-container">
                <div class="user-image">
                  <img src="../additional_files/usericon.png" alt="User Image">
                </div>
                <div class="user-comments">
                  <h2>Great service!</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et nulla vel erat posuere eleifend. 
                      Suspendisse aliquet lobortis dolor.</p>
                  <h3>Uploaded Photo(s):</h3>
                  <picture>
                    <source media="(max-width: 700px)" srcset="../additional_files/sample_image_150w.jpg">
                    <source media="(min-width: 800px)" srcset="../additional_files/sample_image.jpg">
                    <img id="sample_image" src="../additional_files/sample_image.jpg" alt="A picture of the store view  of pet valu">
                  </picture>
                </div>
              </div>
            </td>
            <td><p>Snoopy</p></td>
            <td>✩✩✩✩</td>
          </tr>
          <tr>
            <td>
              <div class="user-container">
                <div class="user-image">
                  <img src="../additional_files/usericon.png" alt="User Image">
                </div>
                <div class="user-comments">
                  <h2>Thorough vet process</h2>
                    <p>Phasellus et nulla vel erat posuere eleifend. 
                        Suspendisse aliquet lobortis dolor, id ultrices ipsum dignissim. Proin pretium, tellus sed viverra porta, 
                        ex augue viverra mi, sed feugiat neque odio consequat magna. Fusce eget egestas nisi. 
                        Nam rutrum massa quis elit consectetur dictum.</p>
                </div>
              </div>
            </td>
            <td><p>Lucy</p></td>
            <td>✩✩✩✩</td>
          </tr>
          <tr>
            <td>
              <div class="user-container">
                <div class="user-image">
                  <img src="../additional_files/usericon.png" alt="User Image">
                </div>
                <div class="user-comments">
                  <h2>OK service</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et nulla vel erat posuere eleifend. 
                      Suspendisse aliquet lobortis dolor, ac finibus ipsum sagittis eu. Mauris dapibus diam consectetur, 
                      imperdiet lacus vel, faucibus enim.</p>
                </div>
              </div>
            </td>
            <td><p>Marcie</p></td>
            <td>✩✩</td>
          </tr>
        </table>
        <!--an element for the table paging, hard coded for now-->
        <div class="page-container">
          <p class="page">Page 1 of Page 1<p>
        </div>
      </div>
    </div>
	<?php include 'footer.php' ?>
    <script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyhVAtMlWygSGml79zYG-WnGlLxU9B3ho&libraries=places&callback=initMap"></script>
  </body>
</html>