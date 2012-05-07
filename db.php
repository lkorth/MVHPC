<?php
// Connects to your Database
mysql_connect("localhost", "user", "pass") or die(mysql_error());
mysql_select_db("mvhpcorg_main") or die(mysql_error());
?>