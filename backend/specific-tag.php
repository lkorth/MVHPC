<?php

include('../includes/master.inc.php');
include('../includes/class.template.php');

$Auth->requireUser();

$template = new Template();

$headerExtras['js'] = array('jquery-bgiframe-min.js',
                            'jquery-ajaxQueue.js',
                            'jquery-autocomplete.js',
                            'jquery-lightbox-05-min.js',
                            'jquery-spellchecker.js',
                            'jquery-tagsinput.js',
                            'all-images.js',
                            'common-tags.js',
                            'functions.js');
$headerExtras['css'] = array('jquery-lightbox-05.css', 'jquery-spellchecker.css', 'jquery-autocomplete.css', 'jquery-tagsinput.css');

$ctags = "mount vernon; " . $_POST['ctags'] . " ;";
ob_start();
?>
<?php
echo "<h2>Click the thumbnail to see a larger image</h2>";
echo "<table align=\"center\">";
$mydir = dir('../tmp');
echo "<form action=\"move-and-tag.php\" method=\"post\" enctype=\"multipart/form-data\">";
while (($file = $mydir->read()) !== false) {
    // Security - remove "." and ".." files (directories)
    if ($file != "." && $file != "..") {
        if (strpos($file, '_thumbnail') !== false || strpos($file, '_mid') !== false || strpos($file, '_medlg') !== false) {

        } else {
            $info = pathinfo($file);
            $file_name = basename($file, '.' . $info['extension']); //file name with no extention
            $file_ext = $info['extension']; //outputs the file extension
            $file = $file_name . "_thumbnail" . "." . $file_ext;
            $pictags = "Tags_" . $file_name;
            $picinfo = "Info_" . $file_name;
            echo "<tr><td><br><br><div style=\"width: 224px; height: 224px;\"><a id='thumb$file_name' href=\"" . WEB_ROOT . 'tmp/' . $file_name . "_mid.$file_ext\" rel=\"lightbox\"><img src='/mvhpc/tmp/$file'/></a></div>
                  <br><img onClick=\"rotate('../tmp/" . $file_name . '.' . $file_ext . "',90,'$file_name');\" src='" . WEB_ROOT . "images/rotate-cc.png'/>&nbsp;&nbsp;<img onClick=\"rotate('../tmp/" . $file_name . '.' . $file_ext . "',270,'$file_name');\" src='" . WEB_ROOT . "images/rotate-c.png'/></button>
                  </td><td align=\"right\"><p>Tags: MUST be seperated by a semicolon (;)</p><textarea id=\"tagArea\" name=\"$pictags\" rows=\"5\" cols=\"40\">$ctags</textarea></td></tr>
                  <tr><td></td><td align=\"right\"><p>Information:</p> <textarea name=\"$picinfo\" rows=\"5\" cols=\"40\"></textarea><br><input type=\"checkbox\" name=\"Live_$file_name\" value=\"live\" />Ready for viewing?</td></tr><tr><td><br><br></td></tr>";
        }
    }
}
$mydir->close();
echo "<tr><td></td><td><input class=\"button\" type=\"submit\" value=\"Submit\" /></form></td>";
echo "</table>";
?>
</div>
<?php
$SingleCol = ob_get_clean();
$template->setStyle('oneColumn');
$template->setTitle('Enter Specific Tags');
$template->setHeaderExtras($headerExtras);
$template->setSingleCol($SingleCol);

$template->output();
?>