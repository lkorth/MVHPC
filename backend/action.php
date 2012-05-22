<?php
$title = "Manage Site";
$level = '../';
include '../shared/header.php';

$Auth->requireUser();

$db = Database::getDatabase();
$row = $db->getRow("SELECT count(date) as num FROM change_requests WHERE processed = 'false'");
$unprocessed = $row['num'];

if(isset($_GET['message']))
    echo '<h2>' . $_GET['message'] . '</h2>';
?>

<h3>Welcome,<br> What would you like to do?</h3>

<h4>Images</h4>
<a href="upload-images.php">Upload Images</a><br>
<a href="select-to-change-tags.php">Change Image Tags</a><br>
<a href="all-images.php?page=1">View and Edit All Images</a><br>
<a href="tag-requests.php">View Tag Requests (<?php echo $unprocessed; ?> new)</a><br>
<br>
<h4>Text</h4>
<a href="add-post.php">Add Post</a><br>
<a href="edit-post.php">Edit posts</a><br>

<br>
<a href="logout.php">Logout</a>

</div>
<br>
<div id="footer">
    <p><a href="login.php">Manage site</a><br>
</div>
</div>
</div>
</body>
</html>