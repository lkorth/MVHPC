<?php
include('../includes/master.inc.php');
include('../includes/class.template.php');

$template = new Template();

if (!empty($_POST['email']) || !empty($_POST['subject']) || !empty($_POST['message'])) {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (!valid_email($email, true))
        $Error->add('email', "<p class='body_text'>Please enter a valid email address.</p>");
    else if (strlen($subject) === 0)
        $Error->add('subject', "<p class='body_text'>Please enter a subject.</p>");
    else if (strlen($message) === 0)
        $Error->add('message', "<p class='body_text'>Please enter a message.</p>");
    else {
        send_html_mail('lkorth12@cornellcollege.edu', $subject, $message, $email);
        $success = true;
    }
}

ob_start();
?>
<h1 class="ribbon">Contact Us</h1>

<?php
if (isset($success) && $success == true) {
    echo "<p class='body_text'>Your request has been successfully submitted, we will contact you soon.</p>";
} else {
    ?>
    <?php echo $Error; ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="email" class="body_text">Your Email Address:</label> <input name="email" type="text" />
        <label for="subject" class="body_text">Subject:</label> <input name="subject" type="text" />
        <label for="message" class="body_text">Message:</label> <textarea name="message" rows="30" cols="65"></textarea>
        <br>
        <input class="button" type="submit" value="Submit"/>
    </form>
    <?php
}
$content = ob_get_clean();

$template->setStyle('oneColumn');
$template->setTitle('Contact Us');
$template->setHeaderExtras(null);
$template->setSingleCol($content);

$template->output();
?>