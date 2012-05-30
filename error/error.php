<?php
require_once '../includes/master.inc.php';
require_once '../includes/class.template.php';

$type = $_GET['type'];

$template = new Template();

$template->setTitle('MVHPC :: '.$type.' Error');
ob_start();
?>
<h1 class="ribbon">Oops! <?php echo $type; ?> Error...</h1>

<?php 
switch($type):
    case 403: 
?>
    <p class="body_text">Sorry, you do not have access to this page.</p>
<?php 
    break;
    case 404:
?>
    <p class="body_text">Sorry, the page you are looking for could not be found.</p>
<?php 
    break;
    case 500:
?>
    <p class="body_text">Sorry, there was an internal server error.</p>

<?php
    endswitch;
$singleCol = ob_get_clean();
$template->setStyle('oneColumn');
$template->setSingleCol($singleCol);

$template->output();
?>
