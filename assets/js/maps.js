$(document).ready(function(){

	function init_map(lat, lng, place) {
		var var_location = new google.maps.LatLng(lat,lng);
 
        var var_mapoptions = {
          center: var_location,
          zoom: 14
        };
 
		var var_marker = new google.maps.Marker({
			position: var_location,
			map: var_map,
			title: place});
 
        var var_map = new google.maps.Map(document.getElementById("map-container"),
            var_mapoptions);
 
		var_marker.setMap(var_map);	 
    }
 
    google.maps.event.addDomListener(window, 'load', init_map('27.7089603', '85.3261328', 'kathmandu'));

});