<?php

if (!empty($_GET['changetags'])) {
    $nextPage = "change_tags.php?";
    $cgtags = 1;
} else {
    $nextPage = "fullsize.php?";
    $cgtags = null;
}

$page = $_GET['page'];
$terms = strtolower(urldecode($_GET['terms']));
$title = "Search of " . $terms;

$level = '../';
include '../shared/header.php';
echo "<br>";

$db = Database::getDatabase();
$result = $db->query("SELECT thumbnail,id, MATCH(tags, information) AGAINST('$terms') AS score FROM search WHERE MATCH(tags, information) AGAINST('$terms') ORDER BY score DESC, views DESC");
$num = $db->numRows($result) ? $db->numRows($result) : 0;

if ($num == 0) {
    $result = $db->query("SELECT thumbnail,id FROM search WHERE tags LIKE '%$terms%' OR information LIKE '%$terms%' ORDER BY views DESC");
    $num = $db->numRows($result) ? $db->numRows($result) : 0;
    if ($num == 0) {
        echo "<p>No results found for the search \"" . $terms . "\".&nbsp;&nbsp;Please try a different search.</p>";
        exit;
    }
}

echo "<p>Your search returned " . $num . " results</p><br>";

$pager = new Pager($page, 25, $num);
$pager->calculate();

for ($i = $pager->firstRecord; $i <= $pager->lastRecord; $i++) {
    $thumbnail = mysql_result($result, $i, "thumbnail");
    $id = mysql_result($result, $i, "id");
    echo "<a href=\"$nextPage" . "id=$id\"><img src=\"" . WEB_ROOT . "$thumbnail\"/></a>&nbsp;";
}

if ($pager->hasNextPage() || $pager->hasPrevPage()) {
    $encodedTerms = urlencode($terms);
    echo '<div><br>';

    if ($pager->hasPrevPage()) {
        echo '<a href="search.php?page=' . $pager->prevPage() . '&terms=' . $encodedTerms . '&changetags=' . $cgtags . '"/><=Prevous Page=</a>';
        echo "&nbsp;&nbsp;&nbsp;";
    }

    if ($pager->prevPage() > 1) {
        $previousPageNumbers = '';
        $j = $pager->prevPage();
        $previousCount = 0;
        while ($j >= 1 && $previousCount < 3) {
            $previousPageNumbers = '<a href="search.php?page=' . $j . '&terms=' . $encodedTerms . '&changetags=' . $cgtags . '"/>' . $j . '</a>&nbsp;&nbsp;&nbsp;' . $previousPageNumbers;
            $previousCount++;
            $j--;
        }
        echo $previousPageNumbers;
    }

    echo "<span style=\"color:white\">$page</span>";
    echo "&nbsp;&nbsp;&nbsp;";

    if ($pager->hasNextPage()) {
        if ($pager->nextPage() != $pager->numPages) {
            $k = $pager->nextPage();
            $nextCount = 0;
            while ($k <= $pager->numPages && $nextCount < 3) {
                echo '<a href="search.php?page=' . $k . '&terms=' . $encodedTerms . '&changetags=' . $cgtags . '"/>' . $k . '</a>&nbsp;&nbsp;&nbsp;';
                $nextCount++;
                $k++;
            }
        }

        echo '<a href="search.php?page=' . $pager->nextPage() . '&terms=' . $encodedTerms . '&changetags=' . $cgtags . '"/>=Next Page=></a>';
    }

    echo '<br></div>';
}

include '../shared/footer.php';
?>