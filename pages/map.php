<?php

// set up template title & style
$template->setTitle('MVHPC :: Map');
$template->setStyle('oneColumn');

// load custom code and JavaScript
ob_start();
  jsVars();
$headerCustom = ob_get_clean();
array_push($headerJS, 'map-labels.js', 'map-viewer.js');

// display the page with intro and Google Map
ob_start();
  generatePage();
$content = ob_get_clean();

// send content to template
$template->setSingleCol($content);

// print out JS vars
function jsVars() {
  ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCJFrrSGy6p-7k8An5kvqJVJpaGRjV2aV4&sensor=false"> </script>
  <?php
}

// print out the content
function generatePage() {
  ?>
<h1 class="ribbon"> Districts of Mount Vernon </h1>

<p class="body_text">
  The primary responsibility of the Commission is to designate Historic Districts. The procedure for designating a historic district includes: historical research on the buildings and neighborhood, public hearings for property owners, Planning and Zoning Commission review, State Historic Preservation Office (SHPO) review, and City Council approval.
</p>
<p class="body_text">
Mt. Vernon currently has three National Historic Districts: the Ash Park Residential, the Commercial, and the Cornell College districts. No Local Historic Districts have been designated.
</p>
  
<div id="map" style="width: 750px; height: 600px"> </div>
  <?php
}

?>
