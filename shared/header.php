<?php
require_once $level . 'includes/master.inc.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta content="text/html;charset=UTF-8" http-equiv="Content-type"/>
        <link REL="SHORTCUT ICON" HREF="favicon.ico"> 
        <?php if (!isset($upload)) { ?>
            <!-- need a jquery lightbox, spell checker for all.php http://code.google.com/p/jquery-spellchecker/ -->
            <script type="text/javascript" src="<?php WEBROOT() ?>min/?b=js&f=jquery-1.7.2.js,jquery.bgiframe.min.js,jquery.ajaxQueue.js,jquery.autocomplete.js,inpage_script.js,functions.js,magiczoom.js&1234"></script>
            <link rel="stylesheet" type="text/css" href="<?php WEBROOT() ?>min/?b=css&f=jquery.autocomplete.css,magiczoom.css,silhouette.css&1234" />
        <?php } else {
            ?>
            <script type="text/javascript" src="<?php WEBROOT() ?>js/mootools.js"></script>
            <script type="text/javascript" src="<?php WEBROOT() ?>js/Swiff.Uploader.js"></script>
            <script type="text/javascript" src="<?php WEBROOT() ?>js/Fx.ProgressBar.js"></script>
            <script type="text/javascript" src="<?php WEBROOT() ?>js/Lang.js"></script>
            <script type="text/javascript" src="<?php WEBROOT() ?>js/FancyUpload2.js"></script>
            <script type="text/javascript" src="<?php WEBROOT() ?>js/script.js"></script>
            <link rel="stylesheet" type="text/css" href="<?php WEBROOT() ?>css/uploadstyle.css" />
            <link rel="stylesheet" href="<?php WEBROOT() ?>css/screen.css" type="text/css" media="screen, projection" />
            <link rel="stylesheet" href="<?php WEBROOT() ?>css/print.css" type="text/css" media="print" />
            <link href="<?php WEBROOT() ?>css/silhouette.css" type="text/css" rel="stylesheet" />
            <!--[if IE]><link rel="stylesheet" href="<?php WEBROOT() ?>css/ie.css" type="text/css" media="screen, projection"><![endif]-->
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
            <a href="index.php"><img src="<?php WEBROOT(); ?>images/header.jpg" border=0/></a>
        </div>
        <div id="container">
            <div id="navbar">
                <ul>
                    <li><a href="<?php WEBROOT(); ?>index.php">Home</a></li>
                </ul>
                <ul>
                    <li><a href="<?php WEBROOT(); ?>pages/districts.php">Districts</a></li>
                </ul>
                <ul>
                    <li><a href="<?php WEBROOT(); ?>pages/history.php">History</a>
                        <ul>
                            <li><a href="<?php WEBROOT(); ?>pages/text.php">Text</a></li>
                            <li><a href="<?php WEBROOT(); ?>pages/images.php">Images</a></li>
                        </ul> 
                    </li>
                </ul>
                <ul>
                    <li><a href="<?php WEBROOT(); ?>pages/about-us.php">About Us</a>
                        <ul>
                            <li><a href="<?php WEBROOT(); ?>pages/links.php">Links</a></li>
                            <li><a href="<?php WEBROOT(); ?>pages/design-review.php">Design Review</a></li>
                        </ul> 
                    </li>
                </ul>
                <div id="search">
                    <?php if (!isset($upload)) { ?>
                        <form enctype="multipart/form-data" action="<?php WEBROOT(); ?>search.php" method="GET" autocomplete="off">
                            <input type="hidden" value="1" name="page" />
                            <input name="terms" type="text" id="global"/>
                            <input type="submit" value="Search" />
                        </form>
                    <?php } ?>
                </div>
                <div id="clear"></div>
            </div>
            <div id="main">