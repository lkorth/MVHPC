<?php

$title = "Mount Vernon Historic Preservation Commision";
$id = 1;
$level = '';
include 'shared/header.php';
?>

<?php

$result = mysql_query("SELECT * FROM pages WHERE id = '$id'");
echo mysql_result($result, 0, "data");

include 'shared/footer.php';
?>