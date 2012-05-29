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
        $Error->add('username', "<p class='body_text error'>We're sorry, you have entered an incorrect username and password. Please try again.</p>");
}

$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';

$template = new Template();

?>
<html>
<?php
    $headerExtras['js'] = array('image-script.js', 'base64.js', 'login.js');
?>
<?php ob_start(); ?>
    <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h1 class="ribbon">Login</h1>
        <?php echo $Error ?>
        <table id="login">
            <tr>
                <td><label for="username" class="body_text">Username:</label></td>
                <td><input type="text" name="username" maxlength="40" value="<?php echo $username; ?>"></td>
            </tr>
            <tr>
                <td><label for="password" class="body_text">Password:</label></td>
                <td><input type="password" name="pass" id="pass" maxlength="50"></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input class="button" type="submit" name="submit" value="Login"></td>
            </tr>
        </table>
        <input type="hidden" name="r" value="<?php echo htmlspecialchars(@$_REQUEST['r']); ?>" id="r">
        <input type="hidden" id="password" name="password" value="">
    </form>
<?php
    $leftCol = ob_get_clean();
    ob_start();
?>
    <h1 class="ribbon">Welcome!</h1>
    <p class="body_text">
        Please log in on the left with the username and password you have 
        been provided. If you have forgotten your username/password or have 
        other technical difficulties, please contact the system administrator for 
        assistance.
    </p>
    
<?php
    $rightCol = ob_get_clean();

    $template->setStyle('twoColumn');
    $template->setTitle('Login');
    $template->setHeaderExtras($headerExtras);
    $template->setleftCol($leftCol);
    $template->setrightCol($rightCol);

    $template->output();
?>