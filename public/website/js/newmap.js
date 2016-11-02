$(document).ready(function(e) {
    // init map
    function initMap(lat, long) { 
      
      var contentString="<p>Latitude: "+lat+"</p>"+"<p>Longitude: "+long+"</p>";
      var infowindow = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
  });
      var center = new google.maps.LatLng(parseFloat(lat), long);
        var mapOptions = {center: center, zoom: 16, scrollwheel: false};
        map = new google.maps.Map(document.getElementById("register-form__map"), mapOptions);
        marker = new google.maps.Marker({position: new google.maps.LatLng(lat, long), draggable:true, map: map,title: 'Immoclick'});
        google.maps.event.addListener(marker, 'dragend', function (event) {
        var lat = this.getPosition().lat();
        var long = this.getPosition().lng();    
        infowindow.open(map, marker);    
        initMap(lat, long);

        $('.register-form__latitude-holder').val(lat);
        $('.register-form__longitude-holder').val(long);
      });   
      infowindow.open(map, marker);
      marker.addListener('click', function() {
      infowindow.open(map, marker);
  });
    }
    /**
         * Geocode when user location input changes
         */
    // $('body').on('change', '.location_button', function(e) {
      $('.location_button').click(function(e) {
      
         var address = $('#user_location').val();
         
      var geocoder = new google.maps.Geocoder();

      if (geocoder) {
        geocoder.geocode({ 'address': address }, function (results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            console.log(results[0].geometry.location);
            var lat = results[0].geometry.location.lat();
            var long = results[0].geometry.location.lng();
            console.log("lat="+lat);
            $('#address').val(results[0].formatted_address);

            initMap(lat, long);
            $('.register-form__latitude-holder').val(lat);
            $('.register-form__longitude-holder').val(long);
          }
          else {
            // alert("Kunne ikke finne denne adressen, vennligst skriv en i nærheten og dra pin'en på kartet nærmest mulig riktig posisjon.");
            $('.register-form__latitude-holder').focus().select();
          }
        });
      }
    });
                
    var lat =  $('.register-form__latitude-holder').val();
    var long = $('.register-form__longitude-holder').val();    
    initMap(lat, long); 
      
});