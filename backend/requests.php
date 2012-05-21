<?php
$title = "Change requests";
$level = '../';
include '../shared/header.php';

$Auth->requireUser();

$type = (isset($_GET['old']) && $_GET['old'] == 'true') ? 'true' : 'false';

$db = Database::getDatabase();
$result = $db->query("SELECT * FROM changeRequests WHERE processed = '$type' order by date desc");
$unprocessed = $db->numRows($result);

if ($unprocessed == 0) {
    ?>
    <br>
    <h2>No new tag requests, click <a href="<?php echo $_SERVER['PHP_SELF'] ?>?old=true">here</a> to see completed requests</h2>
    <br>
    <?php
} else {
    while($row = mysql_fetch_assoc($result)){
        echo $row['email'];
        echo $row['message'];
        echo $row['id'];
        echo $row['date'];
    }
}
include '../shared/footer.php';
?>