<style type="text/css">
 body { font: normal 10pt Helvetica, Arial; }
 #map { width: 630px; height: 450px; border: 0px; padding: 0px;  }
 </style>
<?php /*?> <script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script><?php */?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1spQNxTqQOIhlnh5AjP0nkDRrv_1m60k&libraries=geometry"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
			<?php
						
						?>
                        
                        <script type="text/javascript">
 //Sample code written by August Li
 var icon = new google.maps.MarkerImage("<?php echo $_CONFIG["site_url"] ?>"+"images/blue.png", 
 new google.maps.Size(32, 32), new google.maps.Point(0, 0),
 new google.maps.Point(16, 32));
 var center = null;
 var map = null;
 var currentPopup;
 var bounds = new google.maps.LatLngBounds();
 function addMarker(lat, lng, info) {
 var pt = new google.maps.LatLng(lat, lng);
 bounds.extend(pt);
 var marker = new google.maps.Marker({
 position: pt,
 icon: icon,
 map: map
 });
 var popup = new google.maps.InfoWindow({
 content: info,
 maxWidth: 300
 });
  popup.open(map, marker);
/* google.maps.event.addListener(marker, "click", function() {
 if (currentPopup != null) {
 currentPopup.close();
 currentPopup = null;
 }
 popup.open(map, marker);
 currentPopup = popup;
 });
 google.maps.event.addListener(popup, "closeclick", function() {
 map.panTo(center);
 currentPopup = null;
 });*/
 }
 function initMap() {

 map = new google.maps.Map(document.getElementById("map"), {
 center: new google.maps.LatLng(0, 0),
 
 mapTypeId: google.maps.MapTypeId.ROADMAP,
 panControl:true,
    zoomControl:true,
    mapTypeControl:false,
    scaleControl:true,
    streetViewControl:true,
    overviewMapControl:true,
    rotateControl:true,
	 
 mapTypeControlOptions: {
 
     style: google.maps.MapTypeControlStyle.HORIZONTEL_BAR
    },
 navigationControl: true,
 navigationControlOptions: {
 style: google.maps.NavigationControlStyle.SMALL
 }
 });

 <?

$lat = 	31.511152;  
$lng = 	74.342957; 
$name="Gulberg, Lahore";
 //$desc="jgdfhgjd";
 echo ("addMarker($lat, $lng,'<b>$name</b>');\n");

 ?>
 //center = bounds.getCenter();
 //map.fitBounds(bounds);
 map.setCenter(bounds.getCenter());

 map.setZoom(15);
 
 }

 google.maps.event.addDomListener(window, 'load', initMap);
//window.onload = initMap;
 </script>
            
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Track Cars</label>
        					</div>
                        </div>
                        
								<?php
									echo "<h1>Track Page</h1>";
                                ?>  <?php if($_GET['b_id'])
								{
									?>
                                                               <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a href="index.php?page=bookings" class="button" >Back</a></div>

                               <?php
								}
								?><div id="map" style="margin-left:160px;"></div>
                      
				﻿</div> <!-- for AJAX -->
			</div>
