<?php

require_once '../includes/master.inc.php';

$Auth->requireUser();

if ($_GET['id'] != null) {
    //starts session to pass id
    session_start();
    $_SESSION['id'] = $_GET['id'];
    header("Location: change_tags.php");
} else if ($_GET['filename'] != null) {
    $filename = $_GET['filename'];
    
    $db = Database::getDatabase();
    $row = $db->getRow("SELECT id FROM search WHERE location LIKE '%$filename%'");

    session_start();
    $_SESSION['id'] = $row['id'];

    header("Location: change_tags.php");
} else if ($_GET['search'] != null) {
    $search = $_GET['search'];
    header("Location: search.php?page=1&terms=$search&changetags=1");
}
?>