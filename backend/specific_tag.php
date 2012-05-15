<?php
require_once '../includes/master.inc.php';

$Auth->requireUser();

$ctags = "mount vernon ; " . $_POST['ctags'] . " ;";
$title = "Enter Specific Tags";
$tag = 1;
$level = '../';
include '../shared/header.php';
echo "<br>";
echo "<table align=\"center\">";
$mydir = dir('./tmp');
echo "<form action=\"move_and_tag.php\" method=\"post\" enctype=\"multipart/form-data\">";
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
            echo "<tr><td><br><br><img src='tmp/$file'/></td><td align=\"right\"><p>Tags: MUST be seperated by a semicolon (;)</p><textarea name=\"$pictags\" rows=\"5\" cols=\"40\">$ctags</textarea></td></tr>
	<tr><td></td><td align=\"right\"><p>Information:</p> <textarea name=\"$picinfo\" rows=\"5\" cols=\"40\"></textarea></td></tr><tr><td><br><br></td></tr>";
        }
    }
}
$mydir->close();
echo "<tr><td></td><td><input type=\"submit\" value=\"Submit\" /></form></td>";
echo "</table>";
?>
</div>
<br>
<div id="footer">
    <p><a href="<?php WEBROOT() ?>backend/login.php">Manage site</a><br> <!-- Use auth to get login url? -->
</div>
</div>
</div>
</body>
</html>