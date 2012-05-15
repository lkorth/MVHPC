<?php

$level = '../';
include '../shared/header.php';

$db = Database::getDatabase();
$row = $db->getRow("SELECT * FROM pages WHERE id = '$id'");
echo $row['data'];

include '../shared/footer.php';
?>
