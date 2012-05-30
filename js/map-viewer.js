// Google Maps - integration with API v.3
// original code converted from API v.2
// http://econym.org.uk/gmap/geoxml.htm

// code will wait for all the images to load before executing (JQuery)
$(window).load(function() {
  initialize();
});

// create the Google Map on the page
function initialize() {
  // settings for the map and UI
  var options = {
    center: new google.maps.LatLng(41.925753, -91.425515),
    zoom: 8,
    mapTypeId: google.maps.MapTypeId.HYBRID,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
    },
    streetViewControl: false,
    disableDoubleClickZoom: true
  };
  
  // grab and generate the overlay
  // REMOVE MY URL FOR PRODUCTION SERVER!!!
  var kml = new google.maps.KmlLayer("http://seanpmckenna.com/temp/mtVernonDistricts.kml", {suppressInfoWindows: true});
  var map = new google.maps.Map(document.getElementById("map"), options);
  kml.setMap(map);

  // create labels for each district (manually)
  setMarkers(map, districts);

  // detect a mouse click inside the polygons (from KML)
  google.maps.event.addListener(kml, 'click', function(kmlEvent) {

    // Cornell College district - load page
    if (kmlEvent.featureData.description == "Cornell") {
      window.location.href = mapsURL + "cornell-college/";
    }

    // Ash Park district - load page
    else if (kmlEvent.featureData.description == "Ash") {
      window.location.href = mapsURL + "ash-park/";
    }

    // Commercial district - load page
    else if (kmlEvent.featureData.description == "Commercial") {
      window.location.href = mapsURL + "commercial/";
    }
  });
}

// districts to mark with labels
// this must be done manually, 
// or in a separate KML file
var districts = [
  ['Cornell College', 41.929512, -91.426038, 1],
  ['Commercial', 41.922911, -91.417214, 2],
  ['Ash Park', 41.928922, -91.419708, 3]
];

// create the labels for each district on the map
function setMarkers (map, locations) {
  // load the custom label image
  var img = new google.maps.MarkerImage('/mvhpc/images/marker-panel.png',
    new google.maps.Size(100, 39),
    new google.maps.Point(0, 0),
    new google.maps.Point(50, 39));

  // create a shape for the image label
  var shape = {
    coord: [1, 1, 1, 20, 18, 20, 18, 1],
    type: 'poly'
  };

  // for each location/district, place the marker label
  for (var i = 0; i < locations.length; i++) {
    var district = locations[i];
    var myLatLng = new google.maps.LatLng(district[1], district[2]);
    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      icon: img,
      shape: shape,
      title: district[0],
      zindex: district[3]
    });
    var label = new Label({
      map: map
    });
    label.set('zIndex', 1234);
    label.bindTo('position', marker, 'position');
    label.set('text', district[0]);
  }
}
