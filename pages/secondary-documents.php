<?php

// set up template title & style
$template->setTitle('MVHPC :: Secondary Documents');
$template->setCurrentPage('archives');
$template->setStyle('oneColumn');

// grab the pdfFile to display (if any)
$pdfFile = $subpage2;

// where this page or sub-page sits
$pdfPageRoot = 'archives/secondary-documents/';

// where to find PDF files in the folder for the site
$pdfDir = 'data/archives/';

// load variables and functions for PDF lists and viewing
include 'pdf-viewer.php';

// page content (from PDF-Viewer)
ob_start();
  ?>

<h1 class="ribbon"> Secondary Documents </h1>

<p class="body_text">
  Search through the Centennial Book's <a href="<?php WEBROOT(); ?>archives/secondary-documents/Centennial-Book-Index/">online index</a>.
</p>

  <?php
generatePage();
$content = ob_get_clean();

// send content to template
$template->setSingleCol($content);

?>
