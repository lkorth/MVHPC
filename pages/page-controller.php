<?php

require_once '../includes/master.inc.php';

if (!isset($_GET['page']))
  redirect('../error/404.php');

// get current page
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

if ($page == 'map') {
  if ($subpage == NULL) {
      $title = 'MVHPC :: Map of Mount Vernon';
      $id = 0;

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
  } else {
      redirect('../error/404.php');
  }

} else {
    redirect('error/404.php');
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

  } else if ($page == 'archives' && $subpage == 'documents') {
      $pdfFile = $subpage2;
      include 'documents.php';

  } else if ($page == 'about-us' && $subpage == 'design-review') {
    $pdfFile = $subpage2;
    include 'design-review.php';
  }
}

include '../shared/footer.php';

?>
