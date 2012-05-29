<?php
/* code pasted in from old page controller. integrate anything necessary into this page.
  if ($page == 'map') {
  if ($subpage == NULL) {
  $title = 'MVHPC :: Map of Mount Vernon';
  ob_start();
  ?>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCJFrrSGy6p-7k8An5kvqJVJpaGRjV2aV4&sensor=false"> </script>
  <?php
  $headerCustom = ob_get_clean();
  array_push($headerJS, 'map-labels.js', 'map-viewer.js');
  } else if ($subpage == 'ash-park-district') {

  } else if ($subpage == 'commercial-district') {

  } else if ($subpage == 'cornell-district') {

  } else {
  redirect('../error/404.php');
  }
 */

$template = new Template();

$headerExtras['js'] = array('jquery-172.js', 'image-script.js', 'map-labels.js', 'map-viewer.js');
$headerExtras['custom'] = '<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCJFrrSGy6p-7k8An5kvqJVJpaGRjV2aV4&sensor=false"> </script>';
ob_start();

// load a Google Map overlay of Mount Vernon
?>

<div id="map" style="width: 750px; height: 600px"> </div>

<?php
$singleCol = ob_get_clean();
$template->setStyle('oneColumn');
$template->setTitle('MVHPC: Map of Mount Vernon');
$template->setHeaderExtras($headerExtras);
$template->setSingleCol($singleCol);

$template->output();
?>