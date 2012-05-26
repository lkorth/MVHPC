<?php

require_once '../includes/master.inc.php';

$id = $_GET['id'];

$db = Database::getDatabase();
$result = $db->query("SELECT edit FROM search WHERE id = '$id'");

if ($db->numRows($result) == 0) {
    echo 0;
} else if ((mysql_result($result, 0, "edit") != 0) && (time() - 3600 < mysql_result($result, 0, "edit"))) {
    echo 0;
} else {
    $time = time();
    $db->query("UPDATE search SET edit = '$time' WHERE id = '$id'");
    if ($db->affectedRows())
        echo 1;
    else
        echo 0;
}
?>