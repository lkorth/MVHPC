<?php
require_once 'includes/master.inc.php';

$Auth->requireUser();

$title = "Manage Site";
include 'header.php';
?>
<table align="center">
    <tr>
    <tr>
        <td>
    <tr><td><h3>Welcome<br />
                What would you like to do?</h3></td></tr>
    <tr><td><a href="upload_file.php">Upload Files</a></td></tr>
    <tr><td><a href="select_to_change.php">Change Tags</a></td></tr>
    <tr><td><a href="all.php?page=1">View and Edit all pictures</a></td></tr>
    <tr><td><a href="https://host394.hostmonster.com:2096">Check Email</a></td></tr>
    <tr><td><a href="logout.php">Logout</a></td></tr>
</td>
</tr>
</tr>
</table>
</div>
<br />
<div id="footer">
    <p><a href="login.php">Manage site</a><br />
</div>
</div>
</div>
</body>
</html>