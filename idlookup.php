<?php
//Database credentials
include 'db.php';

$q = strtolower($_GET["q"]);
$q =  mysql_real_escape_string($q);

if (!$q) return;
$query = "SELECT id MATCH(id) AGAINST('$q') AS score FROM search WHERE MATCH(id) AGAINST('$q') ORDER BY score DESC, views DESC"; 
$result=mysql_query($query);
if($result!=false) {
    $num=mysql_numrows($result);
}
else if($result == false) {
        $query="";
        $result="";
        $query="SELECT id FROM search WHERE id LIKE '%$q%' ORDER BY views DESC";
        $result=mysql_query($query);
        $num=mysql_numrows($result);
    }
$i=0;
while ($i < $num) {
    if ($i == 0) {
        $tags = mysql_result($result,$i,"id");
    }
    else {
        $tags=$tags . ";" . mysql_result($result,$i,"id");
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