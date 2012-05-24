<?php

require_once '../includes/master.inc.php';

$cnt = 0;
$mydir = dir('../media');
while (($file = $mydir->read()) !== false && $cnt < 60) {
    if ($file != "." && $file != "..") {
        if (strpos($file, '_thumbnail') !== false || strpos($file, '_mid') !== false || strpos($file, '_medlg') !== false) {
            //do nothing
        } else {
            //read in full size and thumbnail to 224x224
            $info = pathinfo($file);
            $file_name = basename($file, '.' . $info['extension']); //file name with no extention
            $file_ext = $info['extension']; //outputs the file extension

            $full = "../media/" . $file_name . '.' . $file_ext;
            $file_ext = strtolower($file_ext);
            $filethumb = "../media/" . $file_name . "_thumbnail" . "." . $file_ext;

            list($width, $height) = getimagesize($filethumb);

            if ($width != 224 && $height != 224) {
                $gd = new GD($full);
                $gd->resize(224, 224);
                $gd->saveAs($filethumb, $file_ext, 100);
                $cnt++;
                echo 'Resized!<br>';
            }
            else {
                echo 'Already Done<br>';
            }
        }
    }
}
$mydir->close();
?>
