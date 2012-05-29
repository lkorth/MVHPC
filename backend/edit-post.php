<?php

include('../includes/master.inc.php');
include('../includes/class.template.php');

$Auth->requireUser();

$template = new Template();

$db = Database::getDatabase();
$result = $db->getRows("SELECT * FROM posts WHERE 1=1 ORDER BY date DESC");

ob_start();
?>
<?php
//need to style out list summary with link to add-post.php?id=[postID] to edit it
?>
<?php
    $content = ob_get_clean();

    $template->setStyle('oneColumn');
    $template->setTitle('All Posts');
    //$template->setHeaderExtras($headerExtras);
    $template->setSingleCol($content);

    $template->output();
?>

