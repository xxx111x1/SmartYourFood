<!DOCTYPE html>
<html>
  <head>
    <title>Add an address</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/address.css">
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/address/address.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkvY-Zv3LB0uIoS-Yt4MMYyi0gug1ykCg&libraries=places&callback=initMap" async defer></script>
  </head>
  <body>
  	<input type="hidden" id="returnUrl" value="<?php echo $return_url;?>"></input>
    <input id="contact_input"class="controls"  type="text" placeholder="Enter Contact Name"/>
    <input id="phone_input" class="controls" type="text" placeholder="Enter Contact Phone"/>
    <input id="pac-input" class="controls" type="text"
        placeholder="Enter a location">
    <div id="type-selector" class="controls">

      <input type="radio" name="type" id="changetype-all" checked="checked">
      <label for="changetype-all">All</label>

      <input type="radio" name="type" id="changetype-establishment">
      <label for="changetype-establishment">Establishments</label>

      <input type="radio" name="type" id="changetype-address">
      <label for="changetype-address">Addresses</label>

      <input type="radio" name="type" id="changetype-geocode">
      <label for="changetype-geocode">Geocodes</label>
    </div>
    <div id="map"></div>  
  </body>
</html>