<?php

include '../shared/header.php';

$result = mysql_query("SELECT * FROM pages WHERE id = '$id'");
echo mysql_result($result, 0, "data");

include '../shared/footer.php';
?>
