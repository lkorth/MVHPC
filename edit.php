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
            $title = "Edit";

            $id = $_GET['id'];
            $query="SELECT * FROM pages WHERE id = '$id'";
            $result=mysql_query($query);
            $data=mysql_result($result,0,"data");
            $name=mysql_result($result,0,"name");

            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;

            include 'header.php';
            ?>
<div>
    <form method="post" action="process.php">
        <p>
            <textarea name="data" style="width: 100%"><?php echo $data; ?></textarea>
        </p>
    </form>
</div>
            <?php
            include 'footer.php';
        }
    }
}
else

//if the cookie does not exist, they are taken to the login screen
{
    header("Location: login.php");
}
?> 