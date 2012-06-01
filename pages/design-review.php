<?php

// set up template title & style
$template->setTitle('MVHPC :: Design Review');
$template->setCurrentPage('about');
$template->setStyle('oneColumn');

ob_start();
?>
<h1 class='ribbon'>Design Review</h1>
<p class="body_text">
  Design review is a process to guide property owners in the proper maintenance and enhancement of their structures and neighborhoods. Design review guidelines are promoted and published by the Commission and all property owners in historic districts must apply for one of the following certificates before making any changes in appearance to their property.
</p>

<ul class="body_text">
  <li>
      <strong> Certificate of No Material Effect </strong>: Applied for when a property owner that is requesting a building permit demonstrates that there will be no change to the exterior appearance of their building or site which will affect the historic character of the district.
  </li>
  <li>
      <strong> Certificate of Appropriateness </strong>: Applied for when a property owner requesting a building permit or demolition permit demonstrates that any alterations are in keeping with the Secretary of the Interior's Standards for Rehabilitation or that the improvements will not alter and/or will improve the property's historic appearance.
  </li>

</ul>

<p class="body_text">
    You will find here all the information needed to secure approval for proposed changes in structures located in Historic Districts. We have also included a helpful guide for making improvements or changes in older homes not included in a Historic District. The Commission encourages consultations with us as early a possible in the design process so that any confusions can be clarified before final plans are submitted.
</p>
<?php

// grab the pdfFile to display (if any)
$pdfFile = $subpage2;

// where this page or sub-page sits
$pdfPageRoot = 'about/design-review/';

// where to find PDF files in the folder for the site
$pdfDir = 'data/about/';

// load variables and functions for PDF lists and viewing
include 'pdf-viewer.php';

// page content (from PDF-Viewer)
generatePage();

$content = ob_get_clean();
// send content to template
$template->setSingleCol($content);

?>
