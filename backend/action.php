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
        /////////////STYLE////////////////////////
        if(isset($_GET['message']))
            echo '<h2>' . $_GET['message'] . '</h2>';
        ?>

        <h1 class="ribbon">Images</h1>
        <ul class="link_list body_text">
            <li><a href="upload-images.php">Upload Images</a></li>
            <li><a href="select-to-change-tags.php">Change Image Tags</a></li>
            <li><a href="all-images.php?page=1">View and Edit All Images</a></li>
            <!-- <li><a href="tag-requests.php">View Tag Requests (<?php echo $unprocessed; ?> new)</a></li> -->
        </ul>

        <h1 class="ribbon">Text</h1>
        <ul class="link_list body_text">
            <li><a href="add-post.php">Add Post</a></li>
            <li><a href="edit-post.php">Edit posts</a></li>
        </ul>
        
    </div>
<?php
    $leftCol = ob_get_clean();
    ob_start();
?>
    
    <h1 class="ribbon">Welcome!</h1>
    <p class="body_text">Please select your desired task from the options on the left.</p>
    <a class="button" href="logout.php">Logout</a>
    
    
<?php
    $rightCol = ob_get_clean();

    $template->setStyle('twoColumn');
    $template->setTitle('Manage Site');
    $template->setHeaderExtras(null);
    $template->setRightCol($rightCol);
    $template->setLeftCol($leftCol);

    $template->output();
?>