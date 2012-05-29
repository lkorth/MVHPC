<?php
include('../includes/master.inc.php');
include('../includes/class.template.php');

$template = new Template();

if (!empty($_POST['email']) || !empty($_POST['subject']) || !empty($_POST['message'])) {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (!valid_email($email, true))
        $Error->add('email', "Please enter a valid email address.");
    else if (strlen($subject) === 0)
        $Error->add('subject', "Please enter a subject.");
    else if (strlen($message) === 0)
        $Error->add('message', "Please enter a message.");
    else {
        send_html_mail('lkorth12@cornellcollege.edu', $subject, $message, $email);
        $success = true;
    }
}

ob_start();
?>
<?php
if (isset($success) && $success == true) {
    echo '<h2>Your request has been successfully submitted, we will contact you soon.</h2>';
} else {
    ?>
    <br>
    <?php echo $Error; ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <br><p>Your Email Address: <input name="email" type="text" /></p>
        <p>Subject: <input name="subject" type="text" /><p/>
        <p>Message: <textarea name="message" rows="30" cols="65"></textarea></p>
        <br><br>
        <input type="submit" value="Submit"/>
    </form>
    <br>
    <?php
}
$content = ob_get_clean();

$template->setStyle('oneColumn');
$template->setTitle('Manage Site');
$template->setHeaderExtras(null);
$template->setSingleCol($content);

$template->output();
?>