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
<h1 class="ribbon">Tag Requests</h1>
<?php
if ($unprocessed == 0 && $type != 'true'):
?>
    <p class="body_text">No new tag requests, click <a href="<?php echo $_SERVER['PHP_SELF'] ?>?old=true">here</a> to see completed requests</p>
<?php else: ?>
    <table cellpadding="0" cellspacing="0" id="tag_requests" class="body_text">
        <tr>
            <th>Date</th>
            <th>Email Address</th>
            <th>Message</th>
            <th>Action</th>
        </tr>
    <?php while($row = mysql_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo date('d/m/Y h:i:s', strtotime($row['date'])); ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['message'] ?></td>
            <td><a href="" class="button">Edit</a></td>
        </tr>
    <?php endwhile; ?>
    </table>
    <?php endif; ?>
<?php
    $content = ob_get_clean();

    $template->setStyle('oneColumn');
    $template->setTitle('Tag Requests');
    //$template->setHeaderExtras($headerExtras);
    $template->setSingleCol($content);

    $template->output();
?>
