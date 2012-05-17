<?php

$level = '../';
include '../shared/header.php';

$title = "MVHPC.org";
$zoom = 1;
$id = $_GET['id'];

$db = Database::getDatabase();
$row = $db->getRow("SELECT * FROM search WHERE id = '$id'");

$location = $row['location'];
$medlg = $row['medlg'];
$mid = $row['mid'];

$trueviews = $row['trueviews'] + 1;
$views = $row['views'] + 0.05;
$db->query("UPDATE search SET views = '$views', trueviews = '$trueviews' WHERE id = '$id'");

include '../shared/header.php';
echo "<br>";
echo "<a href=\"$medlg\" class=\"MagicZoom\" rel=\"click-to-initialize:true;zoom-position:inner;zoom-fade:true;\"><img src=\"$mid\"/></a>";
echo "<p>Click the picture to turn on zooming</p>";
echo "<br><br>";
echo '<p>' . $row['information'] . '</p>';
echo "<br><br>";
echo "<a href=\"$location\">Click here for full resolution picture (Warning some pictures are VERY large)</a><br>";
echo "<a href=\"feedback.php?id=$id\">Click here to request tag update</a>";
include '../shared/footer.php';
?>