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
        if ($pass != $info['password']) {
            header ("Location: login.php");
        }
        //otherwise they are shown the admin area
        else {
			$id = $_GET['id'];
			$query="DELETE FROM search WHERE id = '$id'";
			$result=mysql_query($query);

			header ("Location: select_to_change.php");
}
}
}
else

//if the cookie does not exist, they are taken to the login screen
{
    header("Location: login.php");
}
?> 