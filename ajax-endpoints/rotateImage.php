<?php

require_once '../includes/master.inc.php';

function getExtention($origName) {
    return '.' . end(explode('.', $origName));
}

$angle = $_GET['angle'];
$id = $_GET['id'];

if (strpos($id, '../', 0) === 0) {
    $pre = '';
    $ext = getExtention($id);
    $fileName = str_replace($ext, '', $id);

    $image['location'] = $id;
    $image['medlg'] = $fileName . '_medlg' . $ext;
    $image['mid'] = $fileName . '_mid' . $ext;
    $image['thumbnail'] = $fileName . '_thumbnail' . $ext;
} else {
    $db = Database::getDatabase();
    $result = $db->query("select location, medlg, mid, thumbnail from search where id = '$id'"); //change db class to return list with result and row nums?
    $image = mysql_fetch_assoc($result);
    $pre = '../';
    $ext = getExtention($image['location']);
}

$gdl = new GD($pre . $image['location']);
$l = $gdl->rotate($angle, 0);

$gdmlg = new GD($pre . $image['medlg']);
$mlg = $gdmlg->rotate($angle, 0);

$gdmd = new GD($pre . $image['mid']);
$md = $gdmd->rotate($angle, 0);

$gdtb = new GD($pre . $image['thumbnail']);
$tb = $gdtb->rotate($angle, 0);

if ($l && $mlg && $md && $tb) {
    $l = $gdl->saveAs($pre . $image['location'], substr($ext, 1), 100);
    $mlg = $gdmlg->saveAs($pre . $image['medlg'], substr($ext, 1), 100);
    $md = $gdmd->saveAs($pre . $image['mid'], substr($ext, 1), 100);
    $tb = $gdtb->saveAs($pre . $image['thumbnail'], substr($ext, 1), 100);

    if ($l && $mlg && $md && $tb)
        echo '1|' . str_replace('../', '/', $image['thumbnail']);
    else
        echo '0|' . str_replace('../', '/', $image['thumbnail']);
}
?>
