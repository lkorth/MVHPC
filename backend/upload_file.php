<?php
require_once '../includes/master.inc.php';

$Auth->requireUser();

$upload = 1;
$title = "Upload Files";
include 'header.php';
?>
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
    <p><a href="login.php">Manage site</a><br>
</div>
</div>
</div>
</body>
</html>