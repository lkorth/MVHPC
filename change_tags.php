<?php
//Database credentials
include 'db.php';

if ($_GET['redirect'] == 1) {
    session_start();
    $_SESSION['id'] = $_GET['id'];
    $_SESSION['redirect'] = 1;
}

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
        $tag = 1;
        $delete = 1;
        $change = 1;
            session_start();
            if($_SESSION['id'] != null) {
                $id = $_SESSION['id'];
                session_destroy();
            }
            else {
                $id = $_GET['id'];
            }

            $query="SELECT * FROM search WHERE id = '$id'";
            $result=mysql_query($query);

            $mid=mysql_result($result,0,"mid");
            $information=mysql_result($result,0,"information");
            $tags=mysql_result($result,0,"tags");

            $title = "Update Tags";
            include 'header.php';
            ?>
<img src="<?php echo $mid; ?>"/><p>Info: <?php echo $information; ?></p><p>Tags: <?php echo $tags; ?></p>
<form enctype="multipart/form-data" name="form" action="update.php" method="POST">
									Modify tags (Each tag must be seperated by a ;  )<textarea name="<?php echo "tags" . $id; ?>" rows="10" cols="40" readonly = "readonly"><?php echo $tags ?></textarea>
									<br />Modify Information:  <textarea name="<?php echo "info" . $id; ?>" rows="10" cols="40" readonly="readonly"><?php echo $information ?></textarea><br />
    <input type=hidden name="id" value="<?php echo $id; ?>">
    <input type=button value="Edit" onClick="editfunction(<?php echo $id; ?>)">
    <br />
    <input type="submit" value="Update" />
    <br />
    <input type=button id="<?php echo "button" . $id; ?>" class="button" value="Delete" onClick="deletefunction(<?php echo $id ?>)">
  

    
</form> 
<table align="center">
    <tr>
    <tr>
        <td>
    <tr><td><a href="upload_file.php">Upload Files</a></td></tr>
    <tr><td><a href="select_to_change.php">Change Tags</a></td></tr>
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