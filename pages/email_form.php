<?php
$title = "Contact";
$tag = 1;
require 'header.php';
?>
<br>
<form method="POST" action="sendmail.php">
    <br><p>Your Email Address: <input name="email" type="text" /></p>
	<p>Subject: <input name="subject" type="text" /><p/>
    <input type=hidden name="to" value="<?php $_GET['to']; ?>">
	<input type=hidden name="page" value="index.php">
	<input type=hidden name="type" value="1">
    <p>Message: <textarea name="message" rows="30" cols="65"></textarea></p>
        <br><br>
        <input type="submit" value="Submit"/>
</form>
<br>
<?php
require 'footer.php';
?>