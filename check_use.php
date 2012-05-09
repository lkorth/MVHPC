<?php
require_once 'includes/master.inc.php';

$id = $_GET['id'];
$query="SELECT edit FROM search WHERE id = '$id'";
$result=mysql_query($query);
if(mysql_num_rows($result)==0){
echo 0;
}
else if(time() - 3600 < mysql_result($result,0,"edit") && mysql_result($result,0,"edit")!=0){
echo 0;
}
else {
$time = time();
$query="UPDATE search SET edit = '$time' WHERE id = '$id'";
$result=mysql_query($query);
mysql_close();
echo 1;
}
?>