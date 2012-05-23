// Google Maps - integration with API v.3
// original code converted from API v.2
// http://econym.org.uk/gmap/geoxml.htm

// code will wait for all the images to load before executing (JQuery)
$(window).load(function() {
  initialize();
});

// 
function initialize() {
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

  // must do manually, this sucks
  var cornellLoc = new google.maps.LatLng(41.926985, -91.425205);
  var cornellMark = new MarkerWithLabel({
    position: cornellLoc,
    map: map,
    labelContent: "Cornell College",
    labelAnchor: new google.maps.Point(22, 0),
    labelClass: "map-labels" // the CSS class for the label
  });
  var ashLoc = new google.maps.LatLng(41.928230, -91.419626);
  var ashMark = new MarkerWithLabel({
    position: ashLoc,
    map: map,
    labelContent: "Ash Park",
    labelAnchor: new google.maps.Point(22, 0),
    labelClass: "map-labels" // the CSS class for the label
  });
  var commLoc = new google.maps.LatLng(41.922675, -91.417502);
  var commMark = new MarkerWithLabel({
    position: commLoc,
    map: map,
    labelContent: "Commercial",
    labelAnchor: new google.maps.Point(22, 0),
    labelClass: "map-labels" // the CSS class for the label
  });

  // load link from marker with label  
  google.maps.event.addListener(cornellMark, 'click', function(e) {
    window.location.href = "../old-site/Cornell%20Dostrict.html";
  });
  google.maps.event.addListener(ashMark, 'click', function(e) {
    window.location.href = "../old-site/Ash%20Park%20District.html";
  });
  google.maps.event.addListener(commMark, 'click', function(e) {
    window.location.href = "../old-site/Commercial%20District.html";
  });

  // load new link in polygon
  google.maps.event.addListener(kml, 'click', function(kmlEvent) {
    if (kmlEvent.featureData.description == "Cornell") {
      window.location.href = "../old-site/Cornell%20Dostrict.html";
    }

    else if (kmlEvent.featureData.description == "Ash") {
      window.location.href = "../old-site/Ash%20Park%20District.html";
    }

    else if (kmlEvent.featureData.description == "Commercial") {
      window.location.href = "../old-site/Commercial%20District.html";
    }
//this.setOptions({fillColor: "#00FF00"});
//console.debug(kmlEvent);
//  var text = kmlEvent.featureData.description;
//  showInDiv(text);
});

//google.maps.event.addListener(kml, 'mousemove', function() {
//  tooltip.show("<strong> Polygon Hovering </strong> <br /> <p> This is a work-around! </p>");
//});

//google.maps.event.addListener(kml, 'mouseover', function() {
//window.location.href = "http://www.google.com/";
//this.setOptions({fillColor: "#00FF00"});
//console.debug(kmlEvent);
//  var text = kmlEvent.featureData.description;
//  showInDiv(text);
//});
}
