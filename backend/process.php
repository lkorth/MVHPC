<?php
require_once '../includes/master.inc.php';

$data = $_POST['data'];
//$data =  mysql_real_escape_string($data);

session_start();
$id = $_SESSION['id'];
$name = $_SESSION['name'];
session_destroy();

$db = Database::getDatabase();
$row = $db->getRow("UPDATE pages SET data = '$data' WHERE id = '$id'");

$name=$name . ".php";
header("Location: $name");
?>