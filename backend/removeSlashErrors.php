<?php

require '../includes/master.inc.php';

$db = Database::getDatabase();
$result = $db->getRows("SELECT * FROM search where tags like '%\\'%' or tags like '%\"%' or information like '%\\'%' or information like '%\"%';");
pr($result);

/*
$result = $db->getRows("SELECT * FROM search where 1=1");

foreach($result as $r){
    $tags = str_replace("\'", "'", $r['tags']);
    $tags = str_replace("\"", '"', $tags);

    $info = str_replace("\'", "'", $r['information']);
    $info = str_replace("\"", '"', $info);

    $id = $r['id'];

    $db->query("update search set tags=:t:, information=:i: where id = '$id';", array('t' => $tags, 'i' => $info));
}
*/
?>
