<?php

// where this page or sub-page sits
$pageRoot = 'archives/documents/';

// where to find PDF files within site
$pdfDir = 'data/archives/';

// where to find PDF files on server
$pdfDirURL = WEB_ROOT . $pdfDir;

// $pdfFile is set in page-controller

// where this specific PDF file is
$pdfURL = $pdfDirURL . $pdfFile . '.pdf';

// check what PDF loading is supported
include 'pdf-support.php';

function pageDisplay($viewing, $supported, $pageRoot, $pdfDirURL, $pdfURL){
// load the list pdf
include 'pdf-list.php';

// load the pdf viewer if needed
if ($viewing) {
  include 'pdf-viewer.php';
}
}

?>
