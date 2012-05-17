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
    $id = 9;
} else if ($page == 'text') {
    $title = "MVHPC :: Text";
    $id = 5;
} else if ($page == 'design-review') {
    $title = "MVHPC :: Design Review";
    $id = 7;
} else {
    redirect('../error/404.php');
}


$level = '../';
include '../shared/header.php';

$db = Database::getDatabase();
$row = $db->getRow("SELECT * FROM pages WHERE id = '$id'");
echo $row['data'];

include '../shared/footer.php';
?>
