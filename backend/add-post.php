<?php

include('../includes/master.inc.php');
include('../includes/class.template.php');

$Auth->requireUser();

$template = new Template();

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    $db = Database::getDatabase();
    $result = $db->getRow("SELECT * FROM posts WHERE id = '$id'");
}

ob_start();
?>
<form action="process-post.php" method="post">
    Title: <input type="text" name="title" value="<?php echo (isset($id)) ? $result['title'] : ''; ?>" /><br>
    Page: <input type="text" name="page" value="<?php echo (isset($id)) ? $result['page'] : ''; ?>"/><br><!--change to drop down? -->
    Text: <textarea name="postText" rows="5" cols="40"><?php echo (isset($id)) ? $result['text'] : ''; ?></textarea>
    <hidden name="id" value="<?php echo (isset($id)) ? $id : 0; ?>" />
    <input type="submit" value="Submit" />
</form>
<?php
    $content = ob_get_clean();

    $template->setStyle('oneColumn');
    $template->setTitle('Add Post');
    //$template->setHeaderExtras($headerExtras);
    $template->setSingleCol($content);

    $template->output();
?>
