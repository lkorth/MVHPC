<?php
  // if browser is Chrome, Firefox, or Safari, support pdf.js
  $supported = false;
  if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)
    $supported = true;
  else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false)
    $supported = true;
  else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false)
    $supported = true;

  // if we are viewing a PDF, set some variables
  // $pdfFile is set in the page controller
  $viewing = ($pdfFile != NULL);
  if ($viewing) {
    $pdfURL .= $pdfFile . '.pdf';
?>
    <script type="text/javascript">
      // grab the specified PDF to display
      // utilized in pdf-viewer.js
      var pdfFile = "<?php echo $pdfFile; ?>";
      var pdfURL = "<?php echo $pdfURL; ?>";
    </script>
    
<?php
  }

  // if supported & viewing, load pdf.js
  $viewPDFjs = $supported && $viewing;
  if ($viewPDFjs) {
?>
    <script type="text/javascript" src="<?php echo WEB_ROOT; ?>js/pdf-js/pdf.js"> </script>

<?php
  }

  // if unsupported & viewing, set to embed Google Docs Viewer
  $viewPDFdocs = !$supported && $viewing;
?>

<?php
  if($viewPDFjs){
?>
    <div id="pdf-viewer">
      <div id="pdf-toolbar">
        <button id="pdf-prev" onclick="goPrevious()"> Previous </button>
        <button id="pdf-next" onclick="goNext()"> Next </button>
        <label id="pdf-page-num-label" for="pdf-page-num"> Page: </label>
        <input id="pdf-page-num" onchange="goToPage(this.value);" type="number" value="1" size="4" min="1"> </input>
        / <span id="pdf-page-count"> </span>
        <button id="pdf-download" onclick="download();">
          <span> Download </span>
        </button>
        <button id="pdf-fullscreen" onclick="fullscreen();">
          <span> Fullscreen </span>
        </button>
      </div>
        
      <canvas id="pdf"> </canvas>
      
    </div>
      
    <script type="text/javascript" src="<?php echo WEB_ROOT; ?>js/pdf-js/pdf-viewer.js"> </script>
      
<?php
  // if unsupported browser viewing a PDF, embed wtih Google Docs
  } else if($viewPDFdocs) {
      $host = $_SERVER['SERVER_NAME'];

      // assemble this to a URL for the PDF
      $pdfFullURL = 'http://' . $host . $pdfURL;

// TESTING ONLY - remove for production!!!!!
      $pdfFullURL = 'http://www.education.gov.yk.ca/pdf/pdf-test.pdf';
      
      // create URL to Google Docs Viewer & embed on page
      $docsViewer = "http://docs.google.com/viewer?url=$pdfFullURL";
?>
      <iframe id="docs-viewer" src="<?php echo $docsViewer; ?>&embedded=true" width="600" height="780"> </iframe>

<?php
  }
?>
