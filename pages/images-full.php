<?php

// set up template title & style
$template->setTitle = 'MVHPC :: View Image';
$template->setStyle('oneColumn');

// grab image ID & image data
$id = $subpage2;
$img = returnImage($id);

// begin page content
ob_start();

if ($img == NULL) {
  ?>

<p class="body_text"> "<?php echo $id; ?>" is not a valid image id. Please go back to the
  <a href="<?php echo WEB_ROOT . 'archives/images/'; ?>"> archive image search
</a> . </p>

  <?php
}

else {
  $location = WEB_ROOT . $img['location'];
  $medlg = WEB_ROOT . $img['medlg'];
  $mid = WEB_ROOT . $img['mid'];
  $tags = $img['tags'];
  $information = $img['information'];

  $trueViews = $img['trueviews'] + 1;
  $views = $img['views'] + 0.05;
  updateImageViews($views, $trueViews, $id);

  $imgThumb = getimagesize($_SERVER['DOCUMENT_ROOT'] . $mid);
  $imgZoom = getimagesize($_SERVER['DOCUMENT_ROOT'] . $location);
  $imgThumbW = $imgThumb[0];
  $imgThumbH = $imgThumb[1];
  $imgZoomW = $imgZoom[0];
  $imgZoomH = $imgZoom[1];

  ?>

<script type="text/javascript">
  /*<![CDATA[*/
  $(function() {
    $("#zoom01").gzoom({
      sW: <?php echo $imgThumbW; ?>,
      sH: <?php echo $imgThumbH; ?>,
      lW: <?php echo $imgZoomW; ?>,
      lH: <?php echo $imgZoomH; ?>,
      lightbox : true
    });
  });
  /*]]>*/
</script>
<div id="image-viewer" style="overflow: hidden; width='<?php echo $imgThumbW; ?>px'">

  <div id="zoom01" class="zoom">
    <img src="<?php echo $mid; ?>" title="<?php echo $information; ?>" alt="<?php echo $tags; ?>" />
  </div>

  <div id="image-info" style="position: relative; float: left; width: 762px;">
    <p class="body_text center"> <?php echo $information; ?> </p>

    <p class="body_text center"> <a href="<?php echo $location; ?>"> Download full image (please note: images can be quite large) </a> </p>

    <p class="body_text center"> <a href="/pages/request-tag-change.php?id=<?php echo $id; ?>"> Request a tag update </a> </p>
  </div>

</div>

  <?php
  }

// grab page content
$content = ob_get_clean();

// set Javascript and CSS
array_push($headerJS, 'jquery-mousewheel.js',
                      'jquery-ui-1820-custom-min.js',
                      'jquery-gzoom.js');
array_push($headerCSS, 'jquery-ui-1820-custom.css',
                       'jquery-gzoom.css');

// send content to template
$template->setSingleCol($content);

?>
