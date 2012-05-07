<?php
//Database credentials
include 'db.php';

$title="MVHPC.org";
$zoom = 1;
$id = $_GET['id'];

$query="SELECT * FROM search WHERE id = '$id'";
$result=mysql_query($query);

$location=mysql_result($result,0,"location");
$medlg=mysql_result($result,0,"medlg");
$mid=mysql_result($result,0,"mid");
$information=mysql_result($result,0,"information");
$views=mysql_result($result,0,"views");
$trueviews=mysql_result($result,0,"trueviews");

$trueviews = $trueviews + 1;
$views = $views + 0.05;
$query = "UPDATE search SET views = '$views', trueviews = '$trueviews' WHERE id = '$id'";
mysql_query($query);
mysql_close();
list($width, $height) = getimagesize("$mid");
$width = $width . "px";
$height = $height . "px";
include 'header.php';
echo "<br />";
echo "<a href=\"$medlg\" class=\"MagicZoom\" rel=\"click-to-initialize:true;zoom-position:inner;zoom-fade:true;\"><img src=\"$mid\"/></a>";
echo "<p>Click the picture to turn on zooming</p>";
echo "<br /><br />";
echo "<p>$information</p>";
echo "<br /><br />";
echo "<a href=\"$location\">Click here for full resolution picture (Warning some pictures are VERY large)</a><br />";
echo "<a href=\"feedback.php?id=$id\">Click here to request tag update</a>";
include 'footer.php';
?>