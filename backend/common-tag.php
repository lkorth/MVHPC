<?php
include('../includes/master.inc.php');
include('../includes/class.template.php');

$Auth->requireUser();

$template = new Template();

$headerExtras['js'] = array('jquery-bgiframe-min.js',
                            'jquery-ajaxQueue.js',
                            'jquery-autocomplete.js',
                            'jquery-tagsinput.js',
                            'common-tags.js');
$headerExtras['css'] = array('jquery-lightbox-05.css', 'jquery-spellchecker.css', 'jquery-autocomplete.css', 'jquery-tagsinput.css');


ob_start();
?>
<div align="center">
    <form action="specific-tag.php" method="post" enctype="multipart/form-data" id="nextpage">
        <p class="body_text">Common Tags: MUST be seperated by a semicolon(;)</p><br><textarea id="tagArea" name="ctags" rows="10" cols="40"></textarea><br>
        <input class="button" type="submit" value="Next Page" /></form>
</div>
<?php
$SingleCol = ob_get_clean();
$template->setStyle('oneColumn');
$template->setTitle('Enter Common Tags');
$template->setHeaderExtras($headerExtras);
$template->setSingleCol($SingleCol);

$template->output();
?>