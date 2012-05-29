<?php

include('../includes/master.inc.php');
include('../includes/class.template.php');

$Auth->requireUser();

$template = new Template();

$headerExtras['js'] = array('jquery-172.js',
                            'jquery-bgiframe-min.js',
                            'jquery-ajaxQueue.js',
                            'jquery-autocomplete.js',
                            'inpage_script.js');
$headerExtras['css'] = array('jquery-autocomplete.css');

ob_start();
?>
<p>Enter only ONE of the following</p>
<table align="center">
    <form enctype="multipart/form-data" action="all-images.php" method="GET"  autocomplete="off">
        <tr><td align ="left"><p>Enter Item Id:</p></td><td align="right"><input type="text" name="id" id="id" /></td></tr>
       <!-- <tr><td align ="left"><p>Or enter a file name:</p></td><td align="right"><input type="text" name="filename" id="file" /></td></tr> -->
        <tr><td align ="left"><p>Or enter a search term:</p></td><td align="right"><input type="text" name="tag" id="change"/></td></tr>
        <tr><td></td><td align ="right"><input type="submit" value="Submit" /></td></tr>
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
