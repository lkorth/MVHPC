<?php
require_once 'includes/master.inc.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta content="text/html;charset=UTF-8" http-equiv="Content-type"/>
        <link REL="SHORTCUT ICON" HREF="favicon.ico"> 
        <?php if (!isset($upload)) { ?>
            <!-- need a jquery lightbox -->
            <script type="text/javascript" src="js/jquery-1.7.2.js"></script>
            <script type='text/javascript' src='js/jquery.bgiframe.min.js'></script>
            <script type='text/javascript' src='js/jquery.ajaxQueue.js'></script>
            <script type='text/javascript' src='js/jquery.autocomplete.js'></script>
            <script type='text/javascript' src='js/inpage_script.js'></script>
            <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
            <script type="text/javascript" src="js/functions.js"></script>
            <link href="css/silhouette.css" type="text/css" rel="stylesheet" />
            <link rel="stylesheet" href="css/magiczoom.css" type="text/css" />
            <script type="text/javascript" src="js/magiczoom.js"></script>
        <?php } else {
            ?>
            <script type="text/javascript" src="js/mootools.js"></script>
            <script type="text/javascript" src="js/Swiff.Uploader.js"></script>
            <script type="text/javascript" src="js/Fx.ProgressBar.js"></script>
            <script type="text/javascript" src="js/Lang.js"></script>
            <script type="text/javascript" src="js/FancyUpload2.js"></script>
            <script type="text/javascript" src="js/script.js"></script>
            <link rel="stylesheet" type="text/css" href="css/uploadstyle.css" />
            <link rel="stylesheet" href="css/screen.css" type="text/css" media="screen, projection" />
            <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
            <link href="css/silhouette.css" type="text/css" rel="stylesheet" />
            <!--[if IE]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection"><![endif]-->
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
            <a href="index.php"><img src="images/header.jpg" border=0/></a>
        </div>
        <div id="container">
            <div id="navbar">
                <ul>
                    <li><a href="index.php">Home</a></li>
                </ul>
                <ul>
                    <li><a href="districts.php">Districts</a></li>
                </ul>
                <ul>
                    <li><a href="history.php">History</a>
                        <ul>
                            <li><a href="text.php">Text</a></li>
                            <li><a href="images.php">Images</a></li>
                        </ul> 
                    </li>
                </ul>
                <ul>
                    <li><a href="about.php">About Us</a>
                        <ul>
                            <li><a href="links.php">Links</a></li>
                            <li><a href="design_review.php">Design Review</a></li>
                        </ul> 
                    </li>
                </ul>
                <div id="search">
                    <?php if (!isset($upload)) { ?>
                        <form enctype="multipart/form-data" action="search.php" method="GET" autocomplete="off">
                            <input type="hidden" value="1" name="page" />
                            <input name="terms" type="text" id="global"/>
                            <input type="submit" value="Search" />
                        </form>
                    <?php } ?>
                </div>
                <div id="clear"></div>
            </div>
            <div id="main">