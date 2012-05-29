<?php
// include the framework and templating
require_once '../includes/master.inc.php';
require_once '../includes/class.template.php';

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

if ($page == 'archives' && $subpage == 'images') {
//????
    if (!$fullsize) {
//        $subpage3 = $_GET['subpage3'];
        include 'images.php';
    } else {
        include 'fullsize.php';
    }
}
// documents from the archives
else if ($page == 'archives' && $subpage == 'documents') {
    // show the Centennial Book index instead
    if ($subpage2 == 'Centennial-Book-Index') {
        include 'bookindex.php';
    }
    // pdf viewer, display the page by passing in needed variables
    else {
        include 'documents.php';
//        generatePage();
    }

    // pdf viewer, display the page by passing in needed variables
} else if ($page == 'about' && $subpage == 'design-review') {
//    generatePage();
} else {
    include($page . '.php');
}
?>
