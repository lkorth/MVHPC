<?php

include('../includes/master.inc.php');
include('../includes/class.template.php');

$Auth->requireUser();

$template = new Template();

$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

if(isset($_GET['id']) && !empty($_GET['id'])){
    $query = "SELECT thumbnail,id,tags,information,mid FROM search WHERE " . $_GET['id'] . " ORDER BY id DESC";
    $params = 'id=' . $_GET['id'];
} else if(isset($_GET['tag']) && !empty($_GET['tag'])) {
    $query = "SELECT thumbnail,id,tags,information,mid FROM search WHERE tags like '%" . mysql_escape_string($_GET['tag']) . "%' ORDER BY id DESC";
    $params = 'tag=' . $_GET['tag'];
} else {
    $query = "SELECT thumbnail,id,tags,information,mid FROM search WHERE 1=1 ORDER BY id DESC";
    $params = 'all=true';
}

$db = Database::getDatabase();
$result = $db->query($query);
$num = $db->numRows($result);

?>
<?php
    $headerExtras['js'] = array('jquery-bgiframe-min.js',
                                'jquery-ajaxQueue.js',
                                'jquery-autocomplete.js',
                                'jquery-lightbox-05-min.js',
                                'jquery-spellchecker.js',
                                'jquery-tagsinput.js',
                                'all-images.js',
                                'functions.js');
    $headerExtras['css'] = array('jquery-lightbox-05.css', 'jquery-spellchecker.css', 'jquery-autocomplete.css', 'jquery-tagsinput.css');
?>
<?php ob_start(); ?>
    <table align="center">
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
        $update = "update" . $id;
        echo "<tr><td><br><br><div style=\"width: 224px; height: 224px;\"><a id='thumb$id' href=\"" . WEB_ROOT . "$mid\" rel=\"lightbox\"><img src=\"" . WEB_ROOT . "$thumbnail\" /></a></div>
            <br><button class='button' onClick='rotate($id,90,\"$id\")'><img src='" . WEB_ROOT . "images/rotate-cc.png'/></button>&nbsp;&nbsp;<button class='button' onClick='rotate($id,270,\"$id\")'><img src='" . WEB_ROOT . "images/rotate-c.png'/></button>
            </td><td align=\"right\"><p>Tags: MUST be seperated by a semicolon (;)</p><textarea class=\"tagArea\" name=\"$pictags\" id=\"$pictags\" rows=\"5\" cols=\"40\" readonly=\"readonly\">$tag</textarea></td></tr>
            <tr><td></td><td align=\"right\"><p>Information:</p> <textarea class = \"textarea\" name=\"$picinfo\" id=\"$picinfo\" rows=\"5\" cols=\"40\" readonly=\"readonly\">$info</textarea><br><br>
            <input type=button value=\"Edit\" onClick=\"editfunction($id)\">
            <input type=button id=\"$update\" class=\"hidden-button\" value=\"Update\" onClick=\"updatefunction($id)\">
            <input type=button id=\"$button\" class=\"hidden-button\" value=\"Delete\" onClick=\"deletefunction($id)\">
            </td></tr><tr><td><br><br></td></tr>";
    }
    echo "</table>";

    renderPaging($pager, WEB_ROOT . 'backend/all-images.php?' . $params);

    ?>
    </div>

<?php
    $content = ob_get_clean();

    $template->setStyle('oneColumn');
    $template->setTitle('All Images');
    $template->setHeaderExtras($headerExtras);
    $template->setSingleCol($content);

    $template->output();
?>
