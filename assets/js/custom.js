/* Theme Name: The Project - Responsive Website Template
 * Author:HtmlCoder
 * Author URI:http://www.htmlcoder.me
 * Author e-mail:htmlcoder.me@gmail.com
 * Version:1.0.0
 * Created:March 2015
 * License URI:http://support.wrapbootstrap.com/
 * File Description: Place here your custom scripts
 */
$(document).ready(function(){
	$('.noenter').on('keyup keypress', function(e) {
		var code = e.keyCode || e.which;
		if (code == 13) {
			e.preventDefault();
			return false;
		}
	});
});

(function($){
	$(document).ready(function(){
		// Set the time at which the countdown expires.
		// var untilDate new Date(Year, Month - 1, Day)
		//-----------------------------------------------
		var untilDate = new Date(2015, 8 - 1, 29,13,0,0);
		console.log(untilDate);

		$(".countdown").countdown({
			since: untilDate,
			format: 'dHMS',
			padZeroes: true
		});

	}); // End document ready

})(this.jQuery);

(function($){
	$(document).ready(function(){

		// Google Maps
		//-----------------------------------------------
		if ($("#map-canvas").length>0) {
			var map, myLatlng, myZoom, marker;
			// Set the coordinates of your location
			myLatlng = new google.maps.LatLng(54.312189, 8.587985);
			myZoom = 10;
			function initialize() {
				var mapOptions = {
					zoom: myZoom,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					center: myLatlng,
					scrollwheel: false
				};
				map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
				marker = new google.maps.Marker({
					map:map,
					draggable:true,
					animation: google.maps.Animation.DROP,
					position: myLatlng
				});
				google.maps.event.addDomListener(window, "resize", function() {
					map.setCenter(myLatlng);
				});
			}
			google.maps.event.addDomListener(window, "load", initialize);
		}
	}); // End document ready

})(this.jQuery);