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

// if viewing to a specified page, get that page number
if (isset($subpage3) && is_numeric($subpage3)) {
    $pdfPage = $subpage3;
} else {
    $pdfPage = 1;
}


// FUNCTIONS - these get loaded as needed for PDF display

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
        ?>
<li>
  <a href="<?php echo WEB_ROOT . $pdfPageRoot . $fileName; ?>"> <?php echo $name; ?> </a>
  <span class="pdf-item-dl">
    <a href="<?php echo $pdfDirURL . $fileName; ?>.pdf"> (download) </a>
  </span>
</li>
        <?php
      }
    }
  
  ?>
</ul>
  <?php
}


// create the PDF viewer, output to HTML
function generateViewer() {
  global $pdfURL;
  global $pdfPage;
  global $pdfName;

  ?>
<h1 class="ribbon"> <?php echo $pdfName; ?> </h1> <br />
  <?php

      $host = $_SERVER['SERVER_NAME'];

      // assemble this to a URL for the PDF
      $pdfFullURL = urlencode('http://' . $host . $pdfURL);
      
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

// generate the page's HTML, only what is needed to load
function generatePage(){
  global $pdfViewing;
  generateList();
  if ($pdfViewing) {
    generateViewer();
  }
}

?>
