<?php

// set up template title & style
$template->setTitle('MVHPC :: Commercial');
$template->setCurrentPage('map');
$template->setStyle('twoColumn');

// display the intro content in right pane
ob_start();
  ?>
<h1 class="ribbon"> Commercial </h1>

<p class="body_text">
  The period of 1880 - 1910 resulted in most of the Commercial National Historic District. This was during the Railroad Era, where many disastrous fires swept through the town. As a result of these fires, the old, wooden structures were replaced by fire-resistant brick buildings, and the Commercial National Historic District was born.
</p>

<strong class="body_text"> Resources </strong>
<ul class="body_text">
  <li> View <a href="<?php WEBROOT(); ?>archives/images/commercial"> Archival Images </a></li>
  <li> Explore Google's <a href="http://goo.gl/maps/16yq"> Street View </a></li>
</ul>

  <?php 

// send right pane output to template
$rightCol = ob_get_clean();
$template->setRightCol($rightCol);

?>
