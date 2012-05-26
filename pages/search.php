<!doctype html>

<?php

include('../includes/master.inc.php');
include('../includes/class.template.php');

$template = new Template();


$terms = strtolower(urldecode($_GET['terms']));
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

$db = Database::getDatabase();
$result = $db->query("SELECT thumbnail,id, MATCH(tags, information) AGAINST('$terms') AS score FROM search WHERE MATCH(tags, information) AGAINST('$terms') ORDER BY score DESC, views DESC");
$num = $db->numRows($result) ? $db->numRows($result) : 0;

if ($num == 0) {
    $result = $db->query("SELECT thumbnail,id FROM search WHERE tags LIKE '%$terms%' OR information LIKE '%$terms%' ORDER BY views DESC");
    $num = $db->numRows($result) ? $db->numRows($result) : 0;
    if ($num == 0) {
        echo "<p>No results found for the search \"" . $terms . "\".&nbsp;&nbsp;Please try a different search.</p>";
    }
}

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

    echo "<p>Your search returned " . $num . " results</p><br>";

    $pager = new Pager($page, 16, $num);
    $pager->calculate();

    for ($i = $pager->firstRecord; $i <= $pager->lastRecord; $i++) {
        $thumbnail = mysql_result($result, $i, "thumbnail");
        $id = mysql_result($result, $i, "id");
        echo "<a href=\"fullsize.php?" . "id=$id\"><img src=\"" . WEB_ROOT . "$thumbnail\"/></a>&nbsp;";
    }

    renderPaging($pager, WEB_ROOT . 'pages/search.php?terms=' . $terms);

    ?>
    </div>

<?php
    $content = ob_get_clean();

    $template->setStyle('oneColumn');
    $template->setTitle('Search of ' . $terms);
    $template->setHeaderExtras($headerExtras);
    $template->setBody($content);

    $template->output();
?>