<?php
$title = "Request Change of Tags";
$tag = 1;
include '../shared/header.php';

$id = $_GET['id'];

$db = Database::getDatabase();

$row = $db->getRow("SELECT * FROM search WHERE id = '$id'");

?>
<br>
<img src="<?php echo $row['mid']; ?>"/><p>Information: <?php echo $row['information']; ?></p><p>Tags: <?php echo $row['tags'];?> </p>

<form method="POST" action="sendmail.php">
   <br><p> Enter Your Email Address: <input name="email" type="text" /></p>
    <br>
    <input type=hidden name="id" value="<?php echo $id; ?>">
    <input type=hidden name="type" value="0">
    <p>Changes: <textarea name="message" rows="15" cols="40"></textarea></p>
        <br><br>
        <input type="submit" value="Submit"/>
</form>
<br>
<?php
include 'footer.php';
?>