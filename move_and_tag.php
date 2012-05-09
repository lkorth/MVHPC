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
            $mydir = dir('./tmp');
            $startdir = "tmp/";
            $finaldir = "media/";
            while(($file = $mydir->read()) !== false) {
            // Security - remove "." and ".." files (directories)
                if ($file != "." && $file != "..") {
                    if (strpos($file, '_thumbnail') !== false || strpos($file, '_mid') !== false || strpos($file, '_medlg') !== false) {
                        $info = pathinfo($file);
                        $file_name =  basename($file,'.'.$info['extension']); //file name with no extention
                        $file_ext = $info['extension']; //outputs the file extension
                        rename(($startdir . $file_name . "." . $file_ext), ($finaldir . $file_name . "." . $file_ext));
                    }
                    else {
                        $info = pathinfo($file);
                        $file_name =  basename($file,'.'.$info['extension']); //file name with no extention
                        $file_ext = $info['extension']; //outputs the file extension
                        $location = "media/" . $file_name . "." . $file_ext;
                        $medlg = "media/" . $file_name . "_medlg" . "." . $file_ext;
                        $filethumb = "media/" . $file_name . "_thumbnail" . "." . $file_ext;
                        $mid = "media/" . $file_name . "_mid" . "." . $file_ext;
                        $t = "Tags_" . $file_name;
                        $i = "Info_" . $file_name;
                        $tags = strtolower($_POST[$t]);
                        $info = $_POST[$i];
                        $views = 0;
                        $trueviews = 0;

                        // now we insert it into the database
                        $insert = "INSERT INTO search (location, medlg, thumbnail, mid, information, tags, views, trueviews)
VALUES ('".$location."', '".$medlg."', '".$filethumb."','".$mid."', '".$info."', '".$tags."', '".$views."', '".$trueviews."')";
                        $add_member = mysql_query($insert);

                        rename(($startdir . $file_name . "." . $file_ext), ($finaldir . $file_name . "." . $file_ext));
                    }
                }
            }
            $mydir->close();
            header("Location: action.php");
        }
    }
}
else

//if the cookie does not exist, they are taken to the login screen
{
    header("Location: login.php");
}
?> 