<?php
$title = "Edit Pages";
$level = '../';
include '../shared/header.php';

$Auth->requireUser();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    //display the editor
    $id = $_GET['id'];
    $db = Database::getDatabase();
    $row = $db->getRow("SELECT data FROM pages WHERE id = '$id'");
    ?>
    <div>
        <form action="process-page-edit.php" method="post">
            <p>
                <textarea name="data" style="width: 100%"><?php echo $row['data']; ?></textarea>
            </p>
            <hidden name="id" value="<?php echo $id ?>"/>
    </form>
    </div>
<?php
}
else {
    //display page selector drop down
    $db = Database::getDatabase();
    $rows = $db->getRows("SELECT id, name FROM pages");

    echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="get">';
    echo '<select name="id">';
    foreach($rows as $row){
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
    echo '</select>';
    echo '<input type="submit" value="Submit" />';
    echo '</form>';
}

include '../shared/footer.php';
?>