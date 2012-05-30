<?php

require_once '../includes/master.inc.php';

$Auth->requireUser();

$id = $_GET['id'];
$tags = strtolower($_GET['tags']);
$info = $_GET['info'];
$live = $_GET['live'];

if($live == 'live')
    $live = 1;
else
    $live = 0;

$db = Database::getDatabase();
$row = $db->query("UPDATE search SET tags = '$tags' , information = '$info', live = '$live', edit = '0' WHERE id = '$id'");

header("Location: all-images.php?page=1");
?>