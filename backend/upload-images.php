<?php
require_once '../includes/master.inc.php';

$Auth->requireUser();

$upload = 1;
$title = "Upload Files";
$level = '../';
include '../shared/header.php';
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
<br>
<div align="center">
    <form action="upload.php" method="post" enctype="multipart/form-data" id="form-demo">

        <fieldset id="demo-fallback">
            <legend>File Upload</legend>
            <p>
                We were not able to load the multiple picture upload manager, please upload one picture at a time.
            </p>
            <label for="demo-photoupload">
                Upload a Photo:
                <input type="file" name="Filedata" />
            </label>
        </fieldset>

        <div id="demo-status" class="hide">
            <p>
                <a href="#" id="demo-browse">Browse Files</a> |
                <a href="#" id="demo-clear">Clear List</a> |
                <a href="#" id="demo-upload">Start Upload</a>
            </p>
            <div>
                <strong class="overall-title"></strong><br>
                <img src="images/progress-bar/bar.gif" class="progress overall-progress" />
            </div>
            <div>
                <strong class="current-title"></strong><br>
                <img src="images/progress-bar/bar.gif" class="progress current-progress" />
            </div>
            <div class="current-text">
            </div>
        </div>

        <ul id="demo-list"></ul>

    </form>
</div>
<div>
    <br>
</div>
<div>
    <br>
</div>
<div>
    <br>
</div>
<p align="center">Please browse and select all the files you wish to upload and click upload.<br>  After the upload has finished click on the next page button to tag the files.</p>
<div>
    <br>
</div>
<div align="center">
    <form action="common_tag.php" method="post" enctype="multipart/form-data" id="nextpage">
        <input type="submit" value="Next Page" />
</div>
<br>
<div id="footer">
    <p><a href="<?php WEBROOT() ?>backend/login.php">Manage site</a><br>
</div>
</div>
</div>
</body>
</html>