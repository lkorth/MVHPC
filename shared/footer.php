</div>
<div id="footer">            
    <p>Contact:  <a href="<?php WEBROOT() ?>pages/contact-form.php">Webmaster</a> &nbsp; &#124; &nbsp;
        Designed and Developed: <a href="<?php WEBROOT() ?>pages/contact-form.php">LARS</a> &nbsp; &#124; &nbsp;
        <?php
        if ($Auth->loggedIn())
            echo '<a href="' . WEB_ROOT . 'backend/action.php">Manage site</a>';
        else
            echo '<a href="' . WEB_ROOT . 'backend/login.php">Login</a> to manage site';
        if (isset($zoom) && $zoom == 1) {
            echo "&nbsp; &#124; &nbsp; Zoom:  <a href=\"http://www.magictoolbox.com\">Magic Toolbox</a></p>";
        } else {
            echo "</p>";
        }
        ?>
</div>
</div>
<br>
</body>
</html>