<?php
// include the framework and templating
require_once '../includes/master.inc.php';
require_once '../includes/class.template.php';

// create the template
$template = new Template();

// allow for code to be inserted into the header
// custom HTML, javascript, CSS (in this order)
// custom HTML is written as an object buffer
// javascript and CSS should insert files with array_push
$headerCustom = NULL;
$headerCSS = array();
$headerJS = array();

// get current page
if (!isset($_GET['page']) || !file_exists($_GET['page'].'.php') ) {
    redirect('../error/error.php?type=404');
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

if ($page == 'archives') {
    if($subpage == 'images'){
      $fullsize = ($subpage2 != NULL && is_numeric($subpage2[0]));
      if (!$fullsize) {
        include 'images.php';
      }
      else{
        include 'images-full.php';
      }
    } else if($subpage == 'Centennial-Book-Index'){
        include 'centennial-book-index.php';
    } else if($subpage == 'documents'){
        include 'documents.php';
    } else if($subpage == 'cemetery') {
        include 'cemetery.php';
    } else if($subpage == 'eras') {
        include 'eras.php';
    } else {
        include 'archives.php';
    }
} else if($page == 'map'){
    if ($subpage == 'ash-park'){
        include 'map-ash-park.php';
    } else if ($subpage == 'commercial'){
        include 'map-commercial.php';
    } else if ($subpage == 'cornell-college'){
        include 'map-cornell-college.php';
    } else {
        include 'map.php';
    }
    include 'map-display.php';
} else if($page == 'making-history'){
    include 'making-history.php';
} else if($page == 'about'){
    if($subpage == 'design-review'){
        include 'design-review.php';
    } else if($subpage == 'links'){
    } else {
        include 'about.php';
    }
} else if ($page == 'request-tag-change') {
    include 'request-tag-change.php';
}

// package up header items and send to template
$headerExtras = array(
  'custom' => $headerCustom,
  'css' => $headerCSS,
  'js' => $headerJS,
);
$template->setHeaderExtras($headerExtras);

// output the template
$template->output();
?>
