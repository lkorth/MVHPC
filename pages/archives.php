<?php

// set up template title & style
$template->setTitle('MVHPC :: Archives');
$template->setCurrentPage('archives');
$template->setStyle('oneColumn');

// page content
ob_start();
  ?>

<h1 class="ribbon"> Archives </h1>

<p class="body_text">
  Take a walk through Mount Vernon, Iowa, and you will see why it is a unique midwestern town. Built on and around a long, rolling hill, it is home to one of the most attractive college campuses in the U.S. - Cornell College. Mount Vernon's carefully tended Victorian-era homes and quaint business district recall an era of days gone by. Each era contributed to the town's prosperity, leaving its mark on local culture and the appearance of Mount Vernon today.
</p>

<p class="body_text">
  The Archives store important information pertaining to the history of Mount Vernon. Explore below to find archival images, historical documents, and an overview of the history of the town.
</p>

<h1 class="ribbon"> Resources </h1>

<ul class="body_text">
  <li><a href="<?php WEBROOT(); ?>archives/images/"> Archival Images </a></li>
  <li><a href="<?php WEBROOT(); ?>archives/secondary-documents/"> Secondary Documents </a></li>
</ul>


  <?php
$content = ob_get_clean();

// send content to template
$template->setSingleCol($content);

?>
