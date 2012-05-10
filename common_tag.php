<?php
require_once 'includes/master.inc.php';

$Auth->requireUser();

$title = "Enter Common Tags";
$tag = 1;
include 'header.php';
?>
<br>
<div align="center">
    <form action="specific_tag.php" method="post" enctype="multipart/form-data" id="nextpage">
        <p>Common Tags: MUST be seperated by a semicolon(;)</p><br><textarea name="ctags" rows="10" cols="40"></textarea><br>
        <input type="submit" value="Next Page" /></form>
</div>
</div>
<br>
<div id="footer">
    <p><a href="login.php">Manage site</a><br>
</div>
</div>
</div>
</body>
</html>