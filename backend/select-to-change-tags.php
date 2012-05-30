<?php

include('../includes/master.inc.php');
include('../includes/class.template.php');

$Auth->requireUser();

$template = new Template();

$headerExtras['js'] = array('jquery-bgiframe-min.js',
                            'jquery-ajaxQueue.js',
                            'jquery-autocomplete.js',
                            'inpage_script.js');
$headerExtras['css'] = array('jquery-autocomplete.css');

ob_start();
?>
<p class="body_text">Enter only ONE of the following</p>
<table align="center">
    <form enctype="multipart/form-data" action="all-images.php" method="GET"  autocomplete="off">
        <tr><td align ="left"><label for="id" class="body_text">Enter Item Id:</label></td><td align="right"><input type="text" name="id" id="id" /></td></tr>
        <tr><td align ="left"><label for="tag" class="body_text">Or enter a search term:</label></td><td align="right"><input type="text" name="tag" id="change"/></td></tr>
        <tr><td align="left"><a href="all-images.php?live=false">View unfinished images.</a></td></tr>
        <tr><td></td><td align ="middle"><input class="button" type="submit" value="Submit" /></td></tr>
    </form>
</table>
<?php
    $content = ob_get_clean();

    $template->setStyle('oneColumn');
    $template->setTitle('Search Tags to Edit');
    $template->setHeaderExtras($headerExtras);
    $template->setSingleCol($content);

    $template->output();
?>
