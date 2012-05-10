<?php

$title = "MVHPC :: About Us :: Design Review";
$id = 7;
require 'header.php';
$query = "SELECT * FROM pages WHERE id = '$id'";
$result = mysql_query($query);
$data = mysql_result($result, 0, "data");
echo $data;

require 'footer.php';
?>