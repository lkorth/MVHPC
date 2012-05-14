<?php
require_once 'includes/master.inc.php';

$Auth->requireUser();

$title = "Edit";

$id = $_GET['id'];
$query = "SELECT * FROM pages WHERE id = '$id'";
$result = mysql_query($query);
$data = mysql_result($result, 0, "data");
$name = mysql_result($result, 0, "name");

session_start();
$_SESSION['id'] = $id;
$_SESSION['name'] = $name;

include 'header.php';
?>
<div>
    <form method="post" action="process.php">
        <p>
            <textarea name="data" style="width: 100%"><?php echo $data; ?></textarea>
        </p>
    </form>
</div>
<?php
include 'footer.php';
?> 