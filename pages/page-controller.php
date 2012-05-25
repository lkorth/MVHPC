<?php

// include the framework and templating
require_once '../includes/master.inc.php';
require_once '../includes/class.template.php';

// define a new template
$template = new Template();

// custom JS, CSS, etc. for any page (loaded first)
$headerCustom = array();

// default JS to load
$headerJS = array(
  0 => 'jquery-172.js',
  1 => 'jquery-bgiframe-min.js',
  2 => 'jquery-ajaxQueue.js',
  3 => 'jquery-autocomplete.js',
  4 => 'inpage_script.js',
  5 => 'functions.js',
  6 => 'base64.js',
  7 => 'magiczoom.js',
);

// default CSS to load
$headerCSS = array(
  0 => 'jquery.autocomplete.css',
  1 => 'magiczoom.css',
);

// get current page
if (!isset($_GET['page'])) {
  redirect('../error/404.php');
}
$page = $_GET['page'];

// get the sub-page, if applicable
$subpage = NULL;
if (isset($_GET['subpage']) && !empty($_GET['subpage'])) {
  $subpage = $_GET['subpage'];
}

// get the sub-sub-page, if applicable
$subpage2 = NULL;
if (isset($_GET['subpage2']) && !empty($_GET['subpage2'])) {
  $subpage2 = $_GET['subpage2'];
}

// Define variables for each page, like title
// include ALL custom CSS, Javascript, etc.
// load custom page content with $id = 0, otherwise from DB
// for two-column page: $template -> setStyle('twoColumn');
if ($page == 'map') {
  if ($subpage == NULL) {
      $title = 'MVHPC :: Map of Mount Vernon';
      $id = 0;
      ob_start();
      ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCJFrrSGy6p-7k8An5kvqJVJpaGRjV2aV4&sensor=false"> </script>
      <?php
      array_push($headerCustom, ob_get_clean());
      array_push($headerJS, 'map-labels.js', 'map-viewer.js');

  } else if ($subpage == 'ash-park-district') {


  } else if ($subpage == 'commercial-district') {


  } else if ($subpage == 'cornell-district') {


  } else {
      redirect('../error/404.php');
  }

} else if ($page == 'archives') {
  if ($subpage == NULL) {
      $title = 'MVHPC :: Archives';
      $id = 2;

  } else if ($subpage == 'documents') {
      $title = 'MVHPC :: Documents';
      $id = 0;
      $pdfFile = $subpage2;
      include 'documents.php';
      if ($viewing) {
        ob_start();
        pageVars($pdfFile, $pdfURL);
        array_push($headerCustom, ob_get_clean());
        if ($supported) {
//          array_push($headerJS, 'pdf-js/pdf.js', 'pdf-js/pdf-viewer.js');
        }
      }
      

  } else if ($subpage == 'images') {
      $title = 'MVHPC :: Images';
      $id = 6;

  } else {
      redirect('../error/404.php');
  }

} else if ($page == 'about') {
  if ( $subpage == NULL) {
      $title = 'MVHPC :: About Us';
      $id = 3;

  } else if ($subpage == 'links') {
      $title = 'MVHPC :: Links';
      $id = 8;

  } else if ($subpage == 'design-review') {
      $title = 'MVHPC :: Design Review';
      $id = 0;
      $pdfFile = $subpage2;
      include 'design-review.php';
      if ($viewing) {
        ob_start();
        pageVars($pdfFile, $pdfURL);
        array_push($headerCustom, ob_get_clean());
        if ($supported) {
//          array_push($headerJS, 'pdf-js/pdf.js', 'pdf-js/pdf-viewer.js');
        }
      }

  } else {
      redirect('../error/404.php');
  }

} else {
    redirect('error/404.php');
}

// package up the custom code to the template
$headerExtras = array(
  'custom' => $headerCustom,
  'js' => $headerJS,
  'css' => $headerCSS,
);
$template->setHeaderExtras($headerExtras);

// set title for each page
if (isset($title)) {
  $template->setTitle($title);
}

// open PHP buffer, grab page content
ob_start();

// if $id exists, load page from database
if ($id != 0) {
  $db = Database::getDatabase();
  $row = $db->getRow("SELECT * FROM pages WHERE id = '$id'");
  echo $row['data'];
}

// otherwise, load page from a file
else {
  if ($page == 'map') {
      include 'map.php';

  } else if ($page == 'archives' && $subpage == 'documents') {
      pageDisplay($viewing, $supported, $pageRoot, $pdfDirURL, $pdfURL);
      
  } else if ($page == 'about' && $subpage == 'design-review') {
      pageDisplay($viewing, $supported, $pageRoot, $pdfDirURL, $pdfURL);
  }
}

// grab the content to display
$content = ob_get_clean();

// send the body to the template to display
$template->setBody($content);

// render the template
$template->output();

?>
