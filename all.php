<?php
require_once 'includes/master.inc.php';

$Auth->requireUser();

$title = "All Database Pictures";
$tag = 1;
$all = 1;
$update = 1;
$delete = 1;
$page = $_GET['page'];
include 'header.php';
echo "<br />";
echo "<table align=\"center\">";
echo "<form name=\"form\" action=\"\" method=\"\" enctype=\"multipart/form-data\">";
$query = "SELECT thumbnail,id,tags,information,mid FROM search WHERE 1=1 ORDER BY id DESC";
$result = mysql_query($query);
$num = mysql_numrows($result);
mysql_close();
$needed = ($num / 50);
$needed = ceil($needed);
$prev = $page - 1;
$next = $page + 1;
echo "<h2>Click the thumbnail to see a larger image</h2>";
echo "<h3>There are " . $num . " entries in the database<br />";
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
    echo "<tr><td><br /><br /><a href=\"$mid\" rel=\"lightbox\"><img src=\"$thumbnail\" /></a>
</td><td align=\"right\"><p>Tags: MUST be seperated by a semicolon (;)</p><textarea class=\"textarea\" name=\"$pictags\" id=\"$pictags\" rows=\"5\" cols=\"40\" readonly=\"readonly\">$tag</textarea></td></tr>
	<tr><td></td><td align=\"right\"><p>Information:</p> <textarea class = \"textarea\" name=\"$picinfo\" id=\"$picinfo\" rows=\"5\" cols=\"40\" readonly=\"readonly\">$info</textarea><br /><br />
	  <input type=button value=\"Edit\" onClick=\"editfunction($id)\">
	  <input type=button value=\"Update\" onClick=\"updatefunction($id)\">
	  <input type=button id=\"$button\" class=\"button\" value=\"Delete\" onClick=\"deletefunction($id)\">
	  </td></tr><tr><td><br /><br /></td></tr>";
    //echo "<script type=\"text/javascript\">";
    //echo "var googie_" . $pictags . " = new GoogieSpell(\"js/\", \"https://www.google.com/tbproxy/spell?lang=\");";
    //echo "googie_" . $pictags . ".setLanguages({'en': 'English'});";
    //echo "googie_" . $pictags . ".dontUseCloseButtons();";
    //echo "googie_" . $pictags . ".decorateTextarea(\"". $pictags . "\");";
    //echo "var googie_" . $picinfo . "= new GoogieSpell(\"js/\", \"https://www.google.com/tbproxy/spell?lang=\");";
    //echo "googie_" . $picinfo . ".setLanguages({'en': 'English'});";
    //echo "googie_" . $picinfo . ".dontUseCloseButtons();";
    // echo "googie_" . $picinfo . ".decorateTextarea(\"" . $picinfo . "\");";
    // echo "</script>";
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
<br />
<div id="footer">
    <p><a href="login.php">Manage site</a><br />
</div>
</div>
</div>
</body>
</html>