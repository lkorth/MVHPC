<?php

require_once '../includes/master.inc.php';

$Auth->requireUser();

$id = $_POST['id'];
$updatedinfo = $_POST['info' . $id];
$updatedtags = $_POST['tags' . $id];
$updatedtags = strtolower($updatedtags);
$live = $_POST['live_' . $id];

if($live == 'live')
    $live = 1;
else
    $live = 0;

$db = Database::getDatabase();
$row = $db->query("UPDATE search SET tags = '$updatedtags', information = '$updatedinfo', live = '$live' WHERE id = '$id'");

header("Location: select-to-change-tags.php");

?>