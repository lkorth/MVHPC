<?php
$title = "MVHPC :: About Us :: Design Review";
$id = 7;
require 'header.php';
$query="SELECT * FROM pages WHERE id = '$id'";
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
			require 'footer.php';
		}
		//otherwise they are shown the admin area
		else {
			require 'edit_page.php';
		}
	}
}
else
//if the cookie does not exist do nothing
{
	require 'footer.php';
}
?>