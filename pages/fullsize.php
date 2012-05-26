<!doctype html>

<?php

include('../includes/master.inc.php');
include('../includes/class.template.php');

$template = new Template();


$id = $_GET['id'];

$db = Database::getDatabase();
$row = $db->getRow("SELECT * FROM search WHERE id = '$id'");

$location = $row['location'];
$medlg = $row['medlg'];
$mid = $row['mid'];

$trueviews = $row['trueviews'] + 1;
$views = $row['views'] + 0.05;
$db->query("UPDATE search SET views = '$views', trueviews = '$trueviews' WHERE id = '$id'");

?>
<html>
<?php
    $headerExtras['js'] = array('jquery-172.js',
                                'jquery-bgiframe-min.js',
                                'jquery-ajaxQueue.js',
                                'jquery-autocomplete.js',
                                'jquery-lightbox-05-min.js',
                                'jquery-spellchecker.js',
                                'jquery-tagsinput.js',
                                'all-images.js');
    $headerExtras['css'] = array('jquery-lightbox-05.css', 'jquery-spellchecker.css', 'jquery.autocomplete.css', 'jquery-tagsinput.css');
?>
<?php ob_start(); ?>
    <?php
    echo "<br>";
    echo "<a href=\"" . WEB_ROOT . "$medlg\" class=\"MagicZoom\" rel=\"click-to-initialize:true;zoom-position:inner;zoom-fade:true;\"><img src=\"" . WEB_ROOT . "$mid\"/></a>";
    echo "<p>Click the picture to turn on zooming</p>";
    echo "<br><br>";
    echo '<p>' . $row['information'] . '</p>';
    echo "<br><br>";
    echo "<a href=\"" . WEB_ROOT . "$location\">Click here for full resolution picture (Warning some pictures are VERY large)</a><br>";
    echo "<a href=\"feedback.php?id=$id\">Click here to request tag update</a>";
    ?>
<?php
    $content = ob_get_clean();

    $template->setStyle('oneColumn');
    $template->setHeaderExtras($headerExtras);
    $template->setBody($content);

    $template->output();
?>