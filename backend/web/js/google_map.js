window.onload = function() {}

function initGoogleMap() {

	//Run this code only on create and update university pages.
	var mapContainer = document.getElementById('google-map-container');
	if (mapContainer) {

		//create a default map.
		var map = new google.maps.Map(mapContainer, {
        	center: {lat: 37.0902, lng: 95.7129},
        	zoom: 8
    	});

    	//add a click listener to map for the use to pick a location.
		map.addListener('click', function(e){
			if (map.marker) {
				map.marker.setMap(null);	
			}
			
			var marker = new google.maps.Marker({
		    position: e.latLng,
		    	map: map
		  	});
		  	map.panTo(e.latLng);
		  	map.marker = marker;

		  	$('#university-location').val(e.latLng);
		});		

		//If co-ordinates are already available, plot them on the map.
		var coords = $('#university-location').val();
		if (coords) {
			coords = coords.replace(/\(|\)/g, '');
			coords = coords.split(',');
			var lat = Number(coords[0]);
			var lng = Number(coords[1]); 		
			map.setCenter({
				lat: lat,
				lng: lng
			});
			var marker = new google.maps.Marker({
				map: map,
				position: {
					lat: lat,
					lng: lng
				}
			});

			if (map.marker) {
				map.marker.setMap(null);
			}

			map.marker = marker;
			//else use university name address city state and country to geocode lat lng and plot on map
    	}	    
	    else {
	    	var geocoder = new google.maps.Geocoder();
			geocoder.geocode({'address': getAddress()}, function(results, status){		
				if(status === google.maps.GeocoderStatus.OK) {
					map.setCenter(results[0].geometry.location);
					var marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location
					});

					map.marker = marker;

				} else {
					console.log('Cannot set marker: ' + status);
				}
			});	
	    }		
	}	
}

function getAddress() {
	var university = $('#university-name').val();
	var country = $("#country_id option:selected").html();
	var state = $("#state_id option:selected").html();
	var city = $("#city_id option:selected").html();
	var address = $("#university-address").val();

	var searchString = university ? university + ', ' : '';
	searchString += address ? address + ', ' : '';
	searchString += city ? city + ', ' : '';
	searchString += state ? state + ', ' : '';
	searchString += country ? country : '';
	
	return searchString;
	//return '450 Serra Mall Stanford, CA 94305';
}