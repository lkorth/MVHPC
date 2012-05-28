<?php

$id = $subpage2;

$img = returnImage($id);

if ($img == NULL) {
  ?>

<p> "<?php echo $id; ?>" is not a valid image id. Please go back to the
  <a href="<?php echo WEB_ROOT . 'archives/images/'; ?>"> archive image search
</a> . </p>

  <?php
}

else {
  $location = WEB_ROOT . $img['location'];
  $medlg = WEB_ROOT . $img['medlg'];
  $mid = WEB_ROOT . $img['mid'];

  $trueViews = $img['trueviews'] + 1;
  $views = $img['views'] + 0.05;
  updateImageViews($views, $trueViews, $id);

  $imgThumb = getimagesize($_SERVER['DOCUMENT_ROOT'] . $mid);
  $imgZoom = getimagesize($_SERVER['DOCUMENT_ROOT'] . $medlg);
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
      lighbox : true
    });
  });
  /*]]>*/
</script>

<div id="image-viewer">

  <div id="zoom01" class="zoom">
    <img src="<?php echo $mid; ?>" />
  </div>

  <div id="image-info">
    <p> <?php echo $img['information']; ?> </p>

    <a href="<?php echo $location; ?>"> Click here for full resolution picture (Warning some pictures are VERY large) </a>

    <a href="feedback.php?id=<?php echo $id; ?>"> Click here to request tag update </a>
  </div>

</div>

  <?php
  }
?>
