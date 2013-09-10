<?php

require_once '../includes/master.inc.php';

$Auth->requireUser();

$id = $_GET['id'];
$updatedinfo = $_GET['info'];
$updatedtags = $_GET['tags'];
$updatedtags = strtolower($updatedtags);
$live = $_GET['live'];

if($live == 'live')
    $live = 1;
else
    $live = 0;

$db = Database::getDatabase();
$row = $db->query("UPDATE search SET tags = '$updatedtags', information = '$updatedinfo', live = '$live', edit = '0' WHERE id = '$id'");

header("Location: action.php");

?>