<?php

require_once '../includes/master.inc.php';

$Auth->requireUser();

$mydir = dir('../tmp');
$startdir = "../tmp/";
$finaldir = "../media/";
while (($file = $mydir->read()) !== false) {
    // Security - remove "." and ".." files (directories)
    if ($file != "." && $file != "..") {
        if (strpos($file, '_thumbnail') !== false || strpos($file, '_mid') !== false || strpos($file, '_medlg') !== false) {
            $info = pathinfo($file);
            $file_name = basename($file, '.' . $info['extension']); //file name with no extention
            $file_ext = $info['extension']; //outputs the file extension
            rename(($startdir . $file_name . "." . $file_ext), ($finaldir . $file_name . "." . $file_ext));
        } else {
            $info = pathinfo($file);
            $file_name = basename($file, '.' . $info['extension']); //file name with no extention
            $file_ext = $info['extension']; //outputs the file extension
            $location = "media/" . $file_name . "." . $file_ext;
            $medlg = "media/" . $file_name . "_medlg" . "." . $file_ext;
            $filethumb = "media/" . $file_name . "_thumbnail" . "." . $file_ext;
            $mid = "media/" . $file_name . "_mid" . "." . $file_ext;
            $t = "Tags_" . $file_name;
            $i = "Info_" . $file_name;
            $l = "Live_" . $file_name;
            $l = $_POST[$l];
            if($l == 'live')
                $l = 1;
            else
                $l = 0;
            $tags = strtolower($_POST[$t]);
            $info = $_POST[$i];
            $views = 0;
            $trueviews = 0;

            $db = Database::getDatabase();
            $row = $db->query("INSERT INTO search (location, medlg, thumbnail, mid, information, tags, views, trueviews, live)
VALUES ('$location', '$medlg', '$filethumb','$mid', '$info', '$tags', '$views', '$trueviews', '$l')");

            rename(($startdir . $file_name . "." . $file_ext), ($finaldir . $file_name . "." . $file_ext));
        }
    }
}
$mydir->close();
header("Location: action.php");
?>