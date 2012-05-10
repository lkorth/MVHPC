<?php

require_once 'includes/master.inc.php';

$Auth->requireUser();

if ($_GET['id'] != null) {
    //starts session to pass id
    session_start();
    $_SESSION['id'] = $_GET['id'];

    header("Location: change_tags.php");
} else if ($_GET['filename'] != null) {
    $filename = $_GET['filename'];
    $query = "SELECT id FROM search WHERE location LIKE '%$filename%'";
    $result = mysql_query($query);
    $id = mysql_result($result, 0, "id");
    session_start();
    $_SESSION['id'] = $id;

    header("Location: change_tags.php");
} else if ($_GET['search'] != null) {
    $search = $_GET['search'];
    header("Location: search.php?page=1&terms=$search&changetags=1");
}
?>