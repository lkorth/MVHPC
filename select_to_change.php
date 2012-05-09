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
            include 'header.php';
            ?>

<p>Enter only ONE of the following</p>
<table align="center">
    <form enctype="multipart/form-data" action="inbetween.php" method="GET"  autocomplete="off">
        <tr><td align ="left"><p>Enter Item Id:</p></td><td align="right"><input type="text" name="id" id="id" /></td></tr>
       <!-- <tr><td align ="left"><p>Or enter a file name:</p></td><td align="right"><input type="text" name="filename" id="file" /></td></tr> -->
        <tr><td align ="left"><p>Or enter a search term:</p></td><td align="right"><input type="text" name="search" id="change"/></td></tr>
        <tr><td></td><td align ="right"><input type="submit" value="Submit" /></td></tr>
    </form>
</table>
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