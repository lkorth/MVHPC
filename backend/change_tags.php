<?php

$title = "Update Tags";
$level = '../';
include '../shared/header.php';

if ($_GET['redirect'] == 1) {
    session_start();
    $_SESSION['id'] = $_GET['id'];
    $_SESSION['redirect'] = 1;
}

$Auth->requireUser();

$tag = 1;
$delete = 1;
$change = 1;
session_start();
if ($_SESSION['id'] != null) {
    $id = $_SESSION['id'];
    session_destroy();
} else {
    $id = $_GET['id'];
}

$db = Database::getDatabase();
$result = $db->query("SELECT * FROM search WHERE id = '$id'");

$mid = mysql_result($result, 0, "mid");
$information = mysql_result($result, 0, "information");
$tags = mysql_result($result, 0, "tags");

?>
<img src="<?php echo $mid; ?>"/><p>Info: <?php echo $information; ?></p><p>Tags: <?php echo $tags; ?></p>
<form enctype="multipart/form-data" name="form" action="update.php" method="POST">
    Modify tags (Each tag must be seperated by a ;  )<textarea name="<?php echo "tags" . $id; ?>" rows="10" cols="40" readonly = "readonly"><?php echo $tags ?></textarea>
    <br>Modify Information:  <textarea name="<?php echo "info" . $id; ?>" rows="10" cols="40" readonly="readonly"><?php echo $information ?></textarea><br>
    <input type=hidden name="id" value="<?php echo $id; ?>">
    <input type=button value="Edit" onClick="editfunction(<?php echo $id; ?>)">
    <br>
    <input type="submit" value="Update" />
    <br>
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
<br>
<div id="footer">
    <p><a href="<?php WEBROOT() ?>backend/login.php">Manage site</a><br>
</div>
</div>
</div>
</body>
</html>