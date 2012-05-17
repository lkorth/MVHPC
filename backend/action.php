<?php
$title = "Manage Site";
$level = '../';
include '../shared/header.php';

$Auth->requireUser();

$db = Database::getDatabase();
$row = $db->getRow("SELECT count(date) as num FROM changeRequests WHERE processed = 'false'");
$unprocessed = $row['num'];
?>
<table align="center">
    <tr>
    <tr>
        <td>
    <tr><td><h3>Welcome<br>
                What would you like to do?</h3></td></tr>
    <tr><td><a href="upload-images.php">Upload Images</a></td></tr>
    <tr><td><a href="select-to-change-tags.php">Change Image Tags</a></td></tr>
    <tr><td><a href="all-images.php?page=1">View and Edit All Images</a></td></tr>
    <tr><td><a href="tag-requests.php">View Tag Requests (<?php echo $unprocessed; ?> new)</a></td></tr>
    <tr><td><a href="logout.php">Logout</a></td></tr>
</td>
</tr>
</tr>
</table>
</div>
<br>
<div id="footer">
    <p><a href="login.php">Manage site</a><br>
</div>
</div>
</div>
</body>
</html>