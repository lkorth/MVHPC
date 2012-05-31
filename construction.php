<?php
require_once 'includes/master.inc.php';
require_once 'includes/class.template.php';

$template = new Template();

$template->setTitle('MVHPC :: Under Construction');
ob_start();
?>
<style type="text/css">
    .navbar {
        display: none;
    }
</style>

<h1 class="ribbon">We'll Be Back Soon!</h1>

<img src="images/under-construction.png" style="margin-top: 100px;" />

<?php
$singleCol = ob_get_clean();
$template->setStyle('oneColumn');
$template->setSingleCol($singleCol);

$template->output();
?>
