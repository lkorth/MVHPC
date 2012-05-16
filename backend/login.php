<?php
$title = "Login";
$level = '../';
include '../shared/header.php';

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

// Clean the submitted username before redisplaying it.
$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
?>
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
<script>
    $().ready(function() {
        $('#loginForm').submit(function(){
            $('#password').val(base64encode($('#pass').val()));
            return true;
        });
    });
</script>
<?php
include '../shared/footer.php';
?> 