<?php require_once '../includes/master.inc.php';
$page = $_GET['page'];
$terms = $_GET['filename'];
$title = "Filename Search: " . $terms;
$terms = ereg_replace("[^A-Za-z0-9]", " ", $terms);
$terms = strtolower($terms);
include 'header.php';
echo "<br>";
$query = "SELECT thumbnail,id MATCH(location) AGAINST('$terms') AS score FROM search WHERE MATCH(location) AGAINST('$terms') ORDER BY score DESC, views DESC";
$result = mysql_query($query);
if (!($result == false)) {
    $num = mysql_numrows($result);
} else {
    $num = 0;
}if ($num <= 25) {
    $i = 0;
}if ($page == 1 && $num > 25) {
    $i = 0;
} else if ($page > 1 && $num > 25) {
    $i = (($page - 1) * 25);
}if ($num == 0) {
    $query = "";
    $result = "";
    $num = "";
    $query = "SELECT thumbnail,id FROM search WHERE location LIKE '%$terms%' ORDER BY views DESC";
    $result = mysql_query($query);
    $num = mysql_numrows($result);
    mysql_close();
    if ($num <= 25) {
        $i = 0;
    } if ($page == 1 && $num > 25) {
        $i = 0;
    } else if ($page > 1 && $num > 25) {
        $i = (($page - 1) * 25);
    } $i24 = $i + 25;
    while ($i < $num && $i < $i24) {
        $thumbnail = mysql_result($result, $i, "thumbnail");
        $id = mysql_result($result, $i, "id");
        echo "<a href=\"change_tags.php&id=$id\"><img src=\"$thumbnail\"/></a>&nbsp;";
        $i++;
    }
} else {
    $i24 = "";
    $i24 = $i + 25;
    while ($i < $num && $i < $i24) {
        $thumbnail = mysql_result($result, $i, "thumbnail");
        $id = mysql_result($result, $i, "id");
        echo "<a href=\"change_tags.php&id=$id\"><img src=\"$thumbnail\"/></a>&nbsp;";
        $i++;
    } mysql_close();
}$needed = ($num / 25);
$needed = ceil($needed);
if ($needed > 1) {
    $next = $page + 1;
    $space = str_replace(" ", "+", $terms);
    echo "<div>";
    if ($page > 1) {
        $pre = $page - 1;
        echo "<a href=\"filename.php?page=$pre&filename=$space\"/><=Prevous Page=</a>";
        echo "&nbsp;&nbsp;&nbsp;";
    } if ($page < $needed) {
        echo "<a href=\"filename.php?page=$next&filename=$space\"/>=Next Page=></a>";
    } echo "</div>";
}include 'footer.php'; ?>