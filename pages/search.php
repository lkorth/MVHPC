<?php

if ($_GET['changetags'] != null) {
    $pagetype = "change_tags.php?";
    $cgtags = 1;
} else {
    $pagetype = "fullsize.php?";
    $cgtags = null;
}

$page = $_GET['page'];
$terms = $_GET['terms'];

$title = "Search of " . $terms;
$terms = strtolower($terms);

$level = '../';
include '../shared/header.php';
echo "<br>";

$db = Database::getDatabase();

$result = $db->query("SELECT thumbnail,id MATCH(tags, information) AGAINST('$terms') AS score FROM search WHERE MATCH(tags, information) AGAINST('$terms') ORDER BY score DESC, views DESC");
$num = $db->numRows($result) ? $db->numRows($result) : 0;

if ($num <= 25) {
    $i = 0;
}
else if ($page == 1 && $num > 25) {
    $i = 0;
} else if ($page > 1 && $num > 25) {
    $i = (($page - 1) * 25);
}

if ($num == 0) {
    $num = '';
    $result = $db->query("SELECT thumbnail,id FROM search WHERE tags LIKE '%$terms%' OR information LIKE '%$terms%' ORDER BY views DESC");
    $num = $db->numRows($result) ? $db->numRows($result) : 0;
    if ($num == 0) {
        echo "<p>No results found for the search \"" . $terms . "\".&nbsp;&nbsp;Please try a different search.</p>";
    } else if ($num <= 25) {
        $i = 0;
    } else if ($page == 1 && $num > 25) {
        $i = 0;
    } else if ($page > 1 && $num > 25) {
        $i = (($page - 1) * 25);
    }
    if ($num != 0) {
        echo "<p>Your search returned " . $num . " results</p><br>";
    }
    
    $i24 = $i + 25;
    while ($i < $num && $i < $i24) {
        $thumbnail = mysql_result($result, $i, "thumbnail");
        $id = mysql_result($result, $i, "id");
        echo "<a href=\"$pagetype" . "id=$id\"><img src=\"$thumbnail\"/></a>&nbsp;";
        $i++;
    }
} else {
    $i24 = "";
    $i24 = $i + 25;
    while ($i < $num && $i < $i24) {
        $thumbnail = mysql_result($result, $i, "thumbnail");
        $id = mysql_result($result, $i, "id");
        echo "<a href=\"$pagetype" . "id=$id\"><img src=\"$thumbnail\"/></a>&nbsp;";
        $i++;
    }
}

$needed = ($num / 25);
$needed = ceil($needed);

if ($needed > 1) {
    $next = $page + 1;
    $space = str_replace(" ", "+", $terms);
    echo "<div>";
    echo "<br>";
    if ($page > 1) {
        $pre = $page - 1;
        echo "<a href=\"search.php?page=$pre&terms=$space&changetags=$cgtags\"/><=Prevous Page=</a>";
        echo "&nbsp;&nbsp;&nbsp;";
    }
    echo "<span style=\"color:white\">$page</span>";
    echo "&nbsp;&nbsp;&nbsp;";
    $pageindex = $page + 1;
    for ($i = 0; $i < 5; $i++) {
        if ($pageindex <= $needed) {
            echo "<a href=\"search.php?page=$pageindex&terms=$space&changetags=$cgtags\"/>$pageindex</a>";
            echo "&nbsp;&nbsp;&nbsp;";
            $pageindex++;
        }
    }
    if ($page < $needed) {
        echo "<a href=\"search.php?page=$next&terms=$space&changetags=$cgtags\"/>=Next Page=></a>";
    }
    echo "<br>";
    echo "</div>";
}
include '../shared/footer.php';
?>