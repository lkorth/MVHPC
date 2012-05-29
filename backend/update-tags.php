<?php

require_once '../includes/master.inc.php';

$Auth->requireUser();

$id = $_GET['id'];
$tags = strtolower($_GET['tags']);
$info = $_GET['info'];

$db = Database::getDatabase();
$row = $db->query("UPDATE search SET tags = '$tags' , information = '$info', edit = '0' WHERE id = '$id'");

header("Location: all-images.php?page=1");
?>