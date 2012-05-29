<?php

// set up template title & style
$template->setTitle('MVHPC :: Documents');
$template->setStyle('oneColumn');

// grab the pdfFile to display (if any)
$pdfFile = $subpage2;

// where this page or sub-page sits
$pdfPageRoot = 'archives/documents/';

// where to find PDF files in the folder for the site
$pdfDir = 'data/archives/';

// load variables and functions for PDF lists and viewing
include 'pdf-viewer.php';

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

// page content
ob_start();
  generatePage();
$content = ob_get_clean();

// send content to template
$template->setSingleCol($content);

?>
