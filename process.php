<?php
require_once 'includes/master.inc.php';

$data = $_POST['data'];
//$data =  mysql_real_escape_string($data);

session_start();
$id = $_SESSION['id'];
$name = $_SESSION['name'];
session_destroy();

$query = "UPDATE pages SET data = '$data' WHERE id = '$id'";
mysql_query($query);
mysql_close();
$name=$name . ".php";
header("Location: $name");
?>