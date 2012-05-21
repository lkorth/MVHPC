<?php
require_once '../includes/master.inc.php';

$db = Database::getDatabase();
$result = $db->getRows("select tags from search where 1=1");

$tags = array();

foreach($result as $row){
    $tmp = explode(';', $row['tags']);
    foreach($tmp as $tg){
        if(isset($tags[$tg]))
            $tags[$tg]++;
        else
            $tags[$tg] = 1;
    }
}

echo json_encode($tags);

?>
