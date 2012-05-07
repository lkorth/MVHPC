<?php
//Database credentials
include 'db.php';


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
            session_start();
            if($_SESSION['redirect'] == 1) {
                $id = $_SESSION['id'];
                session_destroy();
                header ("Location: change_tags.php?id=$id");
            }
            $title = "Manage Site";
            include 'header.php';
            ?>
<table align="center">
    <tr>
    <tr>
        <td>
    <tr><td><h3>Welcome<br />
				What would you like to do?</h3></td></tr>
    <tr><td><a href="upload_file.php">Upload Files</a></td></tr>
    <tr><td><a href="select_to_change.php">Change Tags</a></td></tr>
    <tr><td><a href="all.php?page=1">View and Edit all pictures</a></td></tr>
    <tr><td><a href="https://host394.hostmonster.com:2096">Check Email</a></td></tr>
    <tr><td><a href="logout.php">Logout</a></td></tr>
</td>
</tr>
</tr>
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