<?php
$title = "Request Change of Tags";
$tag = 1;
$level = '../';
include '../shared/header.php';

if ((!empty($_POST['email']) || !empty($_POST['message'])) && !empty($_POST['id'])) {
        $email = $_POST['email'];
        $message = $_POST['message'];
        $id = $_POST['id'];
        
        if(!valid_email($email, true))
            $Error->add('email', "Please enter a valid email address.");
        else if(strlen($message) === 0)
            $Error->add('message', "Please enter a message.");
        else {
            $db = Database::getDatabase();
            $db->query("insert into changeRequests set email = '$email', message = '$message', id = '$id'");
            //redirect('success.php');
        }
}

$id = (!empty($_POST['id'])) ? $_POST['id'] : $_GET['id'];

$db = Database::getDatabase();
$row = $db->getRow("SELECT * FROM search WHERE id = '$id'");
?>
<br>
<img src="<?php echo $row['mid']; ?>"/><p>Information: <?php echo $row['information']; ?></p><p>Tags: <?php echo $row['tags']; ?> </p>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <?php echo $Error ?>
    <br><p> Enter Your Email Address: <input name="email" type="text" /></p>
    <br>
    <input type=hidden name="id" value="<?php echo $id; ?>">
    <p>Changes: <textarea name="message" rows="15" cols="40"></textarea></p>
    <br><br>
    <input type="submit" value="Submit"/>
</form>
<br>
<?php
include '../shared/footer.php';
?>