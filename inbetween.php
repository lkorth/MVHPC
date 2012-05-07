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
            if($_GET['id'] != null) {
            //starts session to pass id
                session_start();
                $_SESSION['id'] = $_GET['id'];

                header("Location: change_tags.php");
            }
            else if($_GET['filename'] != null) {
                   $filename = $_GET['filename'];
                   $query="SELECT id FROM search WHERE location LIKE '%$filename%'";
   		   $result=mysql_query($query);
  		   $id=mysql_result($result,0,"id");
                   session_start();
                   $_SESSION['id'] = $id;

                header("Location: change_tags.php");
                }
                else if($_GET['search'] != null) {
                        $search= $_GET['search'];
                        header("Location: search.php?page=1&terms=$search&changetags=1");
                    }
        }
    }
}
else
//if the cookie does not exist, they are taken to the login screen
{
    header("Location: login.php");
}
?>