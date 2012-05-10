<?php

$title = "MVHPC :: History";
include'header.php';

$query = "SELECT * FROM pages WHERE id = '2'";
$result = mysql_query($query);
$data = mysql_result($result, 0, "data");
echo $data;

include'footer.php';
?>