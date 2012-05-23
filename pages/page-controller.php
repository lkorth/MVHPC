<?php

require_once '../includes/master.inc.php';

if (!isset($_GET['page']))
    redirect('../error/404.php');

$page = $_GET['page'];

if ($page == 'map') {
    if (isset($_GET['subpage']) && !empty($_GET['subpage'])) {
        $subpage = $_GET['subpage'];

        if ($subpage == 'ash-park-district') {

        } else if ($subpage == 'commercial-district') {

        } else if ($subpage == 'cornell-district') {

        }
        else
            redirect('../error/404.php');
    }
    else {
        $title = "MVHPC :: Map of Mount Vernon";
        $id = 0;
        // Old district info
        // $title = "MVHPC :: Districts";
        // $id = 4;
    }
} else if ($page == 'archives') {
    if (isset($_GET['subpage']) && !empty($_GET['subpage'])) {
        $subpage = $_GET['subpage'];

        if ($subpage == 'documents') {
            $title = "MVHPC :: Documents";
            $id = 5;
        } else if ($subpage == 'images') {
            $title = "MVHPC :: Images";
            $id = 6;
        }
        else
            redirect('../error/404.php');
    }
    else {
        $title = "MVHPC :: Archives";
        $id = 2;
    }
} else if ($page == 'about-us') {
    if (isset($_GET['subpage']) && !empty($_GET['subpage'])) {
        $subpage = $_GET['subpage'];

        if ($subpage == 'links') {
            $title = "MVHPC :: Links";
            $id = 8;
        } else if ($subpage == 'design-review') {
            $title = "MVHPC :: Design Review";
            $id = 7;
        }
        else
            redirect('../error/404.php');
    }
    else {
        $title = "MVHPC :: About Us";
        $id = 3;
    }
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
