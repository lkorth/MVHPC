<?php

require_once '../includes/master.inc.php';

$Auth->requireUser();

$id = $_GET['id'];

$db = Database::getDatabase();
$db->query("DELETE FROM search WHERE id = '$id'");

header("Location: select_to_change.php");
?> 