<?php

// if browser is Chrome, Firefox, or Safari, support pdf.js
$supported = false;
if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)
  $supported = true;
else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false)
  $supported = true;
else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false)
  $supported = true;

// set whether or not we are viewing a PDF
// $pdfFile is set in the page controller
$viewing = ($pdfFile != NULL);

// output the page variables in javascript
// needed to properly load the PDF in PDF.js      
function pageVars($pdfFile, $pdfURL){
  ?>

<script type="text/javascript">
  // grab the specified PDF to display
  // utilized in pdf-viewer.js
  var pdfFile = "<?php echo $pdfFile; ?>";
  var pdfURL = "<?php echo $pdfURL; ?>";
</script>

  <?php
}

?>
