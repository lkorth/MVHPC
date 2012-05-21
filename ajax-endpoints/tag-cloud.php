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

$output = array();

foreach($tags as $key => $value){
    if($key !== '' && $value > 5 && strlen($key) <= 15 && $key != "mount vernon")
        $output[] = array('tag' => $key, 'count' => $value);
}

echo json_encode($output, true);

?>
