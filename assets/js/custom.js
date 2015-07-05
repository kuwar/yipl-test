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

	// displaying csv data into table
    $.get('uploads/final.csv', function(data) {
    
		// start the ul
		var html = '<ul">';
		 
		// split into lines
		var rows = data.split("\n");
		 
		// parse lines
		rows.forEach( function getvalues(ourrow, key) {
			if ( key == 0 ) {
				return;
			}
			// split line into columns
			var columns = ourrow.split(",");
			 
			html += "<li><a class='contract-name' href='#' data-key='"+key+"'>" + columns[0] + "</li>";			
			 
		});
		
		// close ul
		html += "</ul>";
		 
		// insert into div
		$('#contract-container').append(html);

		$('.contract-name').on('click', function(e){
			e.preventDefault();
			var contract_details_html = "";
			$('#contract-details').html(contract_details_html);

			var key = $(this).data('key');

			var contract_details = rows[key];

			var contract_details_array = contract_details.split(",");

			contract_details_html = "status : "+contract_details_array[1]+"<br>bidPurchaseDeadline : "+contract_details_array[2]+"<br>bidSubmissionDeadline : "+contract_details_array[3]+"<br>bidOpeningDate : "+contract_details_array[4]+"<br>tenderid : "+contract_details_array[5]+"<br>publicationDate : "+contract_details_array[6]+"<br>publishedIn : "+contract_details_array[7]+"<br>contractDate : "+contract_details_array[8]+"<br>completionDate : "+contract_details_array[9]+"<br>awardee : "+contract_details_array[10]+"<br>awardeeLocation : "+contract_details_array[11]+"<br>Amount : "+contract_details_array[12];
			$('#contract-details').append(contract_details_html);

			// getting city, latitude and longitude
			var latlng = contract_details_array[13];
			var rem_quote = latlng.replace(/"/g, "");
			var latlng_array = rem_quote.split(" ");
			var lat = latlng_array[0];
			var lng = latlng_array[1];
			var city = contract_details_array[11];
			google.maps.event.addDomListener(window, 'load', init_map(lat, lng, city));
		});
	 
	});

	google.maps.event.addDomListener(window, 'load', init_map('27.7089603', '85.3261328', 'kathmandu'));
	
});
