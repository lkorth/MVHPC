<?php

require_once '../includes/master.inc.php';

function getFilename($origName){
    $arr = explode('.', $origName);
    $tmp = '';
    for($i = 0; $i < count($arr) - 1; $i++){
        $tmp = $tmp . $arr[$i];
    }
    return $tmp;
}

function getExtention($origName){
    return end(explode('.', $origName));
}

$angle = $_GET['angle'];
$id = $_GET['id'];

$db = Database::getDatabase();
$result = $db->query("select location, medlg, mid, thumbnail from search where id = '$id'"); //change db class to return list with result and row nums?

if($db->numRows($result) > 0){
    $image = mysql_fetch_assoc($result);
    
    $gdl = new GD('../' . $image['location']);
    $l = $gdl->rotate($angle, 0);
    
    $gdmlg = new GD('../' . $image['medlg']);
    $mlg = $gdmlg->rotate($angle, 0);
    
    $gdmd = new GD('../' . $image['mid']);
    $md = $gdmd->rotate($angle, 0);
    
    $gdtb = new GD('../' . $image['thumbnail']);
    $tb = $gdtb->rotate($angle, 0);
    
    if($l && $mlg && $md && $tb){
        $l = $gdl->saveAs('../' . getFilename($image['location']), getExtention($image['location']), 100);
        $mlg = $gdmlg->saveAs('../' . getFilename($image['medlg']), getExtention($image['medlg']), 100);
        $md = $gdmd->saveAs('../' . getFilename($image['mid']), getExtention($image['mid']), 100);
        $tb = $gdtb->saveAs('../' . getFilename($image['thumbnail']), getExtention($image['thumbnail']), 100);
        
        if($l && $mlg && $md && $tb)
            echo '1|';
        else
            echo '0|';
    }
}
else {
    echo '0|';
}
?>
