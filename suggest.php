<?php
//Database credentials
include 'db.php';

$q = strtolower($_GET["q"]);
if (!$q) return;
$query = "SELECT tags MATCH(tags) AGAINST('$q') AS score FROM search WHERE MATCH(tags) AGAINST('$q') ORDER BY score DESC, views DESC"; 
$result=mysql_query($query);
if($result!=false) {
    $num=mysql_numrows($result);
}
else if($result == false) {
        $query="";
        $result="";
        $query="SELECT tags FROM search WHERE tags LIKE '%$q%' ORDER BY views DESC";
        $result=mysql_query($query);
        $num=mysql_numrows($result);
    }
$i=0;
while ($i < $num) {
    if ($i == 0) {
        $tags = mysql_result($result,$i,"tags");
    }
    else {
        $tags=$tags . ";" . mysql_result($result,$i,"tags");
    }
    $i++;
}
mysql_close();
$split = explode(";", $tags);
$final = array();
foreach ($split as $str) {
	$str = trim($str);
	$final[] = $str;
}
$final = array_unique($final, SORT_STRING);


$stop = 0;
foreach ($final as $value) {
    if($stop < 8) {
        if (strpos($value, $q) !== false){
            echo "$value\n";
            $stop++;
        }
    }
}
?>