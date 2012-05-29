<?php

include('../includes/master.inc.php');
include('../includes/class.template.php');

if ($Auth->loggedIn())
    redirect(WEB_ROOT . 'backend/action.php');

if (!empty($_POST['username'])) {
    if ($Auth->login($_POST['username'], base64_decode($_POST['password']))) {
        if (isset($_REQUEST['r']) && strlen($_REQUEST['r']) > 0)
            redirect($_REQUEST['r']);
        else
            redirect(WEB_ROOT . 'backend/action.php');
    }
    else
        $Error->add('username', "We're sorry, you have entered an incorrect username and password. Please try again.");
}

$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';

$template = new Template();

?>
<html>
<?php
    $headerExtras['js'] = array('jquery-172.js', 'image-script.js', 'base64.js', 'login.js');
?>
<?php ob_start(); ?>
    <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <?php echo $Error ?>
        <table align="center">
            <tr>
                <td colspan=2><h1>Login</h1></td>
            </tr>
            <tr>
                <td><p>Username:</p></td>
                <td><input type="text" name="username" maxlength="40" value="<?php echo $username; ?>"></td>
            </tr>
            <tr>
                <td><p>Password:</p></td>
                <td><input type="password" name="pass" id="pass" maxlength="50"></td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="submit" name="submit" value="Login"></td>
            </tr>
        </table>
        <input type="hidden" name="r" value="<?php echo htmlspecialchars(@$_REQUEST['r']); ?>" id="r">
        <input type="hidden" id="password" name="password" value="">
    </form>
<?php
    $content = ob_get_clean();

    $template->setStyle('oneColumn');
    $template->setTitle('Login');
    $template->setHeaderExtras($headerExtras);
    $template->setBody($content);

    $template->output();
?>