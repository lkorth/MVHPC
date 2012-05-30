<?php

// this file is to display a map permanently
// in the left content pane, right pane changes

// display the Google Map in left content
ob_start();
  ?>
<h1 class="ribbon"> Map </h1>

<div id="map"> </div>
  <?php
$leftCol = ob_get_clean();

// load custom code and JavaScript
ob_start();
  ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCJFrrSGy6p-7k8An5kvqJVJpaGRjV2aV4&sensor=false"> </script>
  <?php
$headerCustom = ob_get_clean();
array_push($headerJS, 'map-labels.js', 'map-viewer.js');

// send the map to the template
$template->setLeftCol($leftCol);

?>
