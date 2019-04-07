<?php
	//include ("Source/lib/open_con2.php");
  
	/*$region = $_GET['id'];
  
	$query = mysql_query("select * from tbl_region where region_code = '$region'");
	while ($data = mysql_fetch_array($query)) {
		$nameRegion = $data['region_name'];                       
	}*/
	
	$latitude = $_REQUEST['latitude'];
	$longitude = $_REQUEST['longitude'];
	$collateral_id = $_REQUEST['collateral_id'];
?>
 
<!DOCTYPE html>
<html>
  <head>
    <style>
      #map-canvas {
        width: 1000px;
        height: 500px;
      }
    </style>
	<title>Maps Jaminan</title>
    <link rel="shortcut icon" href="Source/img/favicon.ico" type="image/x-icon">
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
    var marker;
		function initialize() {
			var mapCanvas = document.getElementById('map-canvas');
			
			var mapOptions = {
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}     
			var map = new google.maps.Map(mapCanvas, mapOptions);
			var infoWindow = new google.maps.InfoWindow;      
			var bounds = new google.maps.LatLngBounds();
	 
	 
			function bindInfoWindow(marker, map, infoWindow, html) {
				google.maps.event.addListener(marker, 'click', function() {
					infoWindow.setContent(html);
					infoWindow.open(map, marker);
				});
			}
 
			function addMarker(lat, lng, info) {
				var pt = new google.maps.LatLng(lat, lng);
				bounds.extend(pt);
				var marker = new google.maps.Marker({
					map: map,
					position: pt
				});       
				map.fitBounds(bounds);
				var listener = google.maps.event.addListener(map, "idle", function() { 
				  if (map.getZoom() > 15) map.setZoom(15); 
				  google.maps.event.removeListener(listener); 
				});				
				bindInfoWindow(marker, map, infoWindow, info);
			}
 
			<?php
				/*$query = mysql_query("select * from tbl_branch where branch_region_id = '$region'");
				while ($data = mysql_fetch_array($query)) {
					$lat = $data['branch_lat'];
					$lon = $data['branch_lon'];
					$nama = $data['branch_name'];
					$alamat = preg_replace('/^\s+|\n|\r|\s+$/m', ' ', $data['branch_address']);
					echo ("addMarker($lat, $lon, '<b>$nama</b><br>$alamat');\n");                        
				}*/
				
				echo ("addMarker('$latitude', '$longitude', '<b>Jaminan</b><br>$alamat');\n");                        
			?>
        }
		google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
	<!--<input type="text" name="txtsearch" id="txtsearch"><input type="button" name="search" value="Search" id="search" onclick="searchMaps()">-->
	<h2>Lokasi Jaminan <?php echo $collateral_id;?></h2>
    <div id="map-canvas"></div>
  </body>
</html>