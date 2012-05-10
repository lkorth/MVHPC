<?php

require_once 'includes/master.inc.php';

$Auth->requireUser();

$id = $_GET['id'];
$tags = strtolower($_GET['tags']);
$info = $_GET['info'];
$query = "UPDATE search SET tags = '" . $tags . "' , information = '" . $info . "', edit = '0' WHERE id = $id";
$result = mysql_query($query);
mysql_close();

header("Location: all.php?page=1");
?> 