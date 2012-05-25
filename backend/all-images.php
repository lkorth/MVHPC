<!doctype html>

<?php

include('../includes/master.inc.php');
include('../includes/class.template.php');

$Auth->requireUser();

$template = new Template();

$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

if(isset($_GET['id'])){
    $query = "SELECT thumbnail,id,tags,information,mid FROM search WHERE " . $_GET['id'] . " ORDER BY id DESC";
    $params = 'id=' . $_GET['id'];
} else if(isset($_GET['tag'])) {
    $query = "SELECT thumbnail,id,tags,information,mid FROM search WHERE tags like '%" . $_GET['tag'] . "%' ORDER BY id DESC";
    $params = 'tag=' . $_GET['tag'];
} else if(isset($_GET['filename'])) {
    $query = "SELECT thumbnail,id,tags,information,mid FROM search WHERE location like '%" . $_GET['filename'] . "%' ORDER BY id DESC";
    $params = 'filename=' . $_GET['filename'];
} else {
    $query = "SELECT thumbnail,id,tags,information,mid FROM search WHERE 1=1 ORDER BY id DESC";
    $params = 'all=true';
}

$db = Database::getDatabase();
$result = $db->query($query);
$num = $db->numRows($result);

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
    <table align="center">
    <form name="form" enctype="multipart/form-data">
    <?php

    $pager = new Pager($page, 25, $num);
    $pager->calculate();

    echo "<h2>Click the thumbnail to see a larger image</h2>";
    echo "<h3>There are " . $num . " images that match your search<br>";
    echo "Currently on page $page of " . $pager->numPages . ", images " . ($pager->firstRecord + 1) . " through " . ($pager->lastRecord + 1) . "</h3>";

    for ($i = $pager->firstRecord; $i <= $pager->lastRecord; $i++) {
        $thumbnail = mysql_result($result, $i, "thumbnail");
        $id = mysql_result($result, $i, "id");
        $tag = mysql_result($result, $i, "tags");
        $info = mysql_result($result, $i, "information");
        $mid = mysql_result($result, $i, "mid");
        $i++;
        $pictags = "tags" . $id;
        $picinfo = "info" . $id;
        $button = "button" . $id;
        echo "<tr><td><br><br><a href=\"" . WEB_ROOT . "$mid\" rel=\"lightbox\"><img src=\"" . WEB_ROOT . "$thumbnail\" /></a>
    </td><td align=\"right\"><p>Tags: MUST be seperated by a semicolon (;)</p><textarea class=\"tagArea\" name=\"$pictags\" id=\"$pictags\" rows=\"5\" cols=\"40\" readonly=\"readonly\">$tag</textarea></td></tr>
            <tr><td></td><td align=\"right\"><p>Information:</p> <textarea class = \"textarea\" name=\"$picinfo\" id=\"$picinfo\" rows=\"5\" cols=\"40\" readonly=\"readonly\">$info</textarea><br><br>
            <input type=button value=\"Edit\" onClick=\"editfunction($id)\">
            <input type=button value=\"Update\" onClick=\"updatefunction($id)\">
            <input type=button id=\"$button\" class=\"button\" value=\"Delete\" onClick=\"deletefunction($id)\">
            </td></tr><tr><td><br><br></td></tr>";
    }
    echo "</form>";
    echo "</table>";

    renderPaging($pager, WEB_ROOT . 'backend/all-images.php?' . $params);

    ?>
    </div>

<?php
    $content = ob_get_clean();

    $template->setStyle('oneColumn');
    $template->setTitle('All Images');
    $template->setHeaderExtras($headerExtras);
    $template->setBody($content);

    $template->output();
?>
