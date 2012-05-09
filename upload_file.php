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
            $upload ="
<link rel=\"stylesheet\" type=\"text/css\" href=\"css/uploadstyle.css\" />
	<link rel=\"stylesheet\" href=\"css/screen.css\" type=\"text/css\" media=\"screen, projection\">
	<link rel=\"stylesheet\" href=\"css/print.css\" type=\"text/css\" media=\"print\">
	<!--[if IE]><link rel=\"stylesheet\" href=\"css/ie.css\" type=\"text/css\" media=\"screen, projection\"><![endif]-->
	";
            $title = "Upload Files";
            include 'header.php';
            ?>
<br />
<div align="center">
    <form action="upload.php" method="post" enctype="multipart/form-data" id="form-demo">

        <fieldset id="demo-fallback">
            <legend>File Upload</legend>
            <p>
			We were not able to load the multiple picture upload manager, please upload one picture at a time.
            </p>
            <label for="demo-photoupload">
			Upload a Photo:
                <input type="file" name="Filedata" />
            </label>
        </fieldset>

        <div id="demo-status" class="hide">
            <p>
                <a href="#" id="demo-browse">Browse Files</a> |
                <a href="#" id="demo-clear">Clear List</a> |
                <a href="#" id="demo-upload">Start Upload</a>
            </p>
            <div>
                <strong class="overall-title"></strong><br />
                <img src="assets/progress-bar/bar.gif" class="progress overall-progress" />
            </div>
            <div>
                <strong class="current-title"></strong><br />
                <img src="assets/progress-bar/bar.gif" class="progress current-progress" />
            </div>
            <div class="current-text">
            </div>
        </div>

        <ul id="demo-list"></ul>

    </form>
</div>
<div>
    <br />
</div>
<div>
    <br />
</div>
<div>
    <br />
</div>
<p align="center">Please browse and select all the files you wish to upload and click upload.<br />  After the upload has finished click on the next page button to tag the files.</p>
<div>
    <br />
</div>
<div align="center">
    <form action="common_tag.php" method="post" enctype="multipart/form-data" id="nextpage">
        <input type="submit" value="Next Page" />
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