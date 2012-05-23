<?php
require_once $level . 'includes/master.inc.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta content="text/html;charset=UTF-8" http-equiv="Content-type"/>
        <link REL="SHORTCUT ICON" HREF="favicon.ico"> 
        <?php if (!isset($upload)) { ?>
            <script type="text/javascript" src="<?php WEBROOT() ?>min/?b=js&f=jquery-1.7.2.js,jquery.bgiframe.min.js,jquery.ajaxQueue.js,jquery.autocomplete.js,inpage_script.js,functions.js,base64.js,magiczoom.js&1234"></script>
            <link rel="stylesheet" type="text/css" href="<?php WEBROOT() ?>min/?b=css&f=jquery.autocomplete.css,magiczoom.css,silhouette.css&1234" />
        <?php } ?>
        <title><?php echo $title; ?></title>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-23828542-1']);
            _gaq.push(['_trackPageview']);
	
            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
    </head>
    <body>
        <div id="header">
            <a href="<?php WEBROOT(); ?>index.php"><img src="<?php WEBROOT(); ?>images/header.jpg" border=0/></a>
        </div>
        <div id="container">
            <div id="navbar">
                <ul>
                    <li><a href="<?php WEBROOT(); ?>index.php">Home</a></li>
                </ul>
                <ul>
                    <li><a href="<?php WEBROOT(); ?>pages/districts">Districts</a></li>
                </ul>
                <ul>
                    <li><a href="<?php WEBROOT(); ?>pages/history">History</a>
                        <ul>
                            <li><a href="<?php WEBROOT(); ?>pages/text">Text</a></li>
                            <li><a href="<?php WEBROOT(); ?>pages/images">Images</a></li>
                        </ul> 
                    </li>
                </ul>
                <ul>
                    <li><a href="<?php WEBROOT(); ?>pages/about-us">About Us</a>
                        <ul>
                            <li><a href="<?php WEBROOT(); ?>pages/links">Links</a></li>
                            <li><a href="<?php WEBROOT(); ?>pages/design-review">Design Review</a></li>
                        </ul> 
                    </li>
                </ul>
                <div id="search">
                    <?php if (!isset($upload)) { ?>
                        <form enctype="multipart/form-data" action="<?php WEBROOT(); ?>pages/search.php" method="GET" autocomplete="off">
                            <input type="hidden" value="1" name="page" />
                            <input name="terms" type="text" id="global"/>
                            <input type="submit" value="Search" />
                        </form>
                    <?php } ?>
                </div>
                <div id="clear"></div>
            </div>
            <div id="main">
