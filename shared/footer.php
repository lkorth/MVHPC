</div>
<div id="footer">
    <?php
    if ($Auth->loggedIn()) {
        ?>
        <p><a href="<?php WEBROOT(); ?>backend/action.php">Manage site</a><br>
            <?php if (isset($id)) { ?>
                <a href="<?php WEBROOT(); ?>backend/edit.php?id=<?php echo $id; ?>">Edit this Page</a></p>
            <?php
        }
    } else {
        ?>
        <p>Contact:  <a href="<?php WEBROOT() ?>pages/contact-form.php">Webmaster</a> &nbsp; &#124; &nbsp;
            Designed and Developed: <a href="<?php WEBROOT() ?>pages/contact-form.php">LARS</a> &nbsp; &#124; &nbsp;
            <a href="<?php WEBROOT(); ?>backend/login.php">Login</a> to manage site
            <?php
            if (isset($zoom) && $zoom == 1) {
                echo "&nbsp; &#124; &nbsp; Zoom:  <a href=\"http://www.magictoolbox.com\">Magic Toolbox</a></p>";
            } else {
                echo "</p>";
            }
        }
        ?>
</div>
</div>
<br>
</body>
</html>