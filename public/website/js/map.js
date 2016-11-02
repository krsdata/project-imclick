// necessary variables
var map;
var infoWindow;

// markersData variable stores the information necessary to each marker
var markersData =  markerMapData;


function initialize() {

   geocoder = new google.maps.Geocoder();
   //var latlng = new google.maps.LatLng(lat, lng); 
   var mapOptions = {
         zoom: 9
      }

   map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

   

   infoWindow = new google.maps.InfoWindow({maxWidth:300});

   // Event that closes the Info Window with a click on the map
   google.maps.event.addListener(map, 'click', function() {
      infoWindow.close();
   });

   // Finally displayMarkers() function is called to begin the markers creation
   displayMarkers();
   }

google.maps.event.addDomListener(window, 'load', initialize);


// This function will iterate over markersData array
// creating markers with createMarker function
function displayMarkers(){
   // this variable sets the map bounds according to markers position
   var bounds = new google.maps.LatLngBounds();
   
   // for loop traverses markersData array calling createMarker function for each marker 
   for (var i = 0; i < markersData.length; i++){

      var latlng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
      //console.log(markersData[i]);
     // var name = markersData[i].name;
      var address = markersData[i].address;
      var html = markersData[i].html;
      var icon = markersData[i].icon;

      createMarker(latlng,address,html,icon);

      // marker position is added to bounds variable
       bounds.extend(latlng);  
   }

   // Finally the bounds variable is used to set the map bounds
   // with fitBounds() function
   map.fitBounds(bounds);
   map.setZoom(9);
}

// This function creates each marker and it sets their Info Window content
function createMarker(latlng, name,html,icon, address1, address2, postalCode){      
   var marker = new google.maps.Marker({
      map: map,
      position: latlng,
     // zoom: 1,
      title: name,
      icon:icon
   });

   // This event expects a click on a marker
   // When this event is fired the Info Window content is created
   // and the Info Window is opened.
   google.maps.event.addListener(marker, 'click', function() {
      // Creating the content to be inserted in the infowindow
      var iwContent = '<div id="iw_container">' +
            '<div class="iw_title">' + html + '</div></div>';
      
      // including content to the Info Window.      
      infoWindow.setContent(iwContent); 
      infoWindow.open(map, marker);
   });
}