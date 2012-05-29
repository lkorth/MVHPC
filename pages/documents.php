<?php
$template = new Template();
$template->setStyle('oneColumn');
$title = 'MVHPC :: Documents';
$headerCustom = NULL;
$headerJS = array(
  0=>'jquery-172.js',
  1=>'functions.js',
  2=>'base64.js'
);
$headerCSS = array();
$pdfFile = $subpage2;

// where this page or sub-page sits
$pdfPageRoot = 'archives/documents/';

// where to find PDF files in the folder for the site
$pdfDir = 'data/archives/';

// load variables and functions for PDF lists and viewing
include 'pdf-viewer.php';

array_push($headerCSS, 'pdf-viewer.css');
if ($pdfViewing) {
  ob_start();
  jsVars();
  $headerCustom = ob_get_clean();
  if ($pdfSupported) {
    array_push($headerJS, 'pdf-js/pdf-min.js', 'pdf-js/pdf-viewer.js');
  }
}

ob_start();
generatePage();
$singleCol = ob_get_clean();
$template->setSingleCol($singleCol);
$template->output();

?>
