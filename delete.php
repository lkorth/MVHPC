<?php

require_once 'includes/master.inc.php';

$Auth->requireUser();

$id = $_GET['id'];
$query = "DELETE FROM search WHERE id = '$id'";
$result = mysql_query($query);

header("Location: select_to_change.php");
?> 