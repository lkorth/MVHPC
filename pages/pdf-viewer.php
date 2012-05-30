<?php

// VARIABLES - needed to generate PDF lists and display

// where to find PDF files on server
$pdfDirURL = WEB_ROOT . $pdfDir;

// $pdfFile is set in page-controller

// where this specific PDF file is
$pdfFile = urldecode($pdfFile);
$pdfURL = $pdfDirURL . $pdfFile . '.pdf';

// pretty name for file to display as a header
$pdfName = str_replace('.pdf', ' ', $pdfFile);
$pdfName = str_replace('_', ' ', $pdfName);
$pdfName = str_replace('-', ' ', $pdfName);

// beginning to fullscreen PDF url
$fsURL = WEB_ROOT . $pdfPageRoot . $pdfFile;

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
  global $fsURL;
  ?>
  
<script type="text/javascript">
  // grab the specified PDF to display
  // utilized in pdf-viewer.js
  var pdfFile = "<?php echo $pdfFile; ?>";
  var pdfURL = "<?php echo $pdfURL; ?>";
  var pdfPage = "<?php echo $pdfPage; ?>";
  var fsURL = "<?php echo $fsURL; ?>";
</script>

  <?php
}


// create the list of PDFs, output to HTML
function generateList(){
  global $pdfDirURL;
  global $pdfPageRoot;
  
  ?>
    <ul id="pdf-list" class="body_text">
  <?php
  
    // folder containing PDFs
    $pdfFullURL = $_SERVER['DOCUMENT_ROOT'] . $pdfDirURL;

    // open PDF folder, look for PDFs
    $dir = scandir($pdfFullURL);
    foreach ($dir as $file) {
      if (preg_match('/\.pdf/i', $file)) {

        // get its filename (no extension)
        $fileName = basename($file, '.pdf');
        
        // prettify the filename
        $name = str_replace('_', ' ', $fileName);
        $name = str_replace('-', ' ', $name);
        
        // encode URL for more filename support
        $fileName = urlencode($fileName);

        // generate the PDF list with load and download links
        echo "<li>";
          echo '<a href="' . WEB_ROOT . $pdfPageRoot . $fileName . '/">' . $name . '</a>';
          echo "<span class='pdf-item-dl'>";
              echo '<a href="' . $pdfDirURL . $fileName . '.pdf"> (download) </a>';
        echo '</span> </li>';
      }
    }
  
  ?>
    </ul>
  <?php
}


// create the PDF viewer, output to HTML
function generateViewer(){
  global $pdfSupported;
  global $pdfURL;
  global $pdfPage;
  global $pdfName;

  ?>
<h1 class="ribbon"> <?php echo $pdfName; ?> </h1>
  <?php

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

// TESTING ONLY - remove for production!!!!!
      $pdfFullURL = 'http://www.mvhpc.org/data/history_intro_to_mount_vernon.pdf';
      
      // create URL to Google Docs Viewer & embed on page
      $docsViewer = "http://docs.google.com/viewer?url=$pdfFullURL";
      
      // set to embed this on the page
      $docsViewer .= '&embedded=true';
      
      // GDocs glitch: off by one & cannot show first page
      // so this properly sets the page number
      if ($pdfPage != 1) {
        $pdfPage -= 1;
        $docsViewer .= '#:0.page.' . $pdfPage;
      }

      ?>
<iframe id="docs-viewer" src="<?php echo $docsViewer; ?>" width="850" height="700"> </iframe>
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
