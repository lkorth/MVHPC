<?php

$title = "MVHPC :: About Us";
include'header.php';

$query = "SELECT * FROM pages WHERE id = '3'";
$result = mysql_query($query);
$data = mysql_result($result, 0, "data");
echo $data;

include'footer.php';
?>