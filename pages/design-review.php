<?php

// set up template title & style
$template->setTitle('MVHPC :: Design Review');
$template->setStyle('oneColumn');

// grab the pdfFile to display (if any)
$pdfFile = $subpage2;

// where this page or sub-page sits
$pdfPageRoot = 'about/design-review/';

// where to find PDF files in the folder for the site
$pdfDir = 'data/about/';

// load variables and functions for PDF lists and viewing
include 'pdf-viewer.php';

// page content (from PDF-Viewer)
ob_start();
  generatePage();
$content = ob_get_clean();

// use custom CSS and viewPDF javascript if need be
array_push($headerCSS, 'pdf-viewer.css');
if ($pdfViewing) {
  ob_start();
    jsVars();
  $headerCustom = ob_get_clean();
  if ($pdfSupported) {
    array_push($headerJS, 'pdf-js/pdf-min.js', 'pdf-js/pdf-viewer.js');
  }
}

// send content to template
$template->setSingleCol($content);

?>
