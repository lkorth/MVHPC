<?php
require_once 'includes/master.inc.php';

$result = array();
$ok=1;
$target = "tmp/";
$num = rand(1, 1000);
$target = $target . $num . "_" . basename( $_FILES['Filedata']['name']) ;


//This is our size condition
if ($_FILES['Filedata']['size'] > 350000000) {
    echo "<br />This file is too large. All files must be less than 350mb.<br>";
    echo "<br />Sorry your file was not uploaded because it is too large";
    $ok=0;
}


//If everything is ok we try to upload it
if($ok != 0) {
    if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $target)) {
    //Start the mid size and medlg generation
        list($width, $height) = getimagesize("$target");
        $ratio = $height / $width;
        $n_width=762; // Fix the width of the mid size images
        $n_height=(762*$ratio); //height is based off ratio to keep same proportions
		$medlg_width=1500; //Fix the width of the medlg size images
		$medlg_height=(1500*$ratio);  //height is based off ration to keep same proportions
		

        // your file
        $file = $_FILES['Filedata']['name'];
        $info = pathinfo($file);
        $file_name =  basename($file,'.'.$info['extension']); // outputs file name with no extension
        $pathfile = pathinfo($target);
        $file_ext = $info['extension']; //outputs the file extension
        //sets path and name for mid size
        $midsrc = "tmp/";
        $midsrc = $midsrc . $num . "_" . $file_name . "_mid" . "." . $file_ext;
		$medsrc = "tmp/";
		$medsrc = $medsrc . $num . "_" . $file_name . "_medlg" . "." . $file_ext;
        if($file_ext == 'pdf') {}
        else if (!($file_ext == 'jpg' || $file_ext == 'jpeg' || $file_ext == 'JPG' || $file_ext == 'JPEG' || $file_ext == 'gif' || $file_ext == 'GIF')) {
                echo "<br />Only jpg, jpeg or gif images are allowed<br />";
            }
            else {
			//medlg image creation
            if ($file_ext == 'gif' || $file_ext == 'GIF') {
                    $im=ImageCreateFromGIF($target);
                    $width=ImageSx($im); // Original picture width is stored
                    $height=ImageSy($im); // Original picture height is stored
                    $newimage=imagecreatetruecolor($medlg_width,$medlg_height);
                    imageCopyResized($newimage,$im,0,0,0,0,$medlg_width,$medlg_height,$width,$height);
                    if (function_exists("imagegif")) {
                        ImageGIF($newimage,$medsrc);
                    }

                    elseif (function_exists("imagejpeg")) {
                        ImageJPEG($newimage,$medsrc);
                    }
                }//end of gif file medlg size creation


                //starting of JPG medlg size creation
                if($file_ext == 'jpg' || $file_ext == 'jpeg' || $file_ext == 'JPG' || $file_ext == 'JPEG') {
                    $im=ImageCreateFromJPEG($target);
                    $width=ImageSx($im); // Original picture width is stored
                    $height=ImageSy($im); // Original picture height is stored
                    $newimage=imagecreatetruecolor($medlg_width,$medlg_height);
                    imageCopyResized($newimage,$im,0,0,0,0,$medlg_width,$medlg_height,$width,$height);
                    ImageJpeg($newimage,$medsrc);
            }//End of JPG mid size creation
			
			
			//Starting of GIF mid size creation
                if ($file_ext == 'gif' || $file_ext == 'GIF') {
                    $im=ImageCreateFromGIF($target);
                    $width=ImageSx($im); // Original picture width is stored
                    $height=ImageSy($im); // Original picture height is stored
                    $newimage=imagecreatetruecolor($n_width,$n_height);
                    imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
                    if (function_exists("imagegif")) {
                        ImageGIF($newimage,$midsrc);
                    }

                    elseif (function_exists("imagejpeg")) {
                        ImageJPEG($newimage,$midsrc);
                    }
                }//end of gif file mid size creation


                //starting of JPG mid size creation
                if($file_ext == 'jpg' || $file_ext == 'jpeg'  || $file_ext == 'JPG' || $file_ext == 'JPEG') {
                    $im=ImageCreateFromJPEG($target);
                    $width=ImageSx($im); // Original picture width is stored
                    $height=ImageSy($im); // Original picture height is stored
                    $newimage=imagecreatetruecolor($n_width,$n_height);
                    imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
                    ImageJpeg($newimage,$midsrc);
            }//End of JPG mid size creation
            

        //Start the thumbnail generation
        $n_width=144; // Fix the width of the thumb nail images

        $n_height=144; // Fix the height of the thumb nail image



        // your file
        $file = $_FILES['Filedata']['name'];
        $info = pathinfo($file);
        $file_name =  basename($file,'.'.$info['extension']); // outputs file name with no extension
        $pathfile = pathinfo($target);
        $file_ext = $info['extension']; //outputs the file extension


        //sets path and name for thumbnail
        $tsrc = "tmp/";
        $tsrc = $tsrc . $num . "_" . $file_name . "_thumbnail" . "." . $file_ext;
        //Starting of GIF thumb nail creation
        if ($file_ext == 'gif' || $file_ext == 'gif') {
            $im=ImageCreateFromGIF($target);
            $width=ImageSx($im); // Original picture width is stored
            $height=ImageSy($im); // Original picture height is stored
            $newimage=imagecreatetruecolor($n_width,$n_height);
            imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
            if (function_exists("imagegif")) {
                ImageGIF($newimage,$tsrc);
            }
            elseif (function_exists("imagejpeg")) {
                ImageJPEG($newimage,$tsrc);
            }
        }//end of gif file thumb nail creation


        //starting of JPG thumb nail creation
        if($file_ext == 'jpg' || $file_ext == 'jpeg'  || $file_ext == 'JPG' || $file_ext == 'JPEG') {
            $im=ImageCreateFromJPEG($target);
            $width=ImageSx($im); // Original picture width is stored
            $height=ImageSy($im); // Original picture height is stored
            $newimage=imagecreatetruecolor($n_width,$n_height);
            imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
            ImageJpeg($newimage,$tsrc);
        }//End of JPG thumb nail creation
}

        $return = array(
            'status' => '1',
            'name' => $target
        );


        // ... and if available, we get image data
        $info = @getimagesize($target);


        if ($info) {
            $return['width'] = $info[0];
            $return['height'] = $info[1];
            $return['mime'] = $info['mime'];
        }

        if (isset($_REQUEST['response']) && $_REQUEST['response'] == 'xml') {
        // header('Content-type: text/xml');
        // Really dirty, use DOM and CDATA section!
            echo '<response>';
            foreach ($return as $key => $value) {
                echo "<$key><![CDATA[$value]]></$key>";
            }
            echo '</response>';
        } else {
        // header('Content-type: application/json');
           echo json_encode($return);
        }
    }

    else {
    //error message
        echo "<br />Sorry, there was a problem uploading your file.<br />";
    }
}
?> 