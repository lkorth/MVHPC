<?php
$title = "Edit";
$level = '../';
include '../shared/header.php';

$Auth->requireUser();

$id = $_GET['id'];

$db = Database::getDatabase();
$row = $db->getRow("SELECT * FROM pages WHERE id = '$id'");

session_start();
$_SESSION['id'] = $id;
$_SESSION['name'] = $row['name'];

?>
<div>
    <form method="post" action="process.php">
        <p>
            <textarea name="data" style="width: 100%"><?php echo $row['data']; ?></textarea>
        </p>
    </form>
</div>
<?php
include '../shared/footer.php';
?> 