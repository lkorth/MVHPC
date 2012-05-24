<?php

// where this page or sub-page sits
$pageRoot = 'archives/documents/';

// where to find PDF files within site
$pdfDir = 'data/archives/';

// where to find PDF files on server
$pdfURL = WEB_ROOT . $pdfDir;

// $pdfFile is set in page-controller

// load the pdf list and pdf viewer
include 'pdf-list.php';
include 'pdf-viewer.php';

?>