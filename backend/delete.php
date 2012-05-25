<?php

require_once '../includes/master.inc.php';

$Auth->requireUser();

$id = $_GET['id'];

$db = Database::getDatabase();
$result = $db->query("DELETE FROM search WHERE id = '$id'");

if($result)
    header("Location: action.php?message=Image+was+successfully+deleted");
else
    header("Location: action.php?message=There+was+an+error+deleting+the+image");

?>