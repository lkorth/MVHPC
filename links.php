<?php

$title = "MVHPC :: About Us :: Links";
$id = 9;
require 'header.php';
$query = "SELECT * FROM pages WHERE id = '$id'";
$result = mysql_query($query);
$data = mysql_result($result, 0, "data");
echo $data;

require 'footer.php';
?>