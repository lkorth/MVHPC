<?php

require_once '../includes/master.inc.php';

$allowedFileTypes = array('jpg', 'jpeg', 'gif', 'png');

$num = time();
$file = $_FILES['Filedata']['name'];
$fileInfo = pathinfo($file);
$fileNameNoExtention = basename($file, '.' . $fileInfo['extension']);
$fileExtention = strtolower($fileInfo['extension']);

$fullsize = 'tmp/' . $num . "_" . $fileNameNoExtention . '.' . $fileExtention;

if ($_FILES['Filedata']['size'] > 30000000) {
    echo "<br>This file is too large. All files must be less than 30mb.<br>";
    echo "<br>Sorry your file was not uploaded because it is too large";
} else if (!in_array($fileExtention, $allowedFileTypes)) {
    echo "<br>Only jpg, jpeg, gif and png images are allowed<br>";
} else {
    if (move_uploaded_file($_FILES['Filedata']['tmp_name'], $fullsize)) {
        $mid = 'tmp/' . $num . "_" . $fileNameNoExtention . "_mid" . "." . $fileExtention;
        $medlg = 'tmp/' . $num . "_" . $fileNameNoExtention . "_medlg" . "." . $fileExtention;
        $thumb = 'tmp/' . $num . "_" . $fileNameNoExtention . "_thumbnail" . "." . $fileExtention;

        $gd = new GD($fullsize);
        if ($gd &&
                $gd->scale(1500) &&
                $gd->saveAs($medlg, $fileExtention, 100) &&
                $gd->scale(762) &&
                $gd->saveAs($mid, $fileExtention, 100) &&
                $gd->resize(224, 224) &&
                $gd->saveAs($thumb, $fileExtention, 100)) {
            $return = array(
                'status' => '1',
                'name' => $fullsize
            );
            // if available, we add image data
            $info = @getimagesize($fullsize);
            if ($info) {
                $return['width'] = $info[0];
                $return['height'] = $info[1];
                $return['mime'] = $info['mime'];
            }

            header('Content-type: application/json');
            echo json_encode($return);
        } else {
            $dir = 'tmp/';
            $prefix = $num . "_" . $fileNameNoExtention;
            chdir($dir);
            $matches = glob($prefix . '*', GLOB_MARK);
            if (is_array($matches) && !empty($matches)) {
                foreach ($matches as $match) {
                    if (is_file($dir . $match))
                        unlink($dir . $match);
                }
            }

            echo "<br>Sorry, there was a problem resizing your picture.<br>";
        }
    } else {
        echo "<br>Sorry, there was a problem uploading your file.<br>";
    }
}
?> 