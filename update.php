<?php
//Database credentials
include 'db.php';

$id = $_POST['id'];
$updatedinfo = $_POST['info' . $id];
$updatedtags = $_POST['tags' . $id];
$updatedtags = strtolower($updatedtags);


$query = "UPDATE search SET tags = '$updatedtags', information = '$updatedinfo' WHERE id = '$id'";
mysql_query($query);

mysql_close();

header("Location: select_to_change.php");

?>