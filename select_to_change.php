<?php
require_once 'includes/master.inc.php';

$Auth->requireUser();

include 'header.php';
?>

<p>Enter only ONE of the following</p>
<table align="center">
    <form enctype="multipart/form-data" action="inbetween.php" method="GET"  autocomplete="off">
        <tr><td align ="left"><p>Enter Item Id:</p></td><td align="right"><input type="text" name="id" id="id" /></td></tr>
       <!-- <tr><td align ="left"><p>Or enter a file name:</p></td><td align="right"><input type="text" name="filename" id="file" /></td></tr> -->
        <tr><td align ="left"><p>Or enter a search term:</p></td><td align="right"><input type="text" name="search" id="change"/></td></tr>
        <tr><td></td><td align ="right"><input type="submit" value="Submit" /></td></tr>
    </form>
</table>
</div>
<br>
<div id="footer">
    <p><a href="login.php">Manage site</a><br>
</div>
</div>
</div>
</body>
</html>