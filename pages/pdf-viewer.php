<?php
  // if a supported browser, view PDF with PDF.js
  if ($supported) {
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

    <?php
  // if unsupported browser, view PDF wtih Google Docs
  } else {
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
