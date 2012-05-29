<?php

include('../includes/master.inc.php');
include('../includes/class.template.php');

$Auth->requireUser();

$template = new Template();

?>
<html>
<?php
    $headerExtras['js'] = array('mootools.js', 'Swiff-Uploader.js', 'Fx-ProgressBar.js', 'Lang.js', 'FancyUpload2.js', 'script.js');
    $headerExtras['css'] = array('uploadstyle.css');
?>
<?php ob_start(); ?>
    <div align="center">
        <form action="upload.php" method="post" enctype="multipart/form-data" id="form-demo">

            <fieldset id="demo-fallback">
                <legend>File Upload</legend>
                <p class="body_text">
                    We were not able to load the multiple picture upload manager, please upload one picture at a time.
                </p>
                <label for="demo-photoupload">
                    Upload a Photo:
                    <input class="button" type="file" name="Filedata" />
                </label>
            </fieldset>

            <div id="demo-status" class="hide">
                <p>
                    <a class="button" href="#" id="demo-browse">Browse Files</a> |
                    <a class="button" href="#" id="demo-clear">Clear List</a> |
                    <a class="button" href="#" id="demo-upload">Start Upload</a>
                </p>
                <div>
                    <strong class="overall-title"></strong><br>
                    <img src="<?php WEBROOT(); ?>images/uploader/bar.gif" class="progress overall-progress" />
                </div>
                <div>
                    <strong class="current-title"></strong><br>
                    <img src="<?php WEBROOT(); ?>images/uploader/bar.gif" class="progress current-progress" />
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
    <p class="body_text" align="center">Please browse and select all the files you wish to upload and click upload.<br>  After the upload has finished click on the next page button to tag the files.</p>
    <div>
        <br>
    </div>
    <div align="center">
        <form action="common-tag.php" method="post" enctype="multipart/form-data" id="nextpage">
            <input class="button" type="submit" value="Next Page" />
    </div>
<?php
    $content = ob_get_clean();

    $template->setStyle('oneColumn');
    $template->setTitle('Upload Images');
    $template->setHeaderExtras($headerExtras);
    $template->setSingleCol($content);

    $template->output();
?>