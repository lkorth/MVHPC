<!doctype html>

<?php

// include the framework and templating
require_once '../includes/master.inc.php';
require_once '../includes/class.template.php';

// define a new template
$template = new Template();

// custom JS, CSS, etc. for any page (loaded first)
$headerCustom = NULL;

// default JS to load
$headerJS = array(
  0 => 'jquery-172.js',
  1 => 'functions.js',
  2 => 'base64.js'
);

// default CSS to load
$headerCSS = array();

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

// get the sub-sub-sub-page, if applicable
$subpage3 = NULL;
if (isset($_GET['subpage3']) && !empty($_GET['subpage3'])) {
  $subpage3 = $_GET['subpage3'];
}

// Define variables for each page, like title
// include ALL custom CSS, Javascript, etc.
// load custom page content with $id = 0, otherwise from DB
// for two-column page: $template -> setStyle('twoColumn');

$template->setStyle('oneColumn');

if ($page == 'map') {
  if ($subpage == NULL) {
      $title = 'MVHPC :: Map of Mount Vernon';
      $id = 0;
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

} else if ($page == 'archives') {
  if ($subpage == NULL) {
      $title = 'MVHPC :: Archives';
      $id = 2;

  } else if ($subpage == 'documents') {
      $title = 'MVHPC :: Documents';
      $id = 0;
      $pdfFile = $subpage2;
      array_push($headerCSS, 'pdf-viewer.css');
      include 'documents.php';
      if ($pdfViewing) {
        ob_start();
        jsVars();
        $headerCustom = ob_get_clean();
        if ($pdfSupported) {
          array_push($headerJS, 'pdf-js/pdf-min.js', 'pdf-js/pdf-viewer.js');
        }
      }

  } else if ($subpage == 'images') {
      $fullsize = ($subpage2 != NULL && is_numeric($subpage2[0]));
      if (!$fullsize) {
        $title = 'MVHPC :: Images';
        $id = 0;
        array_push($headerJS, 'jquery-bgiframe-min.js',
                              'jquery-ajaxQueue.js',
                              'jquery-autocomplete.js',
                              'inpage_script.js');
        array_push($headerCSS, 'jquery.autocomplete.css');
      }
      else {
        $title = 'MVHPC :: Images';
        $id = 0;
        array_push($headerJS,
          'jquery-mousewheel.js',
          'jquery-ui-1820-custom-min.js',
          'jquery-gzoom.js'
        );
        array_push($headerCSS,
          'jquery-ui-1820-custom.css',
          'jquery-gzoom.css'
        );
      }
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
      array_push($headerCSS, 'pdf-viewer.css');
      include 'design-review.php';
      if ($pdfViewing) {
        ob_start();
        jsVars();
        $headerCustom = ob_get_clean();
        if ($pdfSupported) {
          array_push($headerJS, 'pdf-js/pdf-min.js', 'pdf-js/pdf-viewer.js');
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
if (isset($id) && $id != 0) {
  $db = Database::getDatabase();
  $row = $db->getRow("SELECT * FROM pages WHERE id = '$id'");
  echo $row['text'];
}

// otherwise, load page from a file
else {
  if ($page == 'map') {
      include 'map.php';
  }
  else if($subpage == 'images'){
      if (!$fullsize) {
        $subpage3 = $_GET['subpage3'];
        include 'images.php';
      }
      else {
        include 'fullsize.php';
      }
  }
  // pdf viewer, display the page by passing in needed variables
  else if ($page == 'archives' && $subpage == 'documents') {
      generatePage();

  // pdf viewer, display the page by passing in needed variables
  } else if ($page == 'about' && $subpage == 'design-review') {
      generatePage();
  }
}

// grab the content to display
$content = ob_get_clean();

// send the body to the template to display
if($template->getStyle() == 'oneColumn') {
    $template->setSingleCol($content);
}else{
    $template->setLeftCol($leftCol);
    $template->setRightCol($rightCol);
}



// render the template
$template->output();

?>
