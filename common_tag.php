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
            $title = "Enter Common Tags";
            $tag = 1;
            include 'header.php';
            ?>
<br />
<div align="center">
    <form action="specific_tag.php" method="post" enctype="multipart/form-data" id="nextpage">
        <p>Common Tags: MUST be seperated by a semicolon(;)</p><br /><textarea name="ctags" rows="10" cols="40"></textarea><br />
        <input type="submit" value="Next Page" /></form>
</div>
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