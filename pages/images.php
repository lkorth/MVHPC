<?php

// set up template title & style
$title = 'MVHPC :: Search Images';
$template->setStyle('oneColumn');

$terms = strtolower(urldecode($subpage2));
$page = (isset($subpage3) && !empty($subpage3)) ? $subpage3 : 1;

if (!empty($terms)) {
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
}

ob_start();
?>
<input name="terms" type="text" id="global"/>
<button id="search" type="button">Search</button>

<?php
if (!empty($terms)) {
    echo "<p>Your search returned " . $num . " results</p><br>";

    $pager = new Pager($page, 16, $num);
    $pager->calculate();

    for ($i = $pager->firstRecord; $i <= $pager->lastRecord; $i++) {
        $thumbnail = mysql_result($result, $i, "thumbnail");
        $id = mysql_result($result, $i, "id");
        echo "<a href=\"" . WEB_ROOT . "archives/images/" . "$id\"><img src=\"" . WEB_ROOT . "$thumbnail\"/></a>&nbsp;";
    }

    renderPaging($pager, WEB_ROOT . 'archives/images/' . $terms, true);
}
  
$content = ob_get_clean();

// change title if searching, and set the title
if (!empty($terms))
    $title = 'Search of ' . $terms;
$template->setTitle($title);

// set Javascript and CSS
array_push($headerJS, 'jquery-bgiframe-min.js',
                      'jquery-ajaxQueue.js',
                      'jquery-autocomplete.js',
                      'inpage_script.js');
array_push($headerCSS, 'jquery-autocomplete.css');

// send content to template
$template->setSingleCol($content);    
    
?>
