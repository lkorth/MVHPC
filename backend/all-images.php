<?php

$title = "All Database Images";
$tag = 1;
$all = 1;
$update = 1;
$delete = 1;
$page = $_GET['page'];
$level = '../';
include '../shared/header.php';

$Auth->requireUser();
?>
<!-- spell checker for all.php http://code.google.com/p/jquery-spellchecker/ -->
<script type="text/javascript" src="<?php WEBROOT() ?>js/jquery.lightbox-0.5.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php WEBROOT() ?>css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript">
$(function() {
	$('[rel=lightbox]').lightBox();
});
</script>
<?php
echo "<br>";
echo '<table align="center">';
echo '<form name="form" enctype="multipart/form-data">';
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

if(isset($_GET['id']))
    $query = "SELECT thumbnail,id,tags,information,mid FROM search WHERE " . $_GET['id'] . " ORDER BY id DESC";
else if(isset($_GET['tag']))
    $query = "SELECT thumbnail,id,tags,information,mid FROM search WHERE tags like '%" . $_GET['tag'] . "%' ORDER BY id DESC";
else if(isset($_GET['filename']))
    $query = "SELECT thumbnail,id,tags,information,mid FROM search WHERE location like '%" . $_GET['filename'] . "%' ORDER BY id DESC";
else
    $query = "SELECT thumbnail,id,tags,information,mid FROM search WHERE 1=1 ORDER BY id DESC";

$db = Database::getDatabase();
$result = $db->query($query);
$num = $db->numRows($result);

$needed = ($num / 50);
$needed = ceil($needed);
$prev = $page - 1;
$next = $page + 1;
echo "<h2>Click the thumbnail to see a larger image</h2>";
echo "<h3>There are " . $num . " entries in the database<br>";
echo "Currently on page $page of $needed, entries " . ((($page - 1) * 50) + 1) . " through " . ($page * 50) . "</h3>";
if ($page == 1) {
    $finish = 50;
    $i = 0;
} else if ($page == $needed) {
    $finish = $num;
    $i = ($page - 1) * 50;
} else {
    $finish = $page * 50;
    $i = ($page - 1) * 50;
}
while ($i < $finish) {
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
</td><td align=\"right\"><p>Tags: MUST be seperated by a semicolon (;)</p><textarea class=\"textarea\" name=\"$pictags\" id=\"$pictags\" rows=\"5\" cols=\"40\" readonly=\"readonly\">$tag</textarea></td></tr>
	<tr><td></td><td align=\"right\"><p>Information:</p> <textarea class = \"textarea\" name=\"$picinfo\" id=\"$picinfo\" rows=\"5\" cols=\"40\" readonly=\"readonly\">$info</textarea><br><br>
	  <input type=button value=\"Edit\" onClick=\"editfunction($id)\">
	  <input type=button value=\"Update\" onClick=\"updatefunction($id)\">
	  <input type=button id=\"$button\" class=\"button\" value=\"Delete\" onClick=\"deletefunction($id)\">
	  </td></tr><tr><td><br><br></td></tr>";
}
echo "</form>";
echo "</table>";
if ($page == 1) {
    echo "<span style=\"color:white\">$page</span>";
    echo "&nbsp;&nbsp;&nbsp;";
    $pageindex = $page + 1;
    for ($i = 0; $i < 5; $i++) {
        if ($pageindex <= $needed) {
            echo "<a href=\"all.php?page=$pageindex\"/>$pageindex</a>";
            echo "&nbsp;&nbsp;&nbsp;";
            $pageindex++;
        }
    }
    echo "<a href=\"all.php?page=2\"/>=Next Page=></a>";
} else {
    echo "<a href=\"all.php?page=$prev\"/><=Prevous Page=</a>";
    echo "&nbsp;&nbsp;&nbsp;";
    echo "<span style=\"color:white\">$page</span>";
    echo "&nbsp;&nbsp;&nbsp;";
    $pageindex = $page + 1;
    for ($i = 0; $i < 5; $i++) {
        if ($pageindex <= $needed) {
            echo "<a href=\"all.php?page=$pageindex\"/>$pageindex</a>";
            echo "&nbsp;&nbsp;&nbsp;";
            $pageindex++;
        }
    }
    if ($page < $needed) {
        echo "<a href=\"all.php?page=$next\"/>=Next Page=></a>";
    }
}
?>
</div>
<br>
<div id="footer">
    <p><a href="login.php">Manage site</a><br>
</div>
</div>
</div>
</body>
</html>