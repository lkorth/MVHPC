<?php

$title = "MVHPC :: Districts";
include'header.php';

$query = "SELECT * FROM pages WHERE id = '4'";
$result = mysql_query($query);
$data = mysql_result($result, 0, "data");
echo $data;

include'footer.php';
?>