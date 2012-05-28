<?php

// VARIABLES - needed to generate PDF lists and display

// where to find PDF files on server
$pdfDirURL = WEB_ROOT . $pdfDir;

// $pdfFile is set in page-controller

// where this specific PDF file is
$pdfURL = $pdfDirURL . $pdfFile . '.pdf';

// set whether or not we are viewing a PDF
// $pdfFile is set in the page controller
$pdfViewing = ($pdfFile != NULL);

// if browser is Chrome, Firefox, or Safari, support pdf.js
$pdfSupported = false;
if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)
  $pdfSupported = true;
else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false)
  $pdfSupported = true;
else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false)
  $pdfSupported = true;

// if viewing to a specified page, get that page number
if (isset($subpage3) && is_numeric($subpage3)) {
    $pdfPage = $subpage3;
} else {
    $pdfPage = 1;
}

// FUNCTIONS - these get loaded as needed for PDF display

// output the page variables in javascript
// only needed to load the PDF in PDF.js      
function jsVars(){
  global $pdfFile;
  global $pdfURL;
  global $pdfPage;
  ?>
  
<script type="text/javascript">
  // grab the specified PDF to display
  // utilized in pdf-viewer.js
  var pdfFile = "<?php echo $pdfFile; ?>";
  var pdfURL = "<?php echo $pdfURL; ?>";
  var pdfPage = "<?php echo $pdfPage; ?>";
</script>

  <?php
}


// create the list of PDFs, output to HTML
function generateList(){
  global $pdfDirURL;
  global $pdfPageRoot;
  
  ?>
<div id="pdf-list">
  <?php
  
    // folder containing PDFs
    $pdfFullURL = $_SERVER['DOCUMENT_ROOT'] . $pdfDirURL;

    // open PDF folder, look for PDFs
    $dirHandle = opendir($pdfFullURL);
    while (($file = readdir($dirHandle)) !== false) {
      if (preg_match('/\.pdf/i', $file)) {

        // get its filename (no extension)
        $fileName = basename($file, '.pdf');
        
        // prettify the filename
        $name = str_replace('_', ' ', $fileName);
        $name = str_replace('-', ' ', $name);

        // generate the PDF list with load and download links
        echo "<div class='pdf-item'>";
          echo '<a href="' . WEB_ROOT . $pdfPageRoot . $fileName . '/">' . $name . '</a>';
          echo "<span class='pdf-item-dl'>";
              echo '<a href="' . $pdfDirURL . $fileName . '.pdf"> (download) </a>';
        echo '</span> </div>';
      }
    }
    
    // close the folder
    closedir($dirHandle);
    
  ?>
</div>
  <?php
}


// create the PDF viewer, output to HTML
function generateViewer(){
  global $pdfSupported;
  global $pdfURL;

  // if a supported browser, view PDF with PDF.js
  if ($pdfSupported) {
    ?>

<div id="pdf-viewer">
  <div id="pdf-toolbar">
    <button id="pdf-prev" onclick="goPrevious()"> Previous </button>
    <button id="pdf-next" onclick="goNext()"> Next </button>
    <label id="pdf-page-num-label" for="pdf-page-num"> Page: </label>
    <input id="pdf-page-num" onchange="goToPage(this.value);" type="number" value="1" size="4" min="1"> </input>
    / <span id="pdf-page-count"> </span>
    <button id="pdf-fullscreen" onclick="fullscreen();">
      <span> Fullscreen </span>
    </button>
    <button id="pdf-download" onclick="download();">
      <span> Download </span>
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
echo $pdfFullURL;
// TESTING ONLY - remove for production!!!!!
      $pdfFullURL = 'http://www.education.gov.yk.ca/pdf/pdf-test.pdf';
      
      // create URL to Google Docs Viewer & embed on page
      $docsViewer = "http://docs.google.com/viewer?url=$pdfFullURL";

      ?>
<iframe id="docs-viewer" src="<?php echo $docsViewer; ?>&embedded=true" width="600" height="780"> </iframe>
      <?php
  }
}

// generate the page's HTML, only what is needed to load
function generatePage(){
  global $pdfViewing;
  generateList();
  if ($pdfViewing) {
    generateViewer();
  }
}

?>
