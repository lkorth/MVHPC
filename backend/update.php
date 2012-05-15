<?php
require_once '../includes/master.inc.php';

$id = $_POST['id'];
$updatedinfo = $_POST['info' . $id];
$updatedtags = $_POST['tags' . $id];
$updatedtags = strtolower($updatedtags);

$db = Database::getDatabase();
$row = $db->query("UPDATE search SET tags = '$updatedtags', information = '$updatedinfo' WHERE id = '$id'");

header("Location: select_to_change.php");

?>