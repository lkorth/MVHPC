<?php

// set up template title & style
$template->setTitle('MVHPC :: Cornell College');
$template->setCurrentPage('map');
$template->setStyle('twoColumn');

// display the intro content in right pane
ob_start();
  ?>
<h1 class="ribbon"> Cornell College </h1>

<p class="body_text">
  Cornell College was established in 1853, during the Military Road Era. The College expanded during the Railroad Era since it was easier to travel to the "Hilltop." It was during this same era that many fine homes were built, still within Cornell College's National Historic District today. During an overlapping Cornell College Era, these residential expansions accompanied construction of several College buildings as well.
</p>

<strong class="body_text"> Resources </strong>
<ul class="body_text">
  <li> View <a href="<?php WEBROOT(); ?>archives/images/cornell"> Archival Images </a></li>
  <li> Examine Cornell's <a href="http://www.cornellcollege.edu/library/archives"> Archives </a></li>
    <li> Explore Cornell's <a href="http://www.cornellcollege.edu/about-cornell/images/maps/campus-map.pdf"> Campus Map </a></li>
  <li> Explore Google's <a href="http://goo.gl/maps/vW7a"> Street View </a></li>
</ul>

  <?php 

// send right pane output to template
$rightCol = ob_get_clean();
$template->setRightCol($rightCol);

?>
