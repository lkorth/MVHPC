<!doctype html>

<?php

include('../includes/master.inc.php');
include('../includes/class.template.php');

$Auth->requireUser();

$db = Database::getDatabase();
$row = $db->getRow("SELECT count(date) as num FROM change_requests WHERE processed = 'false'");
$unprocessed = $row['num'];

$template = new Template();

?>
<html>
<?php ob_start(); ?>
    <div>
        <?php
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
<?php
    $content = ob_get_clean();

    $template->setStyle('oneColumn');
    $template->setTitle('Manage Site');
    $template->setHeaderExtras($headerExtras);
    $template->setBody($content);

    $template->output();
?>