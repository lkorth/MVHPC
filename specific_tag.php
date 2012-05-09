<?php
require_once 'includes/master.inc.php';

//checks cookies to make sure they are logged in
if(isset($_COOKIE['ID_my_site'])) {
    $username = $_COOKIE['ID_my_site'];
    $pass = $_COOKIE['Key_my_site'];
    $check = mysql_query("SELECT * FROM users WHERE username = '$username'")or die(mysql_error());
    while($info = mysql_fetch_array( $check )) {

    //if the cookie has the wrong password, they are taken to the login page
        if ($pass != $info['password']) { header("Location: login.php");
        }

        //otherwise they are shown the admin area
        else {
            $ctags = "mount vernon ; " . $_POST['ctags'] . " ;";
            $title = "Enter Specific Tags";
            $tag = 1;
            include 'header.php';
            echo "<br />";
            echo "<table align=\"center\">";
            $mydir = dir('./tmp');
            echo "<form action=\"move_and_tag.php\" method=\"post\" enctype=\"multipart/form-data\">";
            while(($file = $mydir->read()) !== false) {
            // Security - remove "." and ".." files (directories)
                if ($file != "." && $file != "..") {
                    if (strpos($file, '_thumbnail') !== false || strpos($file, '_mid') !== false || strpos($file, '_medlg') !== false) {}
                    else {
                        $info = pathinfo($file);
                        $file_name =  basename($file,'.'.$info['extension']); //file name with no extention
                        $file_ext = $info['extension']; //outputs the file extension
                        $file = $file_name . "_thumbnail" . "." . $file_ext;
                        $pictags = "Tags_" . $file_name;
                        $picinfo = "Info_" . $file_name;
                        echo "<tr><td><br /><br /><img src='tmp/$file'/></td><td align=\"right\"><p>Tags: MUST be seperated by a semicolon (;)</p><textarea name=\"$pictags\" rows=\"5\" cols=\"40\">$ctags</textarea></td></tr>
	<tr><td></td><td align=\"right\"><p>Information:</p> <textarea name=\"$picinfo\" rows=\"5\" cols=\"40\"></textarea></td></tr><tr><td><br /><br /></td></tr>";
                    }
                }
            }
            $mydir->close();
            echo "<tr><td></td><td><input type=\"submit\" value=\"Submit\" /></form></td>";
            echo "</table>";
            ?>
</div>
<br />
<div id="footer">
    <p><a href="login.php">Manage site</a><br />
</div>
</div>
</div>
</body>
</html>
        <?php
        }
    }
}
else

//if the cookie does not exist, they are taken to the login screen
{
    header("Location: login.php");
}
?> 