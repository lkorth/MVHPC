<?php

// where this page or sub-page sits
$pageRoot = 'about/design-review/';

// where to find PDF files within site
$pdfDir = 'data/about/';

// where to find PDF files on server
$pdfURL = WEB_ROOT . $pdfDir;

// $pdfFile is set in page-controller

// load the pdf list and pdf viewer
include 'pdf-list.php';
include 'pdf-viewer.php';

?>
