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

if ($page == 'archives') {
    if($subpage == 'images'){
      include 'images.php';
    } else if($subpage2 == 'Centennial-Book-Index'){
        include 'bookindex.php';
    }else if($subpage == 'documents'){
      include 'documents.php';
    } else if($subpage == 'cemetery') {
    } else if($subpage == 'eras') {
    } else {
        include 'about.php';
    }
} else if($page == 'map'){
    include 'map.php';
} else if($page == 'making-history'){
    include 'making-history.php';
} else if($page == 'about'){
    if($subpage == 'design-review'){
        include 'design-review.php';
    } else if($subpage == 'links'){
    } else {
        include 'about.php';
    }
} else {
    redirect('../error/404.php');
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
