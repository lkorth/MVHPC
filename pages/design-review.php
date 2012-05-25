<?php

// where this page or sub-page sits
$pageRoot = 'about/design-review/';

// where to find PDF files within site
$pdfDir = 'data/about/';

// where to find PDF files on server
$pdfDirURL = WEB_ROOT . $pdfDir;

// $pdfFile is set in page-controller

// where this specific PDF file is
$pdfURL = $pdfDirURL . $pdfFile . '.pdf';

// check what PDF loading is supported
include 'pdf-support.php';

// display the entire content for listing and viewing PDFs
function pageDisplay($viewing, $supported, $pageRoot, $pdfDirURL, $pdfURL){
  // load the list of PDFs
  include 'pdf-list.php';

  // load the pdf viewer if needed
  if ($viewing) {
    include 'pdf-viewer.php';
  }
}

?>
