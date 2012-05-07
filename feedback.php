<?php
//Database credentials
include 'db.php';

$id = $_GET['id'];
$query="SELECT * FROM search WHERE id = '$id'";
$result=mysql_query($query);
$mid=mysql_result($result,0,"mid");
$information=mysql_result($result,0,"information");
$tags=mysql_result($result,0,"tags");
$title = "Request Change of Tags";
$tag = 1;
include 'header.php';
?>
<br />
<img src="<?php echo $mid; ?>"/><p>Information: <?php echo $information; ?></p><p>Tags: <?php echo $tags;?> </p>

<form method="POST" action="sendmail.php">
   <br /><p> Enter Your Email Address: <input name="email" type="text" /></p>
    <br />
    <input type=hidden name="id" value="<?php echo $id; ?>">
    <input type=hidden name="type" value="0">
    <p>Changes: <textarea name="message" rows="15" cols="40"></textarea></p>
        <br /><br />
        <input type="submit" value="Submit"/>
</form>
<br />
<?php
include 'footer.php';
?>