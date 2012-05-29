<?php

include('../includes/master.inc.php');
include('../includes/class.template.php');

$Auth->requireUser();

$template = new Template();

$type = (isset($_GET['old']) && $_GET['old'] == 'true') ? 'true' : 'false';

$db = Database::getDatabase();
$result = $db->query("SELECT * FROM change_requests WHERE processed = '$type' order by date desc");
$unprocessed = $db->numRows($result);

ob_start();
?>
<?php
if ($unprocessed == 0 && $type != 'true'):
?>
    <br>
    <h2>No new tag requests, click <a href="<?php echo $_SERVER['PHP_SELF'] ?>?old=true">here</a> to see completed requests</h2>
    <br>
    <?php
else:
    while($row = mysql_fetch_assoc($result)){
        echo $row['email'];
        echo $row['message'];
        echo $row['id'];
        echo $row['date'];
    }
endif;
?>
<?php
    $content = ob_get_clean();

    $template->setStyle('oneColumn');
    $template->setTitle('Tag Requests');
    //$template->setHeaderExtras($headerExtras);
    $template->setSingleCol($content);

    $template->output();
?>
