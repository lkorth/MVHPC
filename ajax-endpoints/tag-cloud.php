<?php
require_once '../includes/master.inc.php';

$db = Database::getDatabase();
$result = $db->getRows("select tags from search where 1=1");

$tags = array();

foreach($result as $row){
    $tmp = explode(';', $row['tags']);
    foreach($tmp as $tg){
        $tg = trim($tg);
        if(isset($tags[$tg]))
            $tags[$tg]++;
        else
            $tags[$tg] = 1;
    }
}

asort($tags);

$tags = array_slice($tags, count($tags) - 100, count($tags));

$output = array();

foreach($tags as $key => $value){
    if($key !== '' && $value > 5 && strlen($key) <= 15 && $key != 'mount vernon' && $key != 'needstobetagged' && $key != 'new')
        $output[] = array('tag' => $key, 'count' => $value);
}

$output = array_slice($output, count($output) - 25, count($output));

shuffle($output);

echo json_encode($output);

?>
