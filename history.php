<?php
//Database credentials
include 'db.php';

$title = "MVHPC :: History";
include'header.php';

$query="SELECT * FROM pages WHERE id = '2'";
$result=mysql_query($query);
$data=mysql_result($result,0,"data");
echo $data;

//checks cookies to make sure they are logged in
if(isset($_COOKIE['ID_my_site'])) {
    $username = $_COOKIE['ID_my_site'];
    $pass = $_COOKIE['Key_my_site'];
    $check = mysql_query("SELECT * FROM users WHERE username = '$username'")or die(mysql_error());
    while($info = mysql_fetch_array( $check )) {

    //if the cookie has the wrong password, do nothing
        if ($pass != $info['password']) {
            include 'footer.php';
        }
        //otherwise they are shown the admin area
        else {
            $id = 2;
            include 'edit_page.php';
        }
    }
}
else

//if the cookie does not exist do nothing
{
    include'footer.php';
}

?>