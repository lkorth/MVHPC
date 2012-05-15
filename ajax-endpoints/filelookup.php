<?php
require_once '../includes/master.inc.php';

$q = strtolower($_GET["q"]);
$q =  mysql_real_escape_string($q);
if (!$q) return;
$query = "SELECT location MATCH(location) AGAINST('$q') AS score FROM search WHERE MATCH(location) AGAINST('$q') ORDER BY score DESC, views DESC"; 
$result=mysql_query($query);
if($result!=false) {
    $num=mysql_numrows($result);
}
else if($result == false) {
        $query="";
        $result="";
        $query="SELECT location FROM search WHERE location LIKE '%$q%' ORDER BY views DESC";
        $result=mysql_query($query);
        $num=mysql_numrows($result);
    }
$i=0;
while ($i < $num) {
    if ($i == 0) {
        $tags = mysql_result($result,$i,"location");
    }
    else {
        $tags=$tags . ";" . mysql_result($result,$i,"location");
    }
    $i++;
}
mysql_close();
$inital = explode(";", $tags);
$split = array_unique($inital, SORT_STRING);


$stop = 0;
foreach ($split as $value) {
    if($stop < 8) {
        if (strpos($value, $q) !== false) {
            echo "$value\n";
            $stop++;
        }
    }
}
?>