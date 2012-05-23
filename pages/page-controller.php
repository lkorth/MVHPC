<?php

require_once '../includes/master.inc.php';

if (!isset($_GET['page']))
    redirect('../error/404.php');

$page = $_GET['page'];

if ($page == 'about-us') {
    $title = "MVHPC :: About Us";
    $id = 3;
} else if ($page == 'districts') {
    $title = "MVHPC :: Districts";
    $id = 4;
} else if ($page == 'history') {
    $title = "MVHPC :: History";
    $id = 2;
} else if ($page == 'images') {
    $title = "MVHPC :: Images";
    $id = 6;
} else if ($page == 'links') {
    $title = "MVHPC :: Links";
    $id = 8;
} else if ($page == 'text') {
    $title = "MVHPC :: Text";
    $id = 5;
} else if ($page == 'design-review') {
    $title = "MVHPC :: Design Review";
    $id = 7;
// additions to current page-listings
// id = 1 for non-database loading pages
// currently, this is the maps page, 
} else if ($page == 'map'){
    $title = "MVHPC :: Map of Mount Vernon";
    $id = 0;
} else {
    redirect('../error/404.php');
}


$level = '../';
include '../shared/header.php';

// if $id exists, load page from database
if ($id != 0) {
$db = Database::getDatabase();
$row = $db->getRow("SELECT * FROM pages WHERE id = '$id'");
echo $row['data'];
}

// otherwise, load a file to display content
else {
  if ($page == 'map') {
    include 'map.php';
  }
}

include '../shared/footer.php';
?>
