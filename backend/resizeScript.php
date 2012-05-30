<?php

require_once '../includes/master.inc.php';

$names = scandir('../media');

foreach($names as $nm) {
    if ($nm != "." && $nm != "..") {
        if (strpos($nm, '_thumbnail') !== false || strpos($nm, '_mid') !== false || strpos($nm, '_medlg') !== false) {
            //do nothing
        } else {
            //read in full size and thumbnail to 224x224
            $info = pathinfo($nm);
            $file_name = basename($nm, '.' . $info['extension']); //file name with no extention
            $file_ext = $info['extension']; //outputs the file extension

            $full = "../media/" . $file_name . '.' . $file_ext;
            $file_ext = strtolower($file_ext);
            $filethumb = "../media/" . $file_name . "_thumbnail" . "." . $file_ext;

            list($width, $height) = getimagesize($filethumb);
			
			echo $width . ' ' . $height . '<br>';

            if (!isset($width) || !isset($height) || ($width != 210 && $height != 210)) {
                $gd = new GD($full);
                $gd->resize(210, 210);
                $gd->saveAs($filethumb, $file_ext, 100);
                $cnt++;
                echo "Resized: $cnt" . '<br>';
				unset($gd);
            }
            else {
                echo 'Already Done<br>';
            }
        }
    }
}
?>
